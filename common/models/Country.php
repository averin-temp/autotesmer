<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 09.09.2019
 * Time: 17:09
 */

namespace common\models;


use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
    public static function tableName()
    {
        return 'country';
    }

}