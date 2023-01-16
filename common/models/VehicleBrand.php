<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 08.09.2019
 * Time: 20:13
 */

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class VehicleBrand
 * @package common\models
 *
 * @property $id int
 * @property $name string
 * @property $models VehicleModel[]
 */
class VehicleBrand extends ActiveRecord
{
    public static function tableName()
    {
        return 'vehicle_brand';
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels(){
        return $this->hasMany(VehicleModel::class, ['brand_id' => 'id']);
    }
}