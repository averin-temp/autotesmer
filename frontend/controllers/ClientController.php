<?php

namespace frontend\controllers;

use common\helpers\UserHelper;
use common\models\Appeal;
use common\models\Card;
use common\models\Chat;
use common\models\Dial;
use common\models\Dispute;
use common\notifications\Notification;
use common\models\NotificationsSettings;
use common\models\Order;
use common\models\User;
use common\models\UserPackage;
use common\notifications\NotificationType;
use frontend\models\ClientSettings;
use Yii;
use yii\base\InvalidArgumentException;
use yii\db\Query;
use yii\helpers\ArrayHelper;
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
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

/**
 * Orders controller
 */
class ClientController extends Controller
{

    public $defaultAction = 'current';
    /**
     * .
     *
     * @return mixed
     */
    public function actionCurrent() {
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $orders = $user->getOrders()->andWhere(['status' => Order::STATUS_WORK])->all();
        return $this->render('//lk/client/current', ['client' => $user, 'orders' => $orders ]);
    }


    public function actionImage(){

        \Yii::$app->response->format = Response::FORMAT_JSON;

        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $file = UploadedFile::getInstanceByName('image');

        $upload_dir = \Yii::getAlias('@uploads') . '/users/' . $user->id;
        if(!file_exists($upload_dir))
            mkdir($upload_dir);
        $filename = uniqid() . time() . '.' . $file->extension;
        $fullname = "$upload_dir/$filename";
        $file->saveAs($fullname);

        if($user->photo){
            $existing_filename = $upload_dir . '/' . $user->photo;
            if(file_exists($existing_filename)){
                unlink($existing_filename);
            }
        }

        $user->photo = $filename;
        $user->save(false);
        return ['imageSource' => $user->getAvatar() ];
    }

    public function actionSearch()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $orders = $user->getOrders()->andWhere(['status' => [ Order::STATUS_FREE, Order::STATUS_WAITING_RESERVATION ]])->all();
        $safeDialEnabled = $user->card ? true : false ;
        return $this->render('//lk/client/search', ['client' => $user, 'orders' => $orders, 'safeDialEnabled' => $safeDialEnabled]);
    }

    public function actionCompleted()
    {
        /** @var User $client */
        $client = \Yii::$app->user->identity;
        $orders = Order::findAll(['client_id' => $client->id, 'status' => Order::STATUS_CLOSED ]);
        return $this->render('//lk/client/completed', ['orders' => $orders, 'client' => $client]);
    }

    public function actionDisputes(){

        /** @var User $client */
        $client = \Yii::$app->user->identity;
        $disputes = Dispute::findAll(['client_id' => $client->id, 'status' => Dispute::STATUS_OPEN]);
        return $this->render('//lk/client/disputes', ['disputes' => $disputes]);

    }

    /**
     * @param $id
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionDispute($id){
        $user = \Yii::$app->user->identity;

        if(!$dispute = Dispute::findOne($id))
            throw new BadRequestHttpException("Неверный параметр");

        $chat = $dispute->clientChat;

        return $this->render('//lk/client/dispute', ['dispute' => $dispute, 'chat' => $chat, 'user' => $user ]);
    }


    /**
     * @return string
     */
    public function actionCards(){
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $cards = Card::findAll(['user_id' => $user->id]);
        return $this->render('//lk/client/settings-cards', [
            'user' => $user,
            'cards' => $cards
        ]);
    }




    /**
     * @return string|Response
     */
    public function actionSettings()
    {
        $user = \Yii::$app->user->identity;

        $model = new ClientSettings();
        if($model->load(\Yii::$app->request->post(),'')){
            if($model->save()){
                Notification::send('your_info_changed',['target_user' =>  $model->_user->id]);
                return $this->refresh();
            }
        }

        $cities = (new Query())->select(['id', 'name'])->from('city')->all();
        $socials = \Yii::$app->oauth->socials;
        return $this->render('//lk/client/settings', [
            'model' => $model,
            'user' => $user,
            'cities' => $cities,
            'socials' => $socials
        ]);
    }

    /**
     * @return string
     */
    public function actionContacts()
    {
        $user = \Yii::$app->user->identity;
        return $this->render('//lk/client/contacts', ['expert' => $user]);
    }

    /**
     * @return string
     */
    public function actionNotices()
    {
        $user = \Yii::$app->user->identity;
        $notifications = $user->notifications;
        return $this->render('//lk/client/notices', ['notifications' => $notifications ]);
    }

    /**
     * @return string|Response
     */
    public function actionNoticesoptions()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $settings = $user->notificationSettings;

        $descriptions = NotificationType::find()->select('name,description')->asArray()->all();
        $descriptions = ArrayHelper::map($descriptions, 'name', 'description');

        $settings->scenario = NotificationsSettings::SCENARIO_CLIENT;
        if($settings->load(\Yii::$app->request->post(),'')){
            $settings->save(false);
            return $this->refresh();
        }
        return $this->render('//lk/client/noticesoptions', ['settings' => $settings, 'descriptions' => $descriptions ,  'client' => $user] );
    }

    /**
     * @return string
     */
    public function actionExperts()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $experts = $user->favorites;
        return $this->render('//lk/client/choosen', [
            'client' => $user,
            'experts' => $experts
        ]);
    }

    public function actionCancel($order_id){
        $order = Order::findOne($order_id);
        \Yii::$app->orderService->cancelOrder($order);
    }
}