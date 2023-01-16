<?php
namespace frontend\controllers;

use common\components\PaymentService;
use common\classes\PayU;
use common\classes\Rating;
use common\components\OrderService;
use common\models\Brief;
use common\models\Dial;
use common\models\Order;
use common\models\PackageVariant;
use common\models\Payment;
use common\models\Payout;
use common\models\Request;
use common\models\User;
use common\models\UserPackage;
use common\notifications\Notification;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

class PaymentController extends Controller{

    public $defaultAction = 'payment';


    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['checkpayouts',],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }



    public function actionPay(){

        $payment = new Payment();
        if($payment->load(\Yii::$app->request->post(), '')){
            $payment->save(false);
            return $this->redirect(['confirm', 'payment_id' => $payment->id ]);
        }
        return $this->render('reserve', ['payment' => $payment]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPayment($id){

        $payment = Payment::findOne($id);
        if($payment == null)
            throw new NotFoundHttpException("Оплата не найдена");


        if($payment->status == Payment::STATUS_CANCELLED ||
            $payment->status == Payment::STATUS_CONFIRMED){
            throw new NotFoundHttpException("Оплата не найдена");
        }

        /** @var User $user */
        $user = \Yii::$app->user->identity;

        if($payment->user_id != $user->id){
            throw new NotFoundHttpException("Оплата не найдена");
        }

        if($promocode = \Yii::$app->request->post('promocode', null)){
            $payment->applyPromocode($promocode);
        }

        return $this->render('payment', [
            'payment' => $payment
        ]);
    }


    public function actionRepeat($id)
    {
        $payment = Payment::findOne($id);
        if($payment == null){
            throw new Exception("Оплата не найдена");
        }

        if($payment->status != Payment::STATUS_CANCELLED){
            throw new Exception("Неверный статус оплаты");
        }
        if($payment->type != Payment::TYPE_RESERVE){
            throw new Exception("Неверный тип оплаты");
        }

        if(!$dial = Dial::findOne($payment->target))
        {
            throw new Exception("Не найдена сделка");
        }

        if($dial->status != Dial::STATUS_WAITING_RESERVATION)
        {
            throw new Exception("Неверный статус сделки");
        }

        $payment = \Yii::$app->orderService->createReservationPayment($dial);


        return $this->redirect(['/payment/payment', 'id' => $payment->id]);
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function actionSubmit(){

        $request = \Yii::$app->request;
        if(!$request->isAjax){
            throw new BadRequestHttpException("Неверный формат запроса");
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;

        try{

            if(!$id = $request->post('id', null)){
                throw new Exception("Неверный формат запроса, отсутствует идентификатор оплаты");
            }

            $payment = Payment::findOne($id);
            if($payment == null){
                throw new Exception("Не найдена оплата");
            }

            if($payment->status == Payment::STATUS_CONFIRMED){
                throw new Exception("Оплата уже подтверждена");
            }

            if($payment->status == Payment::STATUS_CANCELLED){
                throw new Exception("Оплата отменена");
            }

            if($payment->status == Payment::STATUS_DRAFT){
                \Yii::$app->paymentService->submitPayment($payment);
            }

            if($payment->status != Payment::STATUS_WAITING_CONFIRMATION){
                throw new Exception("Неверный статус оплаты");
            }

            $html = \Yii::$app->paymentService->getPaymentForm($payment);

        } catch (Exception $e){
            return [ 'ok' => false, 'message' => $e->getMessage()];
        }

        return ['ok' => true, 'content' => $html ];

    }

    /**
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionResult(){
        $request = \Yii::$app->request;

        $result = $request->get('result');
        $payRefNo = $request->get('payrefno');
        $ctrl = $request->get('ctrl');
        $date = $request->get('date');

        // проверка подписи запроса
        $backRef = Url::to(['/payment/result'], true);
        $hash = hash_hmac('md5', $backRef, \Yii::$app->PayU->paymentSecretKey);

        if($hash != $ctrl){
            //throw new BadRequestHttpException("Неверная подпись");
        }

        $message="Произошла неизвестная ошибка, свяжитесь с администрацией";

        switch ($result){
            case '0': // Успешная оплата
                $message = "Успешная оплата";
                break;
            case '1':
                $message = "Ошибка платежа";
                break;
            case '-1': // Счет на оплату выставлен, но еще не оплачен; значение используется только для QIWI-кошельков
                $message = "Счет на оплату выставлен, но еще не оплачен";
                break;
        }

        return $this->render('result', ['message' => $message ]);
    }


    /**
     * @param int $id ID сделки
     * @return string
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function actionReserve($id){

        $dial = Dial::findOne($id);

        if($dial == null) {
            throw new BadRequestHttpException("Сделка не найдена");
        }

        $payment = \Yii::$app->paymentService->createReservePayment($dial);

        if($payment == null){
            throw new Exception("Оплата не создана");
        }

        return $this->redirect(['/payment', 'id' => $payment->id]);
    }


    public function actionConfirm($payment_id){
        $payment = Payment::findOne($payment_id);
        return $this->render('confirm', ['payment' => $payment ]);
    }

    public function actionAccept(){

        $payment_id = \Yii::$app->request->post('payment');
        $payment = Payment::findOne($payment_id);
        $order = $payment->request->order;
        $order->expert_id = $payment->request->expert_id;
        $order->save(false);
        return $this->redirect(['/lk/current']);
    }



    public function actionPackage_extend($id){

        $userPackage = UserPackage::findOne(['id' => $id]);
        $packageVariant = $userPackage->packageVariant;

        $payment = new Payment([
            'type' => Payment::TYPE_PACKAGE_EXTENSION,
            'user_package_id' => $userPackage->id,
            'status' => Payment::STATUS_DRAFT,
            'user_id' => $userPackage->user_id,
            'created' => date("Y-m-d H:i:s"),
            'service_name' => "Продление пакета",
            'sum' => $packageVariant->price
        ]);

        $payment->save(false);

        return $this->redirect(['/payment/payment', 'id' => $payment->id]);
    }


    /**
     * Выполняется регулярно и проверяет статусы выплат
     */
    public function actionCheckpayouts(){

        /** @var PaymentService $paymentService */
        $paymentService = \Yii::$app->paymentService;

        $payouts = Payout::findAll([
            'status' => Payout::STATUS_WAITING_CONFIRMATION
        ]);

        foreach($payouts as $payout) {
            try{
                $paymentService->checkPayout($payout);
            } catch (\Exception $e){
                \Yii::error($e->getMessage());
            }
        }
    }

}