<?php

namespace backend\controllers;

use common\classes\Oauth;
use common\classes\OAuthMail;
use common\interfaces\OauthInterface;
use common\models\User;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class OauthController extends Controller
{

    public function actionRegister($network){

        /** @var User $user */
        $user = \Yii::$app->user->identity;

        $oauth = \Yii::$app->oauth->get($network);

        $oauth_secure_key = uniqid();
        \Yii::$app->session->set('oauth_secure_key', $oauth_secure_key );

        $baseString = $user->id . $user->created_at . $oauth_secure_key ;
        $secure_key = hash_hmac('sha256', $baseString, $oauth->secretKey);

        $redirectUri = Url::to(['/oauth/link', 'oauth_secure' => $secure_key, 'network' => $network], true);

        return $this->redirect($oauth->authorizationUrl($redirectUri));
    }

    /**
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionLink(){

        /** @var User $user */
        $user = \Yii::$app->user->identity;

        $request = \Yii::$app->request;


        $error = $request->get('error');
        if($error){
            // ..
        }

        $network = $request->get('network');

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

        $redirectUrl = Url::to(['/oauth/link', 'oauth_secure' => $secure_key, 'network' => $network], true);

        $oauth->authorize($code, $redirectUrl);
        $uid = $oauth->getUid();

        $user->attachProfile($network, $uid);

        \Yii::warning("social network attached", __METHOD__);
        return $this->redirect(Url::to(['/users/edit', 'id' => $user->id]));
    }


    /**
     * @param $network
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionLogin($network){
        /** @var OauthInterface $oauthInterface */
        $oauthInterface = \Yii::$app->oauth->get($network);
        if($oauthInterface == null) {
            throw new BadRequestHttpException("неверный парамтр network");
        }

        $backRef = Url::to(['/oauth/auth', 'network' => $network], true);
        $url = $oauthInterface->authorizationUrl($backRef);
        return $this->redirect($url);
    }


    /**
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionAuth(){
        $request = \Yii::$app->request;
        $code = $request->get('code');
        $network = $request->get('network');

        \Yii::warning(print_r($code,true), __METHOD__);

        /** @var OauthInterface $oauthInterface */
        $oauthInterface = \Yii::$app->oauth->get($network);
        if($oauthInterface == null) {
            throw new BadRequestHttpException("неверный парамтр network");
        }

        $redirectUrl = Url::to(['/oauth/auth', 'network' => $network], true);

        $oauthInterface->authorize($code, $redirectUrl);
        $uid = $oauthInterface->getUid();

        if($user = User::findByUid($network, $uid)){
            \Yii::$app->user->login($user);
            \Yii::warning(print_r($user,true), __METHOD__);
        } else {
            //......
        }



        return $this->redirect(Url::home());
    }


    /**
     * @param $network
     * @return \yii\web\Response
     */
    public function actionUnlink($network){

        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $attribute = User::networkAttribute($network);
        $user->$attribute = null;
        $user->save(false);

        return $this->redirect(Url::to(['/users/edit', 'id' => $user->id]));

    }

}