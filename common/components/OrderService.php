<?php

namespace common\components;

use common\components\PaymentService;
use common\classes\Rating;
use common\interfaces\PaymentInterface;
use common\models\Dispute;
use common\models\Payment;
use common\models\Payout;
use common\models\User;
use common\notifications\Notification;
use common\notifications\NotificationHelper;
use yii\base\Component;
use common\models\Order;
use common\models\Request;
use common\models\Dial;
use common\models\Brief;
use yii\base\Exception;
use yii\web\ServerErrorHttpException;

class OrderService extends Component implements PaymentInterface
{

    /**
     * Вызывается при успешной оплате
     *
     * @param Payment $payment
     */
    public function onSuccessPayment(Payment $payment){

        // успешное резервирование средств для сделки
        if($payment->type == Payment::TYPE_RESERVE){
            $dial = Dial::findOne($payment->target);
            $this->onRewardReserved($dial);
        }

    }

    /**
     * Вызывается при неудавшейся оплате
     *
     * @param Payment $payment
     */
    public function onCancelPayment(Payment $payment){
        // резервирование средств для сделки
        if($payment->type == Payment::TYPE_RESERVE){

        }
    }

    /**
     * Вызывается при успешной выплате
     *
     * @param Payout $payout
     * @throws Exception
     */
    public function onSuccessPayout(Payout $payout){

        // успешная выплата вознаграждения эксперту за сделку
        if($payout->type == Payout::TYPE_REWARD){
            $this->onRewardPaid($payout->target);
        }

        // успешная выплата возврата за сделку клиенту
        if($payout->type == Payout::TYPE_REFUND){
            $this->onRefundPaid($payout->target);
        }
    }

    public function onCancelPayout(Payout $payout){

        if($payout->type == Payout::TYPE_REWARD){
            Notification::send('reward_failed', ['target_user' => $payout->user_id] );
        }

        if($payout->type == Payout::TYPE_REFUND){
            Notification::send('refund_failed', ['target_user' => $payout->user_id] );
        }

    }


    /**
     * Выполняется при успешной выплате вознаграждения эксперту за сделку
     *
     * @param int $dial_id
     * @throws Exception
     */
    public function onRewardPaid($dial_id){
        $dial = Dial::findOne($dial_id);
        if($dial == null)
            throw new Exception("Не найдена сделка");

        $expert = $dial->expert;
        if($expert == null)
            throw new Exception("Не найден эксперт");

        Notification::send('reward_paid', ['target_user' => $expert->id]);
    }


    /**
     * Выполняется при успешном возврате клиенту вознаграждения за сделку
     *
     * @param int $dial_id
     * @throws Exception
     */
    public function onRefundPaid($dial_id){
        $dial = Dial::findOne($dial_id);
        if($dial == null)
        {
            throw new Exception("сделка не найдена");
        }
        Notification::send('refund_paid', ['target_user' => $dial->client_id]);
    }


    /**
     * @param $order \common\models\Order
     */
    public function addOrder($order){

        $order->publication_date = date_create()->format("Y-m-d H:i:s");
        $order->published = 1;
        $order->status = Order::STATUS_FREE;

        $order->original_body = $order->body;
        $order->original_year_from = $order->year_from;
        $order->original_mark = $order->mark_id;

        $order->save(false);
        $order->client->sendNotification('you_ordered_a_selection', [ 'order_id' => $order->id]);

        // отправка уведомлений
        if($order->client_city){
            $expertIds = \Yii::$app->authManager->getUserIdsByRole("Эксперт");
            $experts = User::find()->where(['id' => $expertIds, 'city_id' => $order->client_city ])->all();
            foreach($experts as $expert) {
                $expert->sendNotification('works_in_your_region');
            }
        }
    }

    /**
     * @param $order Order
     * @throws \Exception
     */
    public function closeOrder($order){
        $dial = $order->dial;
        $this->closeDial($dial);
    }

    /**
     * @param $dial Dial
     * @throws \Exception
     */
    public  function closeDial($dial){

        if($dial->type == Dial::TYPE_SAFE){
            $dial->expert->updateRating(Rating::COMPLETE_SAFE_DIAL_RATING_POINTS);
            $this->sendReward($dial);
        }

        if($dial->type == Dial::TYPE_NORMAL){
            $dial->expert->updateRating(Rating::COMPLETE_DIAL_RATING_POINTS);
        }

        $order = $dial->order;
        $dial->status = Dial::STATUS_COMPLETED;
        $order->status = Order::STATUS_CLOSED;
        $order->save(false);
        $dial->save(false);

        $dial->client->sendNotification('you_confirmed_work', ['order_id' => $dial->order_id]);
    }

    /**
     * Отправляет вознаграждение эксперту за сделку
     *
     * @param $dial Dial
     * @throws \Exception
     */
    private function sendReward($dial){
        /** @var PaymentService $paymentService */
        $paymentService = \Yii::$app->paymentService;

        $payout = new Payout();
        $payout->type = Payout::TYPE_REWARD;
        $payout->user_id = $dial->order->expert_id;
        $payout->dial_id = $dial->id;
        $payout->sum = $dial->reward;

        if(!$paymentService->sendPayout($payout)){
            $payout->user->sendNotification('wait_payment');
        }
    }


    /**
     * @param Request $request
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function cancelRequest($request){

        if($request->brief){
            $request->brief->delete();
        }

        $request->chat->delete();
        $request->delete();
    }


    /**
     * Отменяет заказ
     *
     * @param Order $order
     * @throws ServerErrorHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function cancelOrder($order){

        if($order->status == Order::STATUS_CLOSED){
            throw new ServerErrorHttpException("Попытка отменить закрытый заказ");
        }

        if($order->status == Order::STATUS_WORK ||
            $order->status == Order::STATUS_WAITING_RESERVATION ||
            $order->status == Order::STATUS_DISPUTE
        ){

            $dial = $order->dial;
            $this->cancelDial($dial);
            $order = Order::findOne($order->id);
        }

        if($order->status == Order::STATUS_FREE){
            foreach($order->requests as $request){
                $request->delete();
            }
        }

        $order->status = Order::STATUS_CANCELLED;
        $order->save(false);
    }


    /**
     * @param Dial $dial
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function cancelDial($dial){

        $order = $dial->order;
        $request = $dial->request;
        $brief = $dial->brief;

        $dial->status = Dial::STATUS_CANCELLED;
        $order->status = Order::STATUS_FREE;
        $request->status = Request::STATUS_OPEN;

        $order->expert_id = null;
        $order->dial_id = null;
        $order->body = $order->original_body;
        $order->mark_id = $order->original_mark;
        $order->year_from = $order->original_year_from;

        $order->save(false);
        $dial->save(false);
        $request->save(false);

        $brief->delete();

        if($dial->type == Dial::TYPE_SAFE){
            if($payment = $dial->payment){
                \Yii::$app->paymentService->cancelPayment($payment);
            }
        }
    }


    /**
     * @param Dial $dial
     * @throws \Exception
     */
    private function sendRefund($dial){

        $payout = new Payout();
        $payout->type = Payout::TYPE_REFUND;
        $payout->user_id = $dial->order->expert_id;
        $payout->dial_id = $dial->id;
        $payout->sum = $dial->reward;

        \Yii::$app->paymentService->sendPayout($payout);
    }



    /**
     * @param Dial $dial
     */
    public function onRefund($dial){
        // ничего не надо делать
    }


    /**
     * Добавляет заявку заказу
     *
     * @param Request $request
     * @return Request
     * @throws ServerErrorHttpException
     */
    public function addRequest($request){

        $order = $request->order;

        if($result = $order->getRequests()->where([
            'expert_id' => $request->expert_id,
            'order_id' => $request->order_id,
            'status' => Request::STATUS_OPEN
        ])->one() ) {
            throw new ServerErrorHttpException("Повторное создание заявки");
        }

        $request->status = Request::STATUS_OPEN;
        $request->save(false);

        return $request;
    }




    /**
     * Вызывается когда вознаграждение за заказ зарезервировано
     *
     * @param Dial $dial
     */
    public function onRewardReserved($dial){

        $dial->status = Dial::STATUS_WORK;
        $dial->save(false);

        $order = $dial->order;
        $order->status = Order::STATUS_WORK;
        $order->save(false);

        $dial->client->sendNotification('you_made_a_deposit', ['dial_id' => $dial->id]);
    }



    public function onPackagePaid($package){

    }



    /**
     * @param Request $request
     */
    public function refuseRequest($request){
        $request->status = Request::STATUS_REFUSED;
        $request->save(false);
    }


    /**
     * @param Request $request
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function removeRequest($request){

        if($request->status == Request::STATUS_OPEN || $request->status == Request::STATUS_WAITING_ACCEPTANCE){
            $request->delete();
        }
    }


    /**
     * @param Dial $dial
     * @return Payment
     * @throws Exception
     */
    public function createReservationPayment(&$dial){

        if($dial->type != Dial::TYPE_SAFE){
            throw new Exception("Неверный тип сделки");
        }

        $service = \Yii::$app->paymentService;

        $payment = $service->createPayment(
            $dial->client_id,
            Payment::TYPE_RESERVE,
            $dial->id,
            $dial->reward,
            "Резервирование средств"
        );

        $dial->payment_id = $payment->id;
        $dial->save(false);

        return $payment;
    }


    /**
     * @param Brief $brief
     * @return Dial
     * @throws ServerErrorHttpException
     */
    public function createDial($brief){

        if($brief->status != Brief::STATUS_SENDED)
            throw new ServerErrorHttpException("Статус брифа не подходит для создания заказа");

        $order = $brief->order;

        if($order->status != Order::STATUS_FREE){
            throw new ServerErrorHttpException("Статус заказа не позволяет выбрать исполнителя");
        }

        $request = $brief->request;

        if($request->status != Request::STATUS_WAITING_ACCEPTANCE){
            throw new ServerErrorHttpException("Статус заявки не позволяет создать сделку");
        }

        $brief->status = Brief::STATUS_ACCEPTED;
        $brief->reward = $brief->request->price;
        $brief->save(false);

        $dial = new Dial();

        $dial->order_id = $order->id;
        $dial->client_id = $order->client_id;
        $dial->expert_id = $request->expert_id;
        $dial->request_id = $request->id;
        $dial->chat_id = $request->chat_id;
        $dial->type = $brief->dial_type;
        $dial->brief_id = $brief->id;
        $dial->reward = $brief->reward;

        $order->expert_id = $dial->expert_id;

        $order->body = $brief->body;
        $order->mark_id = $brief->mark_id;
        $order->year_from = $brief->year_from;

        if($dial->type == Dial::TYPE_SAFE) {
            $dial->status = Dial::STATUS_WAITING_RESERVATION;
            $order->status = Order::STATUS_WAITING_RESERVATION;
        }

        if($dial->type == Dial::TYPE_NORMAL) {
            $dial->status = Dial::STATUS_WORK;
            $order->status = Order::STATUS_WORK;
        }

        $request->status = Request::STATUS_ACCEPTED;
        $request->save(false);

        $dial->save(false);
        $order->dial_id = $dial->id;
        $order->save(false);

        if($dial->type == Dial::TYPE_SAFE) {
            Notification::send('you_have_secured_a_deal',['target_user' => $dial->expert_id, 'dial_id' => $dial->id]);
            Notification::send('you_have_secured_a_deal',['target_user' => $dial->client_id, 'dial_id' => $dial->id]);
        }

        return $dial;
    }


    /**
     * @param Dial $dial
     */
    public function createDispute($dial){



    }

    /**
     * @param Dispute $dispute
     * @param int $decision
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function closeDispute($dispute, $decision){

        $dispute->status = Dispute::STATUS_CLOSED;
        $dispute->save(false);

        /** @var Dial $dial */
        $dial = $dispute->dial;

        switch ($decision){
            case Dispute::DECISION_CONTINUE_DIAL :
                $dial->status = Dial::STATUS_WORK;
                $dial->dispute_id = null;
                $dial->save(false);
                break;
            case Dispute::DECISION_CLOSE_DIAL :
                $this->closeDial($dial);
                break;
            case Dispute::DECISION_CANCEL_DIAL :
                $this->cancelDial($dial);
                break;
        }

        Notification::send('arbitration_closed',['target_user' => $dispute->expert_id]);
        Notification::send('arbitration_closed',['target_user' => $dispute->client_id]);
    }

}