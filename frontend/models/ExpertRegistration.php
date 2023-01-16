<?php
namespace frontend\models;

use common\models\City;
use common\models\NotificationsSettings;
use common\validators\NameValidator;
use common\validators\PhoneValidator;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class ExpertRegistration extends Model
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

    public $has_ip;
    public $has_ul;

    public $first_time_verification;
    public $data_authentic;
    public $personal_data_processing_agree;

    public $image;


    public $category_auto;
    public $category_freight;
    public $category_moto;
    public $category_commerce;
    public $category_water;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname','lastname','family','email'], 'trim'],
            [['firstname','lastname','family','email', 'phone'], 'required'],
            [['has_ip', 'has_ul'], 'safe'],
            ['email', 'email'],
            ['password', 'compare', 'compareAttribute' => 'confirm'],
            [['password', 'confirm'],'required'],
            [['phone', 'city', 'day', 'month', 'year'], 'safe'],
            [[ 'first_time_verification', 'data_authentic', 'personal_data_processing_agree' ], 'safe' ],
            ['image', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024, 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false ],
            [['category_auto', 'category_freight', 'category_moto', 'category_commerce', 'category_water'], 'integer'],
            [['phone'], PhoneValidator::class ],
            [['first_time_verification'], 'required', 'message' => 'Необходимо дать согласие' ],
            [['data_authentic'], 'required', 'message' => 'Необходимо дать согласие'],
            [['personal_data_processing_agree'], 'required', 'message' => 'Необходимо дать согласие'],
            ['first_time_verification', 'compare', 'compareValue' => 1, 'operator' => '==', 'type' => 'number', 'message' => 'Необходимо дать согласие'],
            ['personal_data_processing_agree', 'compare', 'compareValue' => 1, 'operator' => '==', 'type' => 'number', 'message' => 'Необходимо дать согласие'],
            ['data_authentic', 'compare', 'compareValue' => 1, 'operator' => '==', 'type' => 'number', 'message' => 'Необходимо дать согласие'],


            ['firstname', NameValidator::class, 'message' => 'Введите корректное имя'],
            ['lastname', NameValidator::class, 'message' => 'Введите корректную фамилию'],
            ['family', NameValidator::class, 'message' => 'Введите корректное отчество'],

            ['city', 'exist', 'targetClass' => City::class, 'targetAttribute' => 'id' , 'message' => 'Неверное значение города'],

            ['image', 'image', 'extensions' => 'jpg',
                'minWidth' => 100, 'maxWidth' => 1000,
                'minHeight' => 100, 'maxHeight' => 1000,
            ],

            [['category_auto'] , function($attribute, $params){
                if(!($this->category_water ||
                    $this->category_commerce ||
                    $this->category_moto ||
                    $this->category_auto ||
                    $this->category_freight))
                {
                    $this->addError($attribute,"выберите хотя бы одну специализацию");
                }
            }, 'skipOnEmpty' => false ]

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

        $user = new User();
        $user->scenario = User::SCENARIO_EXPERT_REGISTRATION;
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->family = $this->family;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->city_id = $this->city;
        $user->has_ul = $this->has_ul;
        $user->has_ip = $this->has_ip;

        $user->category_auto = $this->category_auto;
        $user->category_freight = $this->category_freight;
        $user->category_moto = $this->category_moto;
        $user->category_commerce = $this->category_commerce;
        $user->category_water = $this->category_water;

        if($birthday = date_create_from_format("d m Y", "$this->day $this->month $this->year"))
            $user->birthday = $birthday->format("Y-m-d H:i:s");

        $user->setPassword($this->password);

        $key = uniqid();
        $user->activation_key = $key;
        $user->active = 0;
        $user->save(false);
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole('Эксперт');
        $auth->assign($role, $user->id);



        /** @var $avatar UploadedFile */
        if($this->image){
            $avatar = $this->image;
            $unique_name = uniqid('avatar_') . time() . '.' . $avatar->extension;

            $upload_dir = \Yii::getAlias('@uploads') . '/users/' . $user->id;
            if(!file_exists($upload_dir))
                mkdir($upload_dir);

            $fullpath = "$upload_dir/$unique_name";
            $result = $avatar->saveAs( $fullpath);
            if($result) {
                $user->avatar = $unique_name;
                $user->save(false);
            }
        }


        return $user;
    }

    


}
