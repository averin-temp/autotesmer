<?php

namespace frontend\controllers;

use common\models\Brief;
use common\models\Currency;
use common\models\Dial;
use common\models\Request;
use common\models\VehicleBrand;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use yii\web\View;
use common\models\VehicleModel;
use common\models\Order;

/**
 * Orders controller
 */
class BriefController extends Controller
{
    /**
     * @param $id
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionGet($id){
        if(!\Yii::$app->request->isAjax)
            throw new BadRequestHttpException("not ajax request");

        $brief = Brief::findOne($id);
        if($brief == null){
            return "Бриф не найден. Возможно заказ отменен или Ваша заявка отклонена";
        }
        $order = $brief->order;
        $currencies = Currency::find()->all();
        $marks = VehicleBrand::find()->orderBy('name')->all();
        $transmissions = Order::transmissions();
        $drives = Order::drives();
        $bodies = Order::bodies($order->category);

        return $this->renderAjax('form', [
            'model' => $brief,
            'currencies' => $currencies,
            'marks' => $marks,
            'transmissions' => $transmissions,
            'drives' => $drives,
            'bodies' => $bodies,
            'models' => [],
        ]);
    }

    public function actionView(){

        if(!\Yii::$app->request->isAjax)
            throw new BadRequestHttpException("не ajax");

        \Yii::$app->response->format = Response::FORMAT_JSON;

        $brief_id = \Yii::$app->request->post('id');
        $brief = Brief::findOne($brief_id);

        return $this->renderAjax('view', ['brief' => $brief ]);
    }




    public function actionSendbrif(){
        $request_id = \Yii::$app->request->post('request');
        $dial_type = \Yii::$app->request->post('dial_type');
        if($request_id) {
            $request = Request::findOne($request_id);
            $order = $request->order;

            if($dial_type != Dial::TYPE_SAFE)
                $dial_type = Dial::TYPE_NORMAL;

            $brief = new Brief([
                'order_id' => $order->id,
                'request_id' => $request->id,
                'status' => Brief::STATUS_FREE,
                'dial_type' => $dial_type
            ]);
            $brief->save(false);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

}