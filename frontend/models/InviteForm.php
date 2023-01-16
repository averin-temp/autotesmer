<?php
namespace frontend\models;

use common\models\City;
use common\models\Invite;
use common\models\User;
use common\validators\NameValidator;
use common\validators\PhoneValidator;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class InviteForm extends Model{

    public $email;
    public $key;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            ['email','required', 'message' => 'укажите email'],
            ['email', 'email', 'message' => 'Неправильный формат email'],
            ['email', 'unique', 'targetAttribute' => 'email'  , 'targetClass' => User::class, 'message' => 'такой email уже зарегистрирован'],
        ];
    }

    public function attachEmail()
    {
        if($this->validate())
        {
            $user = User::findByInviteKey($this->key);

            $user->email = $this->email;
            $user->save(false);
            \Yii::$app->user->login($user);
            Invite::deleteAll(['user_id' => $user->id]);
            return true;
        }

        return false;

    }



}