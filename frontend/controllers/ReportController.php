<?php

namespace frontend\controllers;

use common\classes\VehicleCategory;
use common\classes\VehicleProperties;
use common\models\Chat;
use common\models\Country;
use common\models\Dial;
use common\models\File;
use common\models\Order;
use common\models\Report;
use common\models\ReportAuto;
use common\models\VehicleBrand;
use common\models\VehicleModel;
use common\notifications\Notification;
use Yii;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

/**
 * Orders controller
 */
class ReportController extends Controller
{

    public function actionIndex($dialID)
    {

        $dial = Dial::findOne($dialID);
        if($dial == null) {
            throw new ServerErrorHttpException("Сделка не найдена");
        }

        $order = $dial->order;

        if(empty($order))
            throw new NotFoundHttpException("Не найден заказ");

        if($order->status == Order::STATUS_CANCELLED)
        {
            throw new BadRequestHttpException("Заказ отменен");
        }


        if($order->status == Order::STATUS_CLOSED)
        {
            throw new BadRequestHttpException("Заказ закрыт");
        }

        switch($order->category){
            case 1:
                $model = new ReportAuto();
                $view = 'auto';
                break;
            case 2:
                $model = new ReportAuto();
                $view = 'auto';
                break;
            case 3:
                $model = new ReportAuto();
                $view = 'auto';
                break;
            case 4:
                $model = new ReportAuto();
                $view = 'auto';
                break;
            case 5:
                $model = new ReportAuto();
                $view = 'auto';
                break;
        }

        $model->chat_id = $dial->chat_id;

        return $this->render( $view, [ 'model' => $model ]);
    }


    /**
     * @return array
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     * @throws ServerErrorHttpException
     */
    public function actionSend(){

        $request = \Yii::$app->request;

        if(!$request->isAjax){
            throw new BadRequestHttpException("неверный формат запроса");
        }

        $category = $request->post('category');

        if(!$category) {
            throw new ServerErrorHttpException("отсутствует параметр category");
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;

        $user = \Yii::$app->user->identity;

        if(!$user || !$user->can("Эксперт"))
            throw new ForbiddenHttpException("вы не являетесь экспертом");

        if($category == VehicleCategory::AUTO){
            $model = new ReportAuto();
        } else {
            $model = new ReportAuto();
        }

        $model->load($request->post(),'');
        $model->loadFiles();
        if($model->validate()){
            $model->expert_id = \Yii::$app->user->identity->id;
            $model->uploadFiles();
            $model->save();

            $dial = Dial::findOne(['chat_id' => $model->chat_id]);
            $client_id = $dial->client_id;

            // уведомление клиенту о получении отчета
            Notification::send('report_received',['target_user' => $client_id]);

            return [
                'ok' => true,
                'redirect' => Url::to(['/expert/current'])
            ];
        } else {
            return [
                'ok' => false,
                'errors' => $model->errors
            ];
        }
    }


    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionAjax(){

        if(!\Yii::$app->request->isAjax){
            throw new BadRequestHttpException("неверный формат запроса");
        }

        $action = \Yii::$app->request->post('action');
        if($action == 'field' ){

            $field = \Yii::$app->request->post('field');
            if($field == 'brand'){

                $value = \Yii::$app->request->post('value');

                $models = VehicleModel::findAll(['brand_id' => $value]);

                $html = '';
                foreach($models as $model){
                    $html .= "<option value='$model->id'>$model->name</option>";
                }

                return $html;
            }

        }elseif($action == 'validate'){
            \Yii::$app->response->format = Response::FORMAT_JSON;

            $category = \Yii::$app->request->post('category');
            $stage = \Yii::$app->request->post('stage');
            $chat_id = \Yii::$app->request->post('chat');

            $chat = Chat::findOne($chat_id);

            if($chat == null)
            {
                // TODO:
            }

            if($chat_id)

            switch($category){
                case VehicleCategory::AUTO:
                    $model = new ReportAuto();
            }

            $model->scenario = 'stage_' . $stage;

            if($model->load(\Yii::$app->request->post(), '')){

                $model->loadFiles();
                $model->validate();
                return $model->errors;
            }
        }
    }

}