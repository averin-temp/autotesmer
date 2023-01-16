<?php

namespace emulator\controllers;

use common\helpers\CurlHelper;
use emulator\models\Payout;
use yii\db\Query;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

/**
 * Main emulator controller
 */
class PayoutController extends Controller
{

    public function actionCheck(){
        $result = CurlHelper::post("http://autotesmer-test.local/payment/checkpayouts", []);
        \Yii::info($result, "payment-check");
    }



    public function actionSet(){
        $payout_id = \Yii::$app->request->post('outerId');
        $payout = Payout::findOne($payout_id);
        $payout->load(\Yii::$app->request->post());
        $payout->save();

        return $this->redirect(['/panel']);
    }

    public function actionSend()
    {
        \Yii::$app->response->format = Response::FORMAT_RAW;

        $payout = new Payout();
        $payout->load(\Yii::$app->request->post());
        $payout->save();

        return '{"9":"PENDING"}';
    }

    public function actionStatus($outerId)
    {

        \Yii::$app->response->format = Response::FORMAT_RAW;

        $payout = Payout::findOne($outerId);
        $statusIds = Payout::statuses();
        $status = $statusIds[$payout->status];

        if($status == "FINALIZED")
        {
            return '{"1":"success"}';
        }

        return '{"9":"PENDING"}';
    }


}