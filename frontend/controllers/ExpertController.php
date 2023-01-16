<?php

namespace frontend\controllers;

use common\classes\PayU;
use common\models\Brief;
use common\models\Card;
use common\models\Currency;
use common\models\Dispute;
use common\models\VehicleBrand;
use common\notifications\Notification;
use common\models\NotificationsSettings;
use common\models\Order;
use common\models\Package;
use common\models\PackageVariant;
use common\models\Payment;
use common\models\Request;
use common\models\User;
use common\models\UserPackage;
use common\models\VehicleModel;
use common\models\Video;
use common\notifications\NotificationType;
use frontend\models\ExpertInfoModel;
use frontend\models\VideoForm;
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
use frontend\models\ExpertSettings;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\web\NotFoundHttpException;


/**
 * Orders controller
 */
class ExpertController extends Controller
{

    public $defaultAction = 'current';
    /**
     *
     * @return mixed
     */
    public function actionCurrent()
    {
        $user = \Yii::$app->user->identity;
        $orders = Order::findAll(['expert_id' => $user->id, 'status' => Order::STATUS_WORK]);
        return $this->render('//lk/expert/current', [
            'expert' => $user,
            'orders' => $orders
        ]);
    }


    public function actionRequests()
    {

        $user = \Yii::$app->user->identity;
        $orders = Order::findAll(['expert_id' => $user->id, 'status' => Order::STATUS_FREE]);
        return $this->render('//lk/expert/current', ['expert' => $user, 'orders' => $orders]);
    }

    public function actionExpertise()
    {
        $user = \Yii::$app->user->identity;
        return $this->render('//lk/expert/expertise', ['expert' => $user]);
    }

    public function actionCompleted()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $completedOrders = $user->completedOrders;
        return $this->render('//lk/expert/completed', ['expert' => $user, 'orders' => $completedOrders]);
    }

    public function actionImage(){

        \Yii::$app->response->format = Response::FORMAT_JSON;

        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $file = UploadedFile::getInstanceByName('image');

        $basename = $file->basename;
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


    public function actionArbitration()
    {
        $user = \Yii::$app->user->identity;
        return $this->render('//lk/expert/arbitration', ['expert' => $user]);
    }

    public function actionSettings()
    {
        $settingsModel = new ExpertSettings();
        if($settingsModel->load(\Yii::$app->request->post(), '')){
            if($settingsModel->save()) {
                Notification::send('your_info_changed', ['target_user' => $settingsModel->_user->id]);
                return $this->refresh();
            }
        }
        $cities = (new Query())->select(['id', 'name'])->from('city')->all();
        $socials = \Yii::$app->oauth->socials;
        return $this->render('//lk/expert/settings_common', [
            'model' => $settingsModel,
            'cities' => $cities,
            'socials' => $socials
        ]);
    }

    public function actionContacts()
    {
        $user = \Yii::$app->user->identity;
        return $this->render('//lk/expert/contacts', ['expert' => $user]);
    }

    public function actionNew()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;

        $requests = Request::find()->leftJoin('orders', 'requests.order_id = orders.id')
            ->where([ 'requests.expert_id' => $user->id, 'requests.status' => [ Request::STATUS_WAITING_ACCEPTANCE, Request::STATUS_OPEN ] ])
            ->orWhere(['requests.expert_id' => $user->id, 'orders.status' => Order::STATUS_WAITING_RESERVATION, 'requests.status' => Request::STATUS_ACCEPTED])
            ->all();

        $params = [ 'expert' => $user, 'requests' => $requests ];

        if($briefForm = \Yii::$app->request->post()){
            $id = $briefForm['id'];
            $brief = Brief::findOne($id);
            if($brief == null)
            {
                throw new BadRequestHttpException("Бриф не найден");
            }

            if($brief->request->status == Request::STATUS_REFUSED)
            {
                throw new BadRequestHttpException("заявка отклонена");
            }

            $order = $brief->order;
            $brief->scenario = Brief::SCENARIO_CREATE;

            $brief->load($briefForm, '');
            if($brief->validate()){
                $brief->status = Brief::STATUS_SENDED;
                $brief->save(false);
                $request = $brief->request;
                $request->status = Request::STATUS_WAITING_ACCEPTANCE;
                $request->save(false);
            } else {

                $currencies = Currency::find()->all();
                $transmissions = Order::transmissions();
                $drives = Order::drives();
                $bodies = Order::bodies($order->category);
                $models = VehicleModel::find()->where(['brand_id' => $brief->mark_id])->orderBy('name')->all();
                $marks = VehicleBrand::find()->orderBy('name')->all();
                $form = $this->renderPartial('//brief/form', [
                    'model' => $brief,
                    'currencies' => $currencies,
                    'models' => $models,
                    'transmissions' => $transmissions,
                    'drives' => $drives,
                    'bodies' => $bodies,
                    'marks' => $marks
                ]);

                $params['posted_brief'] = $brief;
                $params['posted_brief_form'] = $form;

            }
        }

        return $this->render('//lk/expert/new', $params);
    }

    public function actionNoticesoptions()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $settings = $user->notificationSettings;

        $descriptions = NotificationType::find()->select('name,description')->asArray()->all();
        $descriptions = ArrayHelper::map($descriptions, 'name', 'description');

        $settings->scenario = NotificationsSettings::SCENARIO_EXPERT;
        if($settings->load(\Yii::$app->request->post(),'')){
            $settings->save(false);
            return $this->refresh();
        }
        return $this->render('//lk/expert/noticesoptions', ['expert' => $user, 'descriptions' => $descriptions, 'settings' => $settings]);
    }

    public function actionPackages()
    {
        $user = \Yii::$app->user->identity;
        $packages = Package::find()->all();
        return $this->render('//lk/expert/packages', ['expert' => $user, 'packages' => $packages]);
    }

    public function actionPackages_added()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $userPackages = $user->packages;
        return $this->render('//lk/expert/packages-added', ['expert' => $user, 'userPackages' => $userPackages ]);
    }

    public function actionInfo()
    {
        $user = \Yii::$app->user->identity;
        $model = new ExpertInfoModel($user->id);
        if($model->load( \Yii::$app->request->post() ,'')){
            if($model->save()){
                return $this->refresh();
            }
        }

        return $this->render('//lk/expert/settings_info', ['expert' => $user, 'model' => $model ]);
    }

    public function actionEditvideo($id = 0){


        if($id){
            if(!$video = Video::findOne($id))
                throw new NotFoundHttpException("Видео не найдено");
        } else {
            $video = new Video();
        }

        $video->scenario = Video::SCENARIO_EXPERT_UPLOAD;
        $video->user_id = \Yii::$app->user->identity->id;
        if($video->load(\Yii::$app->request->post(),'')){
            if($video->save()){
                return $this->redirect(['expert/editvideo', 'id' => $video->id]);
            }
        }

        return $this->render('//lk/expert/addvideo', ['video' => $video]);
    }


    public function actionRemovevideo($id){
        if(!$video = Video::findOne($id))
            throw new NotFoundHttpException("Видео не найдено");
        $video->delete();
        return $this->redirect(['expert/video']);
    }


    public function actionVideo()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $videos = Video::findAll(['user_id' => $user->id ]);
        return $this->render('//lk/expert/video', ['expert' => $user, 'videos' => $videos ]);
    }


    public function actionVariants($id){
        $expert = \Yii::$app->user->identity;
        $packageVariants = PackageVariant::findAll(['base_id' => $id]);
        return $this->render('//lk/expert/package-variants', [
            'variants' => $packageVariants,
            'expert' => $expert
        ]);
    }


    /**
     * Созадет пакет и оплату для него
     *
     * @param $package_id
     * @return Response
     * @throws \yii\base\Exception
     */
    public function actionBuy_package($package_id){

        /** @var User $expert */
        $expert = \Yii::$app->user->identity;

        $service = \Yii::$app->packageService;
        $package = $service->createUserPackage($package_id, $expert->id);
        $payment = $service->createPackagePayment($package, Payment::TYPE_PACKAGE_PAYMENT);

        return $this->redirect(['/payment/payment' , 'id' => $payment->id ]);
    }


    /**
     * @return string
     */
    public function actionCards(){
        $user = \Yii::$app->user->identity;
        $cards = Card::findAll(['user_id' => $user->id]);
        return $this->render('//lk/expert/settings-cards', [
            'user' => $user,
            'cards' => $cards
        ]);
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

        $chat = $dispute->expertChat;

        return $this->render('//lk/expert/dispute', ['dispute' => $dispute, 'chat' => $chat, 'user' => $user ]);
    }

    /**
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionDisputes(){
        /** @var User $client */
        $expert = \Yii::$app->user->identity;
        $disputes = Dispute::findAll(['expert_id' => $expert->id, 'status' => Dispute::STATUS_OPEN]);

        return $this->render('//lk/expert/disputes', ['disputes' => $disputes]);
    }

}