<?php

namespace frontend\controllers;

use common\classes\PayU;
use common\models\Payment;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;

/**
 * Class IpnController
 * @package frontend\controllers
 *
 *
 */
class IpnController extends Controller
{
    public function actionIndex(){
        \Yii::$app->response->format = Response::FORMAT_RAW;
        return \Yii::$app->paymentService->handleIpnQuery();
    }
}