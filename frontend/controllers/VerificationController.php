<?php

namespace frontend\controllers;

use common\classes\PayU;
use common\models\PassportVerification;
use common\models\Payment;
use common\models\User;
use common\notifications\Notification;
use yii\base\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Request;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;
use yii\web\UploadedFile;
use yii\base\DynamicModel;

/**
 * Class IpnController
 * @package frontend\controllers
 *
 *
 */
class VerificationController extends Controller
{
    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionStart(){

        $request = \Yii::$app->request;

        if(!$request->isAjax){
            throw new BadRequestHttpException("неверный формат запроса");
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;


        try
        {
            if(!\Yii::$app->user->can("Эксперт"))
            {
                throw new Exception("Вы не являетесь экспертом");
            }

            /** @var User $user */
            $user = \Yii::$app->user->identity;

            $verification = new PassportVerification([
                'user_id' => $user->id,
                'status' => PassportVerification::STATUS_NEW,
                'scenario' => PassportVerification::SCENARIO_START
            ]);

            $verification->load($request->post(),'');
            if($verification->validate())
            {
                $verification->status = PassportVerification::STATUS_UPLOAD_PASSPORT;
                $verification->save(false);
                $content = $this->renderAjax('//widgets/passport-verification/passport-upload', ['verification' => $verification ]);
                return ['ok' => true, 'content' => $content ];
            }

            $content = $this->renderAjax('//widgets/passport-verification/start', ['verification' => $verification ]);
        }
        catch (Exception $e)
        {
            return ['ok' => false, 'content' => $e->getMessage() ];
        }

        return ['ok' => true, 'content' => $content ];
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionPassportphoto(){

        $request = \Yii::$app->request;
        if(!$request->isAjax){
            throw new BadRequestHttpException("неверный формат запроса");
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {

            if(!\Yii::$app->user->can('Эксперт'))
            {
                throw new Exception("Вы не являетесь экспертом");
            }

            /** @var User $user */
            $user = \Yii::$app->user->identity;

            /** @var PassportVerification $verification */
            $verification = $user->verification;

            if($verification == null)
            {
                throw new Exception("Не найдена верификация");
            }

            if($verification->status != PassportVerification::STATUS_UPLOAD_PASSPORT)
            {
                throw new Exception("Неверный статус верификации");
            }

            $verification->scenario = PassportVerification::SCENARIO_UPLOAD_PASSPORT;
            $verification->passport_photo = UploadedFile::getInstanceByName('passport_photo');

            if($verification->validate() == false)
            {
                throw new Exception($verification->getFirstError('passport_photo'));
            }

            $verification->status = PassportVerification::STATUS_UPLOAD_SELFIE;

            if(!$verification->save(false))
            {
                throw new Exception("Ошибка при сохранении файла");
            }

            $content =  $this->renderAjax('//widgets/passport-verification/selfie-upload', [
                'verification' => $verification,
            ]);

            return [
                'ok' => true,
                'content' => $content
            ];

        } catch (Exception $e) {

            return [
                'ok' => false,
                'content' => $e->getMessage(),
            ];
        }
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPassportselfie(){


        $request = \Yii::$app->request;
        if(!$request->isAjax){
            throw new BadRequestHttpException("неверный формат запроса");
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;

        try {

            if(!\Yii::$app->user->can('Эксперт'))
            {
                throw new Exception("Вы не являетесь экспертом");
            }

            /** @var User $user */
            $user = \Yii::$app->user->identity;

            /** @var PassportVerification $verification */
            $verification = $user->verification;

            if($verification == null)
            {
                throw new Exception("Не найдена верификация");
            }

            if($verification->status != PassportVerification::STATUS_UPLOAD_SELFIE)
            {
                throw new Exception("Неверный статус верификации");
            }

            $verification->scenario = PassportVerification::SCENARIO_UPLOAD_SELFIE;
            $verification->passport_selfie = UploadedFile::getInstanceByName('selfie_photo');

            if($verification->validate() == false)
            {
                throw new Exception($verification->getFirstError('passport_selfie'));
            }

            $verification->status = PassportVerification::STATUS_WAITING_VERIFICATION;

            if(!$verification->save(false))
            {
                throw new Exception("Ошибка при сохранении файла");
            }

            // отправляет уведомление администратору
            Notification::send('new_verification', [
                'target_user' => 1,
                'verification_id' => $verification->id
            ]);

            $content =  $this->renderAjax('//widgets/passport-verification/waiting', ['verification' => $verification ]);

            return [
                'ok' => true,
                'content' => $content
            ];

        } catch (Exception $e) {

            return [
                'ok' => false,
                'content' => $e->getMessage()
            ];
        }
    }

}