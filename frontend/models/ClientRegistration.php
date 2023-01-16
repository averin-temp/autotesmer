<?php
namespace frontend\models;

use common\models\City;
use common\models\User;
use common\validators\NameValidator;
use common\validators\PhoneValidator;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ClientRegistration extends Model{

    public $family;
    public $firstname;
    public $lastname;
    public $phone;
    public $email;
    public $city;
    public $password;
    public $confirm;

    public function rules()
    {
        return [
            ['email', 'email'],
            ['email','unique', 'targetClass' => 'common\models\User', 'filter' => 'active = 1' , 'message' => "Такой email уже зарегистрирован"],
            [['email','password', 'confirm', 'family', 'firstname', 'lastname', 'city'],'required'],

            ['password', 'compare', 'compareAttribute' => 'confirm'],
            [['phone', 'email','password', 'confirm', 'family', 'firstname', 'lastname' ], 'trim'],
            [['phone'], PhoneValidator::class ],
            ['firstname', NameValidator::class, 'message' => "Введите корректное имя"],
            ['lastname', NameValidator::class, 'message' => "Введите корректное отчество"],
            ['family', NameValidator::class, 'message' => "Введите корректную фамилию"],
            ['city', 'exist', 'targetClass' => City::class, 'targetAttribute' => 'id' , 'message' => 'Неверное значение города'],

        ];
    }

    public function errorField($attribute){
        if($this->hasErrors($attribute)){
            echo "<div class='form-error'><p>{$this->getFirstError($attribute)}</p></div>";
        }
    }

    /**
     * @return bool|User
     * @throws \Exception
     */
    public function save(){

        if($this->validate()){
            $user = new User();
            $user->family = $this->family;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->phone = $this->phone;
            $user->email = $this->email;
            $user->city_id = $this->city;
            $user->password = $this->password;

            $user->activation_key = uniqid();
            $user->active = 0;
            $user->save(false);

            $auth = \Yii::$app->authManager;
            $role = $auth->getRole('Клиент');
            $auth->assign($role, $user->id);

            return $user;
        }
        return false;
    }
}