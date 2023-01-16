<?php

namespace frontend\controllers;

use common\models\Card;
use common\models\CardRegistrationRequest;
use common\models\ChatMessage;
use common\models\Request;
use common\models\User;
use common\notifications\Notification;
use yii\base\Exception;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\Chat;
use yii\web\Response;

class CardController extends Controller{

    public function actionRegister(){

        \Yii::$app->response->format = Response::FORMAT_RAW;

        $request = \Yii::$app->request;

        $request_id = $request->post('RequestID');
        $token = $request->post('Token');

        try{

            if(!($request_id && $token)){
                throw new Exception("ошибка параметров request_id = '$request_id' , 'token' = $token");
            }

            if(!$cardRegistrationRequest = CardRegistrationRequest::findOne($request_id))
            {
                throw new Exception("не найден cardRegistrationRequest");
            }

            if( $cardRegistrationRequest->status == CardRegistrationRequest::STATUS_CONFIRMED)
            {
                throw new Exception("запрос уже подтвержден  STATUS_CONFIRMED");
            }

            $card = new Card();
            $card->token = $token;
            $card->user_id = $cardRegistrationRequest->user_id;
            if($card->save(false) == false)
            {
                throw new Exception("карта не сохранена");
            }

            $cardRegistrationRequest->status = CardRegistrationRequest::STATUS_CONFIRMED;
            $cardRegistrationRequest->save(false);

            \Yii::warning("карта сохранена " . print_r($card, true), __METHOD__);
            Notification::send('card_registered', ['target_user' => $card->user_id]);

        } catch (Exception $e){
            \Yii::error($e->getMessage(), __METHOD__);
        }

        return "OK";
    }


    /**
     * @return string
     * @throws BadRequestHttpException
     * @throws \yii\db\Exception
     */
    public function actionRegform(){

        $request = \Yii::$app->request;

        if(!$request->isAjax)
            throw new BadRequestHttpException("не ajax запрос");

        $user_id = $request->post('user_id');
        $user = User::findOne($user_id);

        \Yii::$app->db->createCommand()->insert('card_registration_request', ['user_id' => $user->id ])->execute();
        $requestId = \Yii::$app->db->lastInsertID;

        $fields = \Yii::$app->paymentService->cardRegistrationFormFields($user, Url::to(['/lk/cards'], true), $requestId );
        $formUrl = \Yii::$app->PayU->url_card_registration;

        return $this->renderAjax('registration-form', [
            'user' => $user,
            'fields' => $fields,
            'formUrl' => $formUrl
        ]);
    }

}