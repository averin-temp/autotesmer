<?php

namespace frontend\controllers;

use common\models\ChatMessage;
use yii\base\Exception;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\Chat;
use yii\web\Response;

class ChatController extends Controller{

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $corsFilter = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['http://admin.autotesmer.ru'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => [],
            ]
        ];

        if(isset($behaviors['authenticator'])){
            $temp = $behaviors['authenticator'];
            unset($behaviors['authenticator']);

            $behaviors['corsFilter'] = $corsFilter;
            $temp['except'] = ['OPTIONS'];
            $behaviors['authenticator'] = $temp;
        } else {
            $behaviors['corsFilter'] = $corsFilter;
        }

        return $behaviors;
    }

    /**
     * @param $chat_id
     * @param $user_id
     * @param null $last_message
     * @param null $last_file
     * @return array
     * @throws BadRequestHttpException
     * @throws \yii\db\Exception
     */
    public function actionGet($chat_id, $user_id, $last_message = null, $last_file = null){

        \Yii::$app->response->format = Response::FORMAT_JSON;

        $chat = Chat::findOne($chat_id);

        if($chat == false)
        {
            return ['ok' => false, 'message' => 'Чат не найден'];
        }

        $messages = $chat->getMessages()->andWhere("id > $last_message")->all();
        $messages_ids = ArrayHelper::getColumn($messages, 'id');


        \Yii::$app->db->createCommand()
            ->update( ChatMessage::tableName(),
                [ 'viewed' => 1 ],
                [ 'and',
                    [ 'id' => $messages_ids],
                    [ 'not', "author_id = $user_id" ]
                ])->execute();

        foreach($messages as &$message){
            /** @var ChatMessage $message */
            $message->time = date_create($message->time)->format('H:i');
        }

        $files = $chat->getFiles()->andWhere("id > $last_file")->all();
        foreach($files as &$file){
            $file->image = Url::to('@web/img/', true) . $file->image;
            $file->dest = Url::to('@web/uploads/chats/' . $file->chat_id . '/' . $file->dest);
        }


        return ['ok' => true, 'messages' => $messages, 'files' => $files];
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionPost(){

        /*if(!\Yii::$app->request->isAjax)
            throw new BadRequestHttpException();
*/
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $request = \Yii::$app->request;

        try{

            if(!$chat_id = $request->post('chat'))
                throw new Exception("отсутствует параметр chat");

            if(!$user_id = $request->post('user')){
                $user_id = 0;
            }

            if(!$message = $request->post('message'))
                throw new Exception("отсутствует параметр message");

            if(!$chat = Chat::findOne($chat_id)){
                throw new Exception("не найден чат");
            }


            if( $user_id != $chat->user1_id && $user_id != $chat->user2_id){
                throw new Exception("указанный пользователь не является участником чата");
            }


            $message = new ChatMessage([
                'chat_id' => $chat->id,
                'text' => $message,
                'author_id' => $user_id,
            ]);

            $message->save(false);

        } catch (Exception $e){
            return ['ok' => false, 'message' => $e->getMessage()];
        }

        return ['ok' => true];

    }

}