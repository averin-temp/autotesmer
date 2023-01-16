<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 30.09.2019
 * Time: 4:22
 */

namespace backend\controllers;

use common\models\PassportVerification;
use yii\filters\AccessControl;
use yii\web\Controller;

class VerificationsController extends Controller
{
    public $defaultAction = 'list';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list'],
                        'roles' => ['accessVerifications'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['verify', 'confirm', 'reject', 'delete'],
                        'roles' => ['editVerifications'],
                    ],
                ],
            ],
        ];
    }

    public function actionList(){
        $verifications = PassportVerification::findAll(['status' => [
            PassportVerification::STATUS_WAITING_VERIFICATION,
            PassportVerification::STATUS_REJECTED,
            PassportVerification::STATUS_VERIFYED
        ] ]);
        return $this->render('list', ['verifications' => $verifications]);
    }

    public function actionVerify($id){
        $verification = PassportVerification::findOne($id);
        return $this->render('view', ['verification' => $verification]);
    }

    public function actionConfirm(){
        $id = \Yii::$app->request->post('id');
        $verification = PassportVerification::findOne($id);

        $verification->status = PassportVerification::STATUS_VERIFYED;
        $verification->verification_date = date('Y.m.d H:i:s');
        $verification->save(false);

        $verification->user->sendNotification('documents_approved');

        \Yii::$app->session->setFlash('verification-list-report', ['message' => 'верификация подтверждена']);
        return $this->redirect('list');
    }

    public function actionReject($id){
        $verification = PassportVerification::findOne($id);

        $verification->status = PassportVerification::STATUS_REJECTED;
        $verification->verification_date = date('Y.m.d H:i:s');
        $verification->save(false);

        \Yii::$app->session->setFlash('verification-list-report', ['message' => 'в верификации отказано']);
        return $this->redirect('list');
    }

    public function actionDelete($id){
        PassportVerification::deleteAll(['id' => $id]);
        \Yii::$app->session->setFlash('verification-list-report', ['message' => 'верификация удалена']);
        return $this->redirect('list');
    }



}