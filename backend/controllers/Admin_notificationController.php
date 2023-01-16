<?php

namespace backend\controllers;

use common\models\AdminNotification;
use common\models\Advertising;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;


class Admin_notificationController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['accessBackend'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){

        $user = \Yii::$app->user->identity;

        AdminNotification::updateAll( ['viewed' => 1] , ['target_id' => $user->id ,'viewed' => 0] );
        $models = AdminNotification::find()->where([
            'target_id' => $user->id,
        ])->all();

        return $this->render('index', ['models' => $models]);
    }
}