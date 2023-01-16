<?php

namespace frontend\controllers;

use common\notifications\Notification;
use yii\web\Controller;
use yii\web\Response;

/**
 * Notifications controller
 */
class NotificationsController extends Controller
{

    public function actionWatched(){
        $messages = \Yii::$app->request->post('messages');
        Notification::updateAll(['readed' => 1],['id' => $messages]);
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ['ok' => true];
    }
}