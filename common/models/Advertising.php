<?php
namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class Advertising
 * @package common\models
 *
 *
 * @property int $id
 * @property string $name
 * @property string $website
 * @property string $email
 * @property string $phone
 */
class Advertising extends ActiveRecord{

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'advertising';
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => "Введите свое имя"],
            [['phone'], 'required', 'message' => "Введите свой телефон"],
            [['website'], 'url', 'message' => "Введите web адрес"],
            [['email'], 'required', 'message' => "Введите адрес Email"],
            [['email'], 'email', 'message' => "Введите корректный адрес Email"],
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => "Имя",
            'phone' => 'Телефон',
            'email' => 'Email',
            'website' => 'Сайт',
        ];
    }

}