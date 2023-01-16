<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 08.05.2019
 * Time: 23:13
 */

namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class City
 * @package common\models
 *
 * @property int $id
 * @property string $name
 *
 */
class City extends ActiveRecord
{
    public static function tableName()
    {
        return 'city';
    }

    public static function defaultCity(){
        return self::findOne(['name' => 'Москва']);
    }

}