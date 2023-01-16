<?php
namespace frontend\models;

use common\models\City;
use common\validators\NameValidator;
use common\validators\PhoneValidator;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Class ClientSettings
 * @package frontend\models
 */
class ClientSettings extends Model
{
    public $firstname;
    public $lastname;
    public $family;

    public $email;

    public $city;

    /** @var $birthday \DateTime|false */
    public $birthday;

    public $password;
    public $confirm;

    public $phone;
    public $gender;

    public $_user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname','lastname','family','email', 'city'], 'trim'],
            [['firstname','lastname','family','email', 'city'], 'required'],
            ['email', 'email', 'message' => 'неверный формат email'],

            ['email', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email',
                'filter' => 'id != ' . $this->_user->id, 'message' => 'этот email уже зарегистрирован' ],

            ['password', 'compare', 'compareAttribute' => 'confirm', 'skipOnEmpty' => false,
                'message' => 'пароль и подтверждение не совпадают'],

            [['gender'], 'safe'],
            [['birthday'], 'validateBirthday' ],
            [['has_ip', 'has_ul'], 'safe'],
            [[ 'profile_facebook', 'profile_vk', 'profile_twitter', 'profile_google', 'confirm'], 'safe' ],
            [['phone'], PhoneValidator::class, 'message' => 'неверный номер телефона', 'skipOnEmpty' => true ],
            ['firstname', NameValidator::class, 'message' => 'Введите корректное имя'],
            ['lastname', NameValidator::class, 'message' => 'Введите корректное отчество'],
            ['family', NameValidator::class, 'message' => 'Введите корректную фамилию'],

            ['city', 'exist', 'targetClass' => City::class, 'targetAttribute' => 'id' ,
                'message' => 'Неверное значение города'],


        ];
    }

    public function errorField($attribute){
        if($this->hasErrors($attribute)){
            echo "<div class='form-error $attribute'><p>{$this->getFirstError($attribute)}</p></div>";
        }
    }


    public function validateBirthday($attribute, $params)
    {
        $date = array_map('intval', $this->$attribute);

        // если ничего не указано
        if(empty($date['year']) && empty($date['month']) && empty($date['day'])) {
            $this->$attribute = null;
            return true;
        }

        // указаны все части
        if($date['year'] && $date['month'] && $date['day'])
        {
            $datetime = date_create_from_format("Y-n-j", "{$date['year']}-{$date['month']}-{$date['day']}");
            if($datetime) {
                $this->$attribute = $datetime;
                return true;
            }
        }

        $this->$attribute = null;
        $this->addError($attribute, "Неверно указана дата рождения, укажите дату полностью или оставьте пустой");
        return false;

    }


    public function __construct(array $config = [])
    {
        parent::__construct($config);

        /** @var $user User*/
        $user = \Yii::$app->user->identity;

        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->family = $user->family;
        $this->email = $user->email;
        $this->city = $user->city->id;
        $this->birthday = $user->birthday ? date_create($user->birthday) : null ;
        $this->password = $user->password;
        $this->phone = $user->phone;
        $this->gender = $user->gender;

        $this->_user = $user;
    }


    public function save(){

        if($this->validate()){

            $user = $this->_user;

            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->family = $this->family;
            $user->phone = $this->phone;
            $user->email = $this->email;
            $user->city_id = $this->city;
            $user->birthday = $this->birthday ? $this->birthday->format("Y-m-d H:i:s") : null ;

            if($this->gender){
                $user->gender = $this->gender;
            }

            if($this->password){
                $user->setPassword($this->password);
            }

            $user->save(false);

            return true;
        }
        return false;
    }

}
