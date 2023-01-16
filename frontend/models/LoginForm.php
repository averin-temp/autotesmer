<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    private $_user;

    public function login()
    {
        if ($this->validate()) {
            return \Yii::$app->user->login($this->getUser());
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

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->active || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Пароль либо email неверен');
            }
        }
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required', 'message' => 'Введите email'],
            [['password'], 'required', 'message' => 'Введите пароль'],
            ['password', 'validatePassword'],
            ['email', 'email', 'message' => 'неверный формат email'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
