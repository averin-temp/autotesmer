<?php

namespace common\components;


use common\classes\PayU;
use common\classes\Rating;
use common\models\Dial;
use common\models\Payment;
use common\models\Payout;
use common\models\User;
use common\models\UserPackage;
use common\notifications\Notification;
use yii\base\Component;
use yii\base\Exception;
use yii\base\Request;
use yii\helpers\Url;

class PaymentService extends Component
{

    /**
     * Срабатывает когда выплата подтверждена платежной системой
     *
     * @param $payout Payout
     */
    private function onSuccessPayout($payout){

        $message = date("d.m.y H:i:s") . ": Выплата ($payout->id) подтверждена.";
        \Yii::debug($message, __METHOD__);

        if($payout->type == Payout::TYPE_REFUND || $payout->type == Payout::TYPE_REWARD){
            \Yii::$app->orderService->onSuccessPayout($payout);
        }

        if($payout->type == Payout::TYPE_REVERSE){
            Notification::send('reverse_success',['target_user' => $payout->user_id]);
        }
    }

    /**
     * Срабатывает когда выплата отменена платежной системой
     *
     * @param $payout
     */
    private function onCancelPayout($payout){

        $message = date("d.m.y H:i:s") . ": Выплата ($payout->id) отменена.";
        \Yii::debug($message, __METHOD__);

        \Yii::$app->mailer->compose()
            ->setFrom('admin@autotesmer.ru')
            ->setTo(\Yii::$app->params['adminEmail'])
            ->setSubject('Выплата не прошла')
            ->setHtmlBody($message)
            ->send();

        if($payout->type == Payout::TYPE_REFUND || $payout->type == Payout::TYPE_REWARD){
            \Yii::$app->orderService->onCancelPayout($payout);
        }

        if($payout->type == Payout::TYPE_REVERSE){
            Notification::send('reverse_failed',['target_user' => $payout->user_id]);
        }
    }



    /**
     * Обрабатывает IPN запрос от платежной системы и выполняет обработку оплат
     *
     * @return string
     */
    public function handleIpnQuery(){

        /** @var PayU $payU  */
        $payU = \Yii::$app->PayU;

        /** @var Request $request */
        $request = \Yii::$app->request;

        try{
            if(0){//!$payU->checkIpnQuery()){
                throw new \Exception("неверный хэш IPN запроса");
            }

            $payment_id = $request->post('REFNOEXT');
            $payment_id = intval($payment_id);
            /** @var Payment $payment */
            $payment = Payment::findOne($payment_id);
            if(!$payment) {
                throw new \Exception("не найден Payment");
            }

            $orderStatus = $request->post('ORDERSTATUS');

            if( in_array($orderStatus, ['COMPLETE', 'TEST']) )
            {
                $this->onSuccessPayment($payment);
            }
            elseif( in_array($orderStatus, [ 'REVERSED', 'REFUND', 'INVALID', 'CARD_NOTAUTHORIZED', 'INVALID', 'NOT_FOUND']))
            {
                $this->onCancelPayment($payment);
            }
            //elseif( in_array($orderStatus, ['IN_PROGRESS', 'PAYMENT_AUTHORIZED', 'WAITING_PAYMENT']) ) { }

        } catch (\Exception $e){
            \Yii::error($e->getMessage(), __METHOD__);
        }

        return $payU->handleIPNResponse();
    }

    /**
     * Вызывается при успешной оплате
     *
     * @param Payment $payment
     * @throws \Exception
     */
    private function onSuccessPayment($payment){

        if($payment->status == Payment::STATUS_CANCELLED ||
            $payment->status == Payment::STATUS_CONFIRMED) {

            if($payment->type == Payment::TYPE_RESERVE){
                $this->reversePayment($payment, Payout::TYPE_REFUND);
            } else {
                $this->reversePayment($payment, Payout::TYPE_REVERSE);
            }

            return;
        }

        $payment->status = Payment::STATUS_CONFIRMED;
        $payment->save(false);

        if($payment->type == Payment::TYPE_PACKAGE_PAYMENT || $payment->type == Payment::TYPE_PACKAGE_EXTENSION){
            \Yii::$app->packageService->onSuccessPayment($payment);
        }

        if($payment->type == Payment::TYPE_RESERVE){
            \Yii::$app->orderService->onSuccessPayment($payment);
        }

    }



    /**
     * Срабатывает когда оплата отменена платежной системой
     *
     * @param Payment $payment
     */
    private function onCancelPayment($payment){

        $message = date("d.m.y H:i:s") . ": Выплата ($payment->id) отменена.";
        \Yii::debug($message, __METHOD__);

        $payment->status = Payment::STATUS_CANCELLED;
        $payment->save(false);

        if($promocode = $payment->getPromocode()){
            $promocode->activate();
        }
    }

    /**
     * временный переходник
     *
     * @param Payout $payout
     * @return int
     */
    private function getPayoutStatus($payout){

        $status = \Yii::$app->PayU->checkStatus($payout->id);

        \Yii::info($status, 'getPayoutStatus');

        if($status == 'FINALIZED'){
            return Payout::STATUS_CONFIRMED;
        }
        if($status == 'CANCELLED' || $status == 'ABORTED'){
            return Payout::STATUS_CANCELLED;
        }

        if($status == null){
            \Yii::error("Статус операции({$payout->id}) = NULL", 'PAYU');
        }

        return Payout::STATUS_WAITING_CONFIRMATION;
    }


    //--------------------------------------------------------------


    /**
     * @param Payment $payment
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function cancelPayment($payment){

        if($payment->status == Payment::STATUS_CONFIRMED) {

            if($payment->type == Payment::TYPE_RESERVE)
            {
                $this->reversePayment($payment, Payout::TYPE_REFUND);
            } else {
                $this->reversePayment($payment, Payout::TYPE_REVERSE);
            }
        }

        if($payment->status == Payment::STATUS_WAITING_CONFIRMATION){
            $payment->status = Payment::STATUS_CANCELLED;
            $payment->save(false);
        }
        if($payment->status == Payment::STATUS_DRAFT){
            $payment->delete();
        }

        return true;
    }


    /**
     * Проверяет статус операции выплаты у платежной системы,
     * обновляет статус.
     *
     * @param $payout Payout
     * @return Payout|void
     */
    public function checkPayout($payout){

        \Yii::info('checkPayout_start', 'payout_check');

        if($payout->status != Payout::STATUS_WAITING_CONFIRMATION)
        {
            \Yii::info('checkPayout_return_1', 'payout_check');
            return;
        }


        $status = $this->getPayoutStatus($payout);
        \Yii::info($status, 'payout_check');

        if($status == Payout::STATUS_WAITING_CONFIRMATION)
        {
            \Yii::info('checkPayout_return_2', 'payout_check');
            return;
        }

        $payout->status = $status;
        $payout->save(false);

        \Yii::info('checkPayout_saved', 'payout_check');

        if($status == Payout::STATUS_CONFIRMED){
            \Yii::info('Payout::STATUS_CONFIRMED', 'payout_check');
            $this->onSuccessPayout($payout);
        }

        if($status == Payout::STATUS_CANCELLED){
            \Yii::info('Payout::STATUS_CANCELLED', 'payout_check');
            $this->onCancelPayout($payout);
        }
    }



    /**
     * Создает запрос из объекта Payment, отправляет и возвращает результат
     *
     * @param $payout Payout
     * @return mixed
     * @throws \Exception
     */
    public function sendPayout($payout){

        \Yii::info($payout, 'sendPayout');


        $payout->status = Payout::STATUS_WAITING_CONFIRMATION;
        $payout->save(false);

        $data = [
            'currency' => 'RUB', // Валюта
            'amount' => $payout->sum, // Сумма транзакции	45.00
            'outerId' => $payout->id, // Идентификатор сделки в системе магазина (МФО). Можно передавать любой набор цифр
            'senderFirstName' => 'Эксель ООО', // Имя отправителя (можно передавать название юр лица)
            'senderLastName' => 'Эксель ООО', // Фамилия отправителя (можно передавать название юр лица)
            'senderEmail' => 'maxim.semin@autotesmer.ru', // Адрес электронной почты отправителя
            'senderPhone' => '9647063211', // Телефон отправителя (в числовом формате)
            'clientEmail' => $payout->user->email, // Адрес электронной почты клиента
            'clientFirstName' => $payout->user->firstname, // Имя клиента (если не известно, то можно передать Уважаемый Клиент)
            'clientLastName' => $payout->user->family, // Фамилия клиента
            'clientCity' => ($payout->user->city) ? $payout->user->city->name : '', // Город клиента
            'clientAddress' => '', // Адрес клиента
            'clientPostalCode' => '', // Индекс клиента
            'clientCountryCode' => 'RU', // Код страны клиента
            'desc' => "произвольный текст" , // Описание. Произвольный текст
            'timestamp' => time(), // UNIX timestamp
        ];

        $token = $payout->user->card->token;

        \Yii::info($token, 'sendPayout');

        \Yii::$app->PayU->sendPayoutRequest($data, $token);

        return null;
    }

    /**
     * Создает поля для формы привязки карты
     *
     * @param User $user
     * @param $backref string
     * @param $request_id int
     * @return array
     */
    public function cardRegistrationFormFields($user, $backref, $request_id){

        $fields = [
            'RequestID' => $request_id,
            'Email' => $user->email,
            'FirstName' => $user->firstname,
            'LastName' => $user->lastname,
            'Description' => 'Card link',
            'CardOwnerId' => $user->id,
            'BackURL' => $backref,
        ];

        return \Yii::$app->PayU->cardRegistrationFormFields($fields);
    }


    /**
     * @param int $user_id              ID пользователя который платит
     * @param int $type                 Тип оплаты
     * @param int $target               ID объекта-услуги, который оплачивается
     * @param float $sum                Сумма оплаты
     * @param string $description       Описание
     * @return Payment
     */
    public function createPayment($user_id, $type, $target, $sum, $description){

        $payment = new Payment();
        $payment->type = $type;
        $payment->target = $target;
        $payment->user_id = $user_id;
        $payment->sum = $sum;
        $payment->service_name = $description;
        $payment->status = Payment::STATUS_DRAFT;
        $payment->created = date("Y-m-d H:i:s");
        $payment->save(false);
        return $payment;
    }


    /**
     *
     * Выплачивает оплату обратно
     *
     * @param Payment $payment
     * @return null
     * @throws \Exception
     */
    private function reversePayment($payment, $type){

        // без привязанных карт вернуть не получится,
        // тут должен быть возврат через платежную систему, но эта возможность на данный момент отключена в payU,
        // отправляем выплату

        $this->sendPayout($this->createPayout(
            $type,
            $payment->user_id,
            $payment->sum
        ));
    }


    /**
     * Создает выплату, но не сохраняет ее
     *
     * @param $type
     * @param $user_id
     * @param $sum
     * @return Payout
     */
    public function createPayout($type, $user_id, $sum){
        $payout = new Payout();
        $payout->status = Payout::STATUS_WAITING_CONFIRMATION;
        $payout->type = $type;
        $payout->user_id = $user_id;
        $payout->sum = $sum;
        return $payout;
    }


    /**
     * Возвращает форму оплаты(для Ajax запроса)
     *
     * @param $payment Payment
     * @return string
     */
    public function getPaymentForm($payment){

        $payU = \Yii::$app->PayU;

        $backUrl =  Url::to(['/payment/result'], true);
        $formFields = $payU->paymentFormFields($payment, $backUrl);
        $formFields = $this->formFieldsHTML($formFields);

        $formUrl = $payU->url_lu;

        return "<form action=\"$formUrl\" method=\"post\" style=\"display: none\">$formFields</form>";
    }



    /**
     * Создает HTML поля формы из массива
     *
     * @param $data
     * @return string
     */
    private function formFieldsHTML($data){
        $html = '';
        foreach($data as $dataKey => $dataValue){
            foreach((array)$dataValue as $value){
                $html .= '<input type="hidden" name="'.$dataKey.'" value="'.htmlspecialchars($value).'">'."\n";
            }
        }

        return $html;
    }


    /**
     *
     *
     * @param Payment $payment
     * @return bool
     * @throws Exception
     */
    public function submitPayment($payment){

        if($payment->status != Payment::STATUS_DRAFT)
            throw new Exception("неверный статус оплаты");

        if ($payment->promocode) {
            $promocode = $payment->getPromocode();
            if($promocode->used)
                throw new Exception("промокод уже использован");

            $promocode->spend();
        }

        $payment->status = Payment::STATUS_WAITING_CONFIRMATION;
        $payment->save(false);

        return true;
    }






}