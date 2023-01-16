<?php

namespace frontend\controllers;

use common\models\Advertising;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use common\models\VehicleBrand;
/**
 * Orders controller
 */
class AdvertisingController extends Controller
{

    public function actionSend()
    {
        $model = new Advertising();

        if( $model->load(\Yii::$app->request->post()) && $model->save())
        {
            \Yii::$app->session->setFlash('advertising-message', "Ваше сообщение сохранено");
        }

        return $this->redirect(['/advertising']);
    }

    public function actionIndex()
    {
        $model = new Advertising();
        return $this->render('advertising', ['model' => $model]);
    }


}