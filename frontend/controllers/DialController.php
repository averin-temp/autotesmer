<?php
namespace frontend\controllers;

use common\classes\PayU;
use common\classes\Rating;
use common\models\Brief;
use common\models\Category;
use common\models\Dial;
use common\models\Order;
use common\models\Page;
use common\models\Payment;
use common\models\Payout;
use common\models\Request;
use common\models\Review;
use common\models\User;
use common\notifications\Notification;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class DialController extends Controller{


    /**
     * @return \yii\web\Response
     * @throws Exception
     * @throws ServerErrorHttpException
     */
    public function actionCreate(){

        $brief_id = \Yii::$app->request->post('brief');
        $brief = Brief::findOne($brief_id);
        $service = \Yii::$app->orderService;

        $dial = $service->createDial($brief);

        if($dial->type == Dial::TYPE_SAFE){
            $payment = $service->createReservationPayment($dial);
            return $this->redirect(['/payment/payment', 'id' => $payment->id]);
        }

        return $this->redirect(['/client/current']);
    }


    /**
     * Создает новую оплату для сделки
     *
     *
     * @param int $id ID сделки
     * @return \yii\web\Response
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionReserve($id){

        /** @var Dial $dial */
        $dial = Dial::findOne($id);
        if($dial == null) {
            throw new NotFoundHttpException("Не найдена сделка");
        }

        if($dial->status != Dial::STATUS_WAITING_RESERVATION){
            throw new Exception("Неверный статус сделки");
        }

        /** @var Payment $payment */
        $payment = $dial->payment;

        if($payment && $payment->status != Payment::STATUS_CANCELLED){

            if($payment->status == Payment::STATUS_DRAFT || $payment->status == Payment::STATUS_WAITING_CONFIRMATION) {
                return $this->redirect(['/payment', 'id' => $payment->id ]);
            }

            if($payment->status == Payment::STATUS_CONFIRMED){
                \Yii::error("Оплата с ID = {$payment->id} уже подтверждена, но сделка со статусом STATUS_WAITING_RESERVATION ", __METHOD__);
                throw new Exception("Произошла ошибка. Свяжитесь с администрацией.");
            }
        }

        $payment = \Yii::$app->orderService->createReservationPayment($dial);
        $dial->payment_id = $payment->id;
        $dial->save(false);

        return $this->redirect(['/payment', 'id' => $payment->id ]);
    }


    /**
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     */
    public function actionClose(){

        $request = \Yii::$app->request;

        $order_id = $request->post('order_id');
        $order = Order::findOne($order_id);

        if($order == null){
            throw new NotFoundHttpException("Не найден заказ");
        }

        $dial = $order->dial;

        if($dial == null){
            throw new NotFoundHttpException("Не найдена сделка");
        }

        $service = \Yii::$app->orderService;
        $service->closeDial($dial);


        $content = \Yii::$app->request->post('review');
        $evaluation = \Yii::$app->request->post('evaluation');

        if(empty($content))
            throw new ServerErrorHttpException("Отсутствует отзыв");
        if(empty($evaluation))
            throw new ServerErrorHttpException("Отсутствует оценка");

        $review = new Review();
        $review->content = $content;
        $review->to = $dial->expert_id;
        $review->from = $dial->client_id;
        $review->order_id = $dial->order_id;
        $review->evaluation = $evaluation;
        $review->save(false);

        $dial->expert->sendNotification('review_added');

        return $this->redirect(\Yii::$app->request->referrer);
    }


    /**
     * Отменяет сделку
     *
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionCancel(){

        $request = \Yii::$app->request;

        $dial_id = $request->post('id');
        $dial = Dial::findOne($dial_id);

        \Yii::$app->orderService->cancelDial($dial);

        return $this->redirect(['lk/current']);
    }


    public function actionMail(){

    }

}