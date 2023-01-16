<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 01.05.2019
 * Time: 18:45
 */

namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class Service
 * @package common\models
 *
 * @property int $id
 * @property int $service_type
 * @property string $name
 * @property string $label
 * @property array $optionsFormData
 * @property array $serviceNames
 * @property int $package_variant_id
 * @property int $package_id
 *
 */
class ServiceOptions extends ActiveRecord
{

    public static function tableName()
    {
        return 'service_options';
    }
}