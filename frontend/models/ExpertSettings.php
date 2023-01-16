<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class ExpertSettings extends Model
{
    public $firstname;
    public $lastname;
    public $family;

    public $email;

    public $city;
    public $day;
    public $month;
    public $year;

    public $password;
    public $confirm;

    public $phone;
    public $gender;

    public $has_ip;
    public $has_ul;

    public $image;

    public $profile_facebook;
    public $profile_vk;
    public $profile_twitter;
    public $profile_google;

    public $_user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname','lastname','family','email', 'city'], 'trim'],
            [['firstname','lastname','family','email','city'], 'required'],
            ['email', 'email'],
            ['password', 'compare', 'compareAttribute' => 'confirm', 'skipOnEmpty' => true],
            [['phone', 'day', 'month', 'year','gender'], 'safe'],
            [['has_ip', 'has_ul'], 'safe'],
            [[ 'profile_facebook', 'profile_vk', 'profile_twitter', 'profile_google'], 'safe' ],
            [['phone'], function($attribute, $params){
                $value = $this->$attribute;
                $pattern = '/^\+(\d) \((\d{3})\) (\d{3})-(\d{2})-(\d{2})$/i';

                if(preg_match($pattern,$value)){
                    $replacement = '${1}${2}${3}${4}${5}';
                    $phone = preg_replace($pattern,$replacement,$value);
                    $this->$attribute = $phone;
                } else {
                    $this->addError($attribute,"неверный номер телефона");
                }
            }]
        ];
    }

    public function errorField($attribute){
        if($this->hasErrors($attribute)){
            echo "<div class='form-error'><p>{$this->getFirstError($attribute)}</p></div>";
        }
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
        $birthday = date_create($user->birthday);
        $this->day = $birthday->format('j');
        $this->month = $birthday->format('n');
        $this->year = $birthday->format('Y');
        $this->password = $user->password;
        $this->phone = $user->phone;
        $this->gender = $user->gender;
        $this->profile_facebook = $user->profile_facebook;
        $this->profile_vk = $user->profile_vk;
        $this->profile_google = $user->profile_google;
        $this->profile_twitter = $user->profile_twitter;
        $this->has_ip = $user->has_ip;
        $this->has_ul = $user->has_ul;

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

            $user->gender = $this->gender;

            $datetime = date_create_from_format("j n Y", "$this->day $this->month $this->year");
            $user->birthday = $datetime->format("Y-m-d H:i:s");

            $user->has_ip = $this->has_ip;
            $user->has_ul = $this->has_ul;


            $user->profile_facebook = $this->profile_facebook;
            $user->profile_vk = $this->profile_vk;
            $user->profile_twitter = $this->profile_twitter;
            $user->profile_google = $this->profile_google;

            if($this->password){
                $user->setPassword($this->password);
            }

            $user->save(false);
            return true;
        }
        return false;
    }

}
