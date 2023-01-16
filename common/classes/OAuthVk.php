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

class OAuthVk implements OauthInterface
{

    public $name = 'vk';

    public $id;
    public $privateKey;
    public $secretKey;

    public $authorizationUrl = 'https://oauth.vk.com/authorize';
    public $tokenUrl = 'https://oauth.vk.com/access_token';
    public $apiUrl = 'https://api.vk.com/method/';
    public $version = '5.101';

    public $access_token;
    public $user_id;


    public function authorizationUrl($redirectUri){

        $params = [
            'client_id' => $this->id,
            'response_type' => 'code',
            'display' => 'popup',
            'redirect_uri' => $redirectUri,
        ];

        return $this->authorizationUrl . '?' . http_build_query($params);
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
        $this->user_id = $result->user_id;
        return true;
    }

    public function getUid(){
        return $this->user_id;
    }


    public function method($methodName, $params = []){

        $params['client_id'] = $this->id;
        $params['access_token'] = $this->access_token;
        $params['v'] = $this->version;

        \Yii::warning(print_r($params,true), __METHOD__);

        $apiUrl = $this->apiUrl . '/' . $methodName . '?' . http_build_query($params);
        \Yii::warning(print_r($apiUrl,true), __METHOD__);

        $response = file_get_contents($apiUrl);
        \Yii::warning(print_r($response,true), __METHOD__);

        $result = json_decode($response);
        return $result[0];
    }


    public function getInfo()
    {



        $fields = [
            'user_ids' => $this->user_id,
            'fields' => 'photo_400',
            'access_token' => $this->access_token,
            'v' => 5.103,
        ];

        \Yii::info($fields, 'social_registration_test');

        $url = 'https://api.vk.com/method/users.get?' . http_build_query($fields);

        \Yii::info($url, 'social_registration_test');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        \Yii::info($output, 'social_registration_test');
        curl_close($ch);

        $data = json_decode($output);

        \Yii::info($data, 'social_registration_test');
        $out = [
            'image_url' => '',
            'first_name' => '',
            'last_name' => '',
        ];
        if(isset($data->response))
        {
            $founded = null;
            foreach($data->response as $data){

                if(isset($data->id) && $data->id == $this->user_id)
                {
                    $founded = $data;
                    break;
                }
            }

            if($founded)
            {
                if(isset($founded->photo_400))
                {
                    $out['image_url'] = $founded->photo_400;
                }

                if(isset($founded->first_name))
                {
                    $out['first_name'] = $founded->first_name;
                }

                if(isset($founded->last_name))
                {
                    $out['last_name'] = $founded->last_name;
                }
            }
        }
        \Yii::info($out, 'social_registration_test');
        return $out;
    }

}