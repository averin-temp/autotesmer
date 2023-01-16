<?php

namespace backend\controllers;

use common\models\Dial;
use common\models\Dispute;
use common\models\Payout;
use common\notifications\Notification;
use Yii;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class DisputesController extends Controller{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['accessArbitrage'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['dispute', 'decision'],
                        'roles' => ['editArbitrage'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex(){
        $disputes = Dispute::find()->all();
        return $this->render('index', ['disputes' => $disputes]);
    }

    public function actionDispute($id){
        $dispute = Dispute::findOne($id);
        $messages = $dispute->dialChat->getMessages()->orderBy('time')->all();
        $user = \Yii::$app->user->identity;
        return $this->render('dispute', [
            'dispute' => $dispute,
            'messages' => $messages,
            'user' => $user
        ]);
    }

    /**
     * $type :  1 - сделка продолжается.
     * 2 - сделка закрывается в пользу клиента
     * 3 - сделка закрывается в пользу эксперта
     *
     *
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDecision(){

        $request = \Yii::$app->request;

        $dispute_id = $request->post('dispute_id' );
        $type = $request->post('type' );

        $dispute = Dispute::findOne($dispute_id);


        if($dispute->status == Dispute::STATUS_CLOSED){
            throw new BadRequestHttpException("спор закрыт");
        }

        \Yii::$app->orderService->closeDispute($dispute,$type);



        return $this->redirect(['/disputes' ]);
    }

}