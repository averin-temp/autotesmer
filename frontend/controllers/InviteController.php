<?php
namespace frontend\controllers;

use common\interfaces\OauthInterface;
use common\models\Category;
use common\models\Invite;
use common\models\Page;
use common\models\User;
use frontend\models\InviteForm;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * Class InviteController
 * @package frontend\controllers
 *
 *
 */
class InviteController extends Controller{


    public $layout = 'invite';

    /**
     * @param $key
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionIndex($key){

        $user = User::findByInviteKey($key);
        if($user == null){
            throw new BadRequestHttpException("неверный ключ");
        }

        return $this->render('welcome', ['user' => $user, 'key' => $key ]);
    }

    /**
     *
     * Вход по email
     *
     * @param $key
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionEnter_by_email(){

        $key = \Yii::$app->request->get('key');
        if(!$key) $key = \Yii::$app->request->post('key');

        if(!($key && $user = User::findByInviteKey($key))){
            throw new BadRequestHttpException("неверный ключ");
        }

        $model = new InviteForm(['key' => $key]);
        if($model->load(\Yii::$app->request->post()) && $model->attachEmail())
        {
            return $this->redirect($user->profileUrl);
        }

        return $this->render('continue', [ 'model' => $model, 'user' => $user ]);
    }

    /**
     * Вход по соц. сети
     * @param $social
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionEnter_by_social($social, $key){

        if(!$oauth = \Yii::$app->oauth->get($social))
            throw new BadRequestHttpException("Неверный параметр");

        /** @var User $user */
        $user = User::findByInviteKey($key);
        if(!$user){
            throw new BadRequestHttpException("неверные параметры");
        }

        $oauth_secure_key = uniqid();
        \Yii::$app->session->set('oauth_secure_key', $oauth_secure_key );

        $baseString = $user->id . $user->created_at . $oauth_secure_key ;
        $secure_key = hash_hmac('sha256', $baseString, $oauth->secretKey);

        $redirectUri = Url::to(['/invite/link', 'oauth_secure' => $secure_key, 'network' => $social, 'key' => $key], true);

        return $this->redirect($oauth->authorizationUrl($redirectUri));
    }


    /**
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionLink(){

        /** @var User $user */
        $request = \Yii::$app->request;

        $error = $request->get('error');
        if($error){
            // ..
        }

        $network = $request->get('network');
        $key = $request->get('key');

        $user = User::findByInviteKey($key);
        if(!$user) throw new BadRequestHttpException("пользователь не найден");

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

        $baseString = $user->id . $user->created_at . $oauth_secure_key ;
        if($secure_key != hash_hmac('sha256', $baseString, $oauth->secretKey)){
            throw new BadRequestHttpException("неверная ссылка");
        }

        $redirectUri = Url::to(['/invite/link', 'oauth_secure' => $secure_key, 'network' => $network, 'key' => $key], true);

        $oauth->authorize($code, $redirectUri);
        $uid = $oauth->getUid();

        $user->attachProfile($network, $uid);

        \Yii::warning("social network attached", __METHOD__);

        Invite::deleteAll(['user_id' => $user->id]);
        \Yii::$app->user->login($user);

        return $this->redirect(Url::to(['/lk/settings']));
    }

}