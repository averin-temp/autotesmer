<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 05.08.2019
 * Time: 8:21
 */

namespace common\classes;


use common\interfaces\OauthInterface;
use common\models\User;
use yii\helpers\Url;

class OAuthMail implements OauthInterface
{

    public $name = 'mail.ru';

    public $id;
    public $privateKey;
    public $secretKey;

    public $authorizationUrl = 'https://connect.mail.ru/oauth/authorize';
    public $tokenUrl = 'https://connect.mail.ru/oauth/token';
    public $apiUrl = 'http://www.appsmail.ru/platform/api';

    public $access_token;


    public function authorizationUrl($redirectUri){

        $params = [
            'client_id' => $this->id,
            'response_type' => 'code',
            'redirect_uri' => $redirectUri,
        ];

        return $this->authorizationUrl . '?' . http_build_query($params);
    }

    function signature(array $request_params, $secret_key) {
        ksort($request_params);
        $params = '';
        foreach ($request_params as $key => $value) {
            $params .= "$key=$value";
        }
        return md5($params . $secret_key);
    }

    /**
     * @param $code
     * @param $redirectUri
     * @return bool
     */
    public function authorize($code, $redirectUri){

        $posts = [
            'client_id' => $this->id,
            'client_secret' => $this->secretKey,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUri
        ];

        \Yii::warning(print_r($posts,true), __METHOD__);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->tokenUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$posts);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($ch);
        curl_close($ch);
        \Yii::warning(print_r($response,true), __METHOD__);
        $result = json_decode($response);

        if($result == false)
            return false;

        $this->access_token = $result->access_token;

        return true;
    }

    public function getUid(){
        $result =  $this->method('users.getInfo');
        return $result->uid;
    }


    public function method($methodName, $params = []){

        $params['method'] = $methodName;
        $params['app_id'] = $this->id;
        $params['session_key'] = $this->access_token;
        $params['secure'] = 1;
        $params['format'] = 'json';

        $sig = $this->signature($params, $this->secretKey);

        $params['sig'] = $sig;

        \Yii::warning(print_r($params,true), __METHOD__);

        $apiUrl = $this->apiUrl . '?' . http_build_query($params);

        \Yii::warning(print_r($apiUrl,true), __METHOD__);

        $response = file_get_contents($apiUrl);

        \Yii::warning(print_r($response,true), __METHOD__);

        $result = json_decode($response);
        return $result[0];
    }


    public function getInfo()
    {

        $result = $this->method('users.getInfo');

        $out = [
            'image_url' => '',
            'first_name' => '',
            'last_name' => '',
        ];


        if(isset($result->pic_small))
        {
            $out['image_url'] = $result->pic_small;
        }

        if(isset($result->first_name))
        {
            $out['first_name'] = $result->first_name;
        }

        if(isset($result->last_name))
        {
            $out['last_name'] = $result->last_name;
        }

        \Yii::info($out, 'social_registration_test');
        return $out;
    }

}