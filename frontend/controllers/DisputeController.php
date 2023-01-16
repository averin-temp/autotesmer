<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 26.07.2019
 * Time: 14:15
 */

namespace frontend\controllers;

use common\models\Appeal;
use common\models\Chat;
use common\models\Dial;
use common\models\Dispute;
use common\models\Order;
use common\models\User;
use common\notifications\Notification;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;


class DisputeController extends Controller
{

    /**
     * @param $dial_id
     * @return string
     * @throws ServerErrorHttpException
     */
    public function actionAppeal($dial_id)
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;

        if(!$dial = Dial::findOne($dial_id))
            throw new ServerErrorHttpException("указан неверный dial_id");

        if(!$user->can('Эксперт') && !$user->can('Клиент'))
            throw new ServerErrorHttpException("пользователь не является ни экспертом ни клиентом");

        if($user->id != $dial->client_id && $user->id != $dial->expert_id)
            throw new ServerErrorHttpException("пользователь не являетется участником сделки");

        $appeal = new Appeal([
            'dial_id' => $dial->id,
            'user_id' => $user->id,
        ]);

        if($appeal->load(\Yii::$app->request->post(),'')){
            if($appeal->validate()){

                $dispute = Dispute::findOne(['dial_id' => $dial->id, 'status' => Dispute::STATUS_OPEN ]);
                if($dispute){

                    if($dispute->client_id == $user->id){
                        $dispute->client_appeal_id = $appeal->id;
                    } elseif($dispute->expert_id == $user->id){
                        $dispute->expert_appeal_id = $appeal->id;
                    }

                    $dispute->save(false);

                } else {





                    $dispute = new Dispute();
                    $dispute->client_id = $dial->client_id;
                    $dispute->expert_id = $dial->expert_id;
                    $dispute->order_id = $dial->order_id;
                    $dispute->dial_chat_id = $dial->chat_id;
                    $dispute->dial_id = $dial->id;

                    if($user->can('Клиент'))
                        $dispute->client_appeal_id = $appeal->id;
                    else
                        $dispute->expert_appeal_id = $appeal->id;

                    $dispute->status = Dispute::STATUS_OPEN;
                    $dispute->save(false);

                    // chats
                    $chat = new Chat();
                    $chat->owner_id = $dispute->id;
                    $chat->user1_id = $dispute->client_id;
                    $chat->save(false);

                    $dispute->client_chat_id = $chat->id;

                    $chat = new Chat();
                    $chat->owner_id = $dispute->id;
                    $chat->user1_id = $dispute->expert_id;
                    $chat->save(false);

                    $dispute->expert_chat_id = $chat->id;

                    $dispute->save(false);

                    $dial->status = Dial::STATUS_DISPUTE;
                    $dial->dispute_id = $dispute->id;
                    $dial->save(false);
                }

                $appeal->dispute_id = $dispute->id;
                $appeal->save(false);

                if($user->can('Клиент')) Notification::send('client_created_appeal', ['target_user' => $dial->expert_id]);
                Notification::send('you_created_appeal', ['target_user' => $user->id]);

                return $this->redirect(['/lk/dispute', 'id' => $dispute->id ]);
            }
        }



        $view = $user->can('Эксперт') ? '//lk/expert/appeal': '//lk/client/appeal' ;

        return $this->render($view, ['appeal' => $appeal]);
    }

}