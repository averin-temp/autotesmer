<?php
namespace app\models;

use common\models\User;


class LoginModel extends \yii\base\Model
{
    public $email;
    public $password;
    public $rememberMe = false;

    public $_user = null;

    public function login(){

        if ($this->validate()) {
            return \Yii::$app->user->login( $this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    public function rules()
    {
        return [
            [['email', 'password' ], 'required'],
            [['rememberMe'], 'safe'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->active || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный пароль или email');
            }
        }
    }

}