<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class PassportVerification
 * @package common\models
 *
 * @property $id                        int
 * @property $user_id                   int
 * @property $passport_photo_verified   int
 * @property $passport_selfie_verified  int
 * @property $status                    int
 * @property $passport_photo            string
 * @property $passport_selfie           string
 * @property $created                   string
 * @property $verification_date         string
 * @property User $user
 */
class PassportVerification extends ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_UPLOAD_PASSPORT = 2;
    const STATUS_UPLOAD_SELFIE = 3;
    const STATUS_WAITING_VERIFICATION = 4;
    const STATUS_VERIFYED = 5;
    const STATUS_REJECTED = 6;


    const SCENARIO_START = 1;
    const SCENARIO_UPLOAD_PASSPORT = 2;
    const SCENARIO_UPLOAD_SELFIE = 3;


    public $user_agreement;
    public $data_processing;

    public function scenarios()
    {
        $scenarios =  parent::scenarios();

        $scenarios[self::SCENARIO_START] = [
            'user_agreement',
            'data_processing'
        ];

        $scenarios[self::SCENARIO_UPLOAD_PASSPORT] = [
            'passport_photo'
        ];

        $scenarios[self::SCENARIO_UPLOAD_SELFIE] = [
            'passport_selfie'
        ];

        return $scenarios;
    }


    public function rules()
    {
        return [

            ['user_agreement', 'required', 'message' => "Подтвердите согласие с условиями"],
            ['data_processing', 'required', 'message' => "Подтвердите согласие на обработку данных"],

            [['passport_photo', 'passport_selfie' ], 'image',
                'extensions' => 'jpg',
                'minWidth' => 600,
                'maxWidth' => 2000,
                'minHeight' => 600,
                'maxHeight' => 2000,
                'skipOnEmpty' => false,
            ]
        ];
    }


    /**
     * @return string
     */
    public static function tableName()
    {
        return 'passport_verification';
    }


    public function getUser(){
        return $this->hasOne(User::class,['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        $this->saveImage('passport_photo');
        $this->saveImage('passport_selfie');

        return parent::beforeSave($insert);
    }


    public function saveImage($attribute){

        if($this->$attribute instanceof UploadedFile)
        {
            if($this->user_id) {
                $file = $this->$attribute;
                $upload_dir = \Yii::getAlias('@uploads') . '/users/' . $this->user_id;
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755);
                }
                $filename = uniqid() . time() . '.' . $file->extension;
                $this->$attribute = $filename;
                $file->saveAs("$upload_dir/$filename");
            }
        }
    }

}