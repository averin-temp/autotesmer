<?php

namespace frontend\controllers;

use common\models\Brief;
use frontend\models\RequestDialog;
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
use common\models\Request;
use yii\web\NotFoundHttpException;

/**
 * Orders controller
 */
class RequestsController extends Controller
{

    /**
     *
     * Удалить заявку
     *
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(){

        $id = (int)\Yii::$app->request->post('id');

        if($id == null)
        {
            throw new BadRequestHttpException("Не передан параметр id");
        }

        $request = Request::findOne($id);

        if($request == null)
        {
            throw new NotFoundHttpException("Заявка не найдена");
        }

        \Yii::$app->orderService->removeRequest($request);
        return $this->redirect(\Yii::$app->request->referrer);
    }


    /**
     * Отказать заявке
     *
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionRefuse(){

        $request_id = \Yii::$app->request->post('request');
        $request = Request::findOne($request_id);
        if($request == null)
        {
            throw new BadRequestHttpException("Не найдена заявка");
        }
        \Yii::$app->orderService->refuseRequest($request);
        return $this->redirect(\Yii::$app->request->referrer);
    }



}