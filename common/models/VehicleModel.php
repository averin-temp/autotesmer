<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 12.05.2019
 * Time: 2:40
 */

namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class CarModel
 * @package common\models
 *
 * @property int        $id     ID
 * @property string     $name   name
 */
class VehicleModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'vehicle_model';
    }

}