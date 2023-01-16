<?php

namespace frontend\controllers;

use common\components\OrderService;
use common\helpers\UserHelper;
use common\interfaces\OauthInterface;
use common\models\Invite;
use common\models\Order;
use common\models\Package;
use common\models\PackageVariant;
use common\notifications\Notification;
use frontend\models\ClientRegistration;
use common\models\User;
use frontend\models\ExpertRegistration;
use Yii;
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
use yii\web\UploadedFile;

/**
* Orders controller
*/
class RegistrationController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Вход.
     *
     * @return mixed
     *
    /*public function actionSingin()
    {
        return $this->render('singin');
    }*/


    /**
     * Регистрация клиента.
     *
     * @return mixed
     * @throws \Exception
     */
    public function actionClient()
    {
        $model = new ClientRegistration();
        if($model->load(\Yii::$app->request->post(),'')){
            if($user = $model->save()){

                $activationLink = Url::to(['/registration/activate', 'key' => $user->activation_key], true);

                $result = \Yii::$app->mailer->compose()
                    ->setFrom('admin@autotesmer.ru')
                    ->setTo($user->email)
                    ->setSubject('Регистрация на сайте AUTOTESMER.RU')
                    ->setHtmlBody("Ссылка для активации вашего аккаунта: <a href='$activationLink'>$activationLink</a>")
                    ->send();

                return $this->render('mail-sended', ['key' => $user->activation_key]);
            }
        }

        $cities = (new \yii\db\Query())->select(['id', 'name'])->from('city')->orderBy('name')->all();
        return $this->render('client', ['model'=> $model, 'cities' => $cities]);
    }


    /**
     * @param $key
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionActivate($key){

        /** @var $user User */
        if(!$user = User::findOne(['activation_key' => $key])){
            return $this->render('wrongkey');
        }

        $user->activate();

        \Yii::$app->user->login($user);

        if($user->can('Эксперт'))
            return $this->render('congratulations', [ 'user' => $user ]);

        if($user->can('Клиент')){


            if(\Yii::$app->session->has('order')){

                $order = \Yii::$app->session->get('order');

                /** @var User $user */
                $user = \Yii::$app->user->identity;
                $order->client_id = $user->id;
                $order->client_city = $user->city_id;

                /** @var OrderService $orderService */
                $orderService = \Yii::$app->orderService;
                $orderService->addOrder($order);

                \Yii::$app->session->remove('order');
            }

            return $this->render('activated', [ 'user' => $user ]);
        }

    }

    /**
     * Регистрация эксперта.
     *
     * @return mixed
     */
    public function actionExpert()
    {
        $packages = Package::find()->limit(5)->all();

        return $this->render('expert', [
            'packages' => $packages
        ]);
    }


    /**
     * Регистрация эксперта.
     *
     * @return mixed
     * @throws \Exception
     */
    public function actionStep2()
    {
        $model = new ExpertRegistration();
        $model->image = UploadedFile::getInstanceByName('image');
        if($model->load(\Yii::$app->request->post(),'')){
            if($model->validate()){
                $user = $model->save();

                $activationLink = Url::to(['/registration/activate', 'key' => $user->activation_key], true);

                $result = \Yii::$app->mailer->compose()
                    ->setFrom('admin@autotesmer.ru')
                    ->setTo($user->email)
                    ->setSubject('Регистрация на сайте AUTOTESMER.RU')
                    ->setHtmlBody("Ссылка для активации вашего аккаунта: <a href='$activationLink'>$activationLink</a>")
                    ->send();

                return $this->render('mail-sended', ['key' => $user->activation_key]);
            }

        }
        return $this->render('step2', ['model' => $model]);
    }




    public function actionRegister_social($social, $type)
    {
        if(!$oauth = \Yii::$app->oauth->get($social))
            throw new BadRequestHttpException("Неверный параметр");

        /** @var User $user */

        $oauth_secure_key = uniqid();
        \Yii::$app->session->set('oauth_secure_key', $oauth_secure_key );

        $baseString = $oauth_secure_key ;
        $secure_key = hash_hmac('sha256', $baseString, $oauth->secretKey);

        $redirectUri = Url::to(['/registration/link', 'oauth_secure' => $secure_key, 'network' => $social, 'type' => $type ], true);

        return $this->redirect($oauth->authorizationUrl($redirectUri));
    }

    /**
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionLink()
    {
        /** @var User $user */
        $request = \Yii::$app->request;

        $error = $request->get('error');
        if($error){
            throw new BadRequestHttpException($error);
        }

        $network = $request->get('network');
        $type = $request->get('type');

        if($type != 1 && $type != 2){
            throw new BadRequestHttpException("неверный парамтр type");
        }

        /** @var OauthInterface $oauth */
        $oauth = \Yii::$app->oauth->get($network);
        if($oauth == null) throw new BadRequestHttpException("неверный парамтр network");

        $code = $request->get('code');
        if($code == null) throw new BadRequestHttpException("отсутствует параметр code");


        $secure_key = $request->get('oauth_secure');
        if($secure_key == null) throw new BadRequestHttpException("отсутствует параметр secure_key");

        $session =  \Yii::$app->session;
        $oauth_secure_key = $session->get('oauth_secure_key');
        $session->remove('oauth_secure_key');

        $baseString = $oauth_secure_key ;
        if($secure_key != hash_hmac('sha256', $baseString, $oauth->secretKey)){
            throw new BadRequestHttpException("неверная ссылка");
        }

        $redirectUri = Url::to(['/registration/link', 'oauth_secure' => $secure_key, 'network' => $network, 'type' => $type ], true);

        $oauth->authorize($code, $redirectUri);
        $uid = $oauth->getUid();

        if($user = User::findByUid($network, $uid)){
            throw new BadRequestHttpException("такой профиль уже зарегистрирован");
        }

        $info = $oauth->getInfo();

        $options = ['active' => 1];

        if($info['first_name']){
            $options['firstname'] = $info['first_name'];
        }

        if($info['last_name']){
            $options['family'] = $info['last_name'];
        }

        $image = null;
        if($info['image_url']){
            $image = file_get_contents($info['image_url']);
            if($image){
                \Yii::info('image_loaded', 'social_registration_test');
            }
        }

        if($type == 1){
            \Yii::info($options, 'user_registration');
            $user = UserHelper::createClient($options);
        } else {
            \Yii::info($options, 'user_registration');
            $user = UserHelper::createExpert($options);
        }

        $user->attachProfile($network, $uid);

        if($image){
            $upload_dir = \Yii::getAlias('@uploads') . '/users/' . $user->id;
            if(!file_exists($upload_dir))
                mkdir($upload_dir);

            $filename = uniqid() . time() . '.' . 'jpg';
            $fullname = "$upload_dir/$filename";
            file_put_contents($fullname,$image);

            $user->photo = $filename;
            $user->save(false);

            \Yii::info('image_saved', 'social_registration_test');
        }

        \Yii::warning("social network attached", __METHOD__);

        Invite::deleteAll(['user_id' => $user->id]);
        \Yii::$app->user->login($user);

        return $this->redirect(Url::to(['/lk/settings']));

    }


}