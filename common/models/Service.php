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
 * @property string $activation_date
 * @property string $expire_date
 * @property int $active
 * @property int $user_package_id
 * @property int $package_id
 * @property int $package_variant_id
 * @property int $user_id
 */
class Service extends ActiveRecord
{


    const TYPE_ONE_TIME_INSPECTION = 1;
    const TYPE_EXPERT_FOR_DAY = 2;
    const TYPE_FULL_SELECTION = 3;
    const TYPE_EDITORS_CHOICE = 4;

    public static function tableName()
    {
        return 'service';
    }

    public function getLabel(){
        return self::labels()[$this->service_type];
    }

    public static function labels(){
        return [
            self::TYPE_ONE_TIME_INSPECTION => 'разовый осмотр',
            self::TYPE_EXPERT_FOR_DAY => 'эксперт на день',
            self::TYPE_FULL_SELECTION => 'подбор под ключ',
            self::TYPE_EDITORS_CHOICE => 'выбор редакции',
        ];
    }

    public function getName(){
        return $this->label;
    }

    public static function types(){
        return self::labels();
    }


    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function create($user_id, $user_package_id, $serviceOptions, $activate = 0){
        $service = new Service([
            'service_type' => $serviceOptions->service_type,
            'expire_date' => date_add(
                date_create(),
                date_interval_create_from_date_string("$serviceOptions->days days"))
                    ->format("Y-m-d H:i:s")
            ,
            'active' => $activate,
            'package_id' => $serviceOptions->package_id,
            'package_variant_id' => $serviceOptions->package_variant_id,
            'user_id' => $user_id,
            'user_package_id' => $user_package_id
        ]);

        if($service->save(false)){
            return $service;
        };

        return null;
    }


    public function extend($serviceOptions){
        $dateInterval = date_interval_create_from_date_string("$serviceOptions->days days");
        $this->expire_date = date_add(date_create($this->expired() ? null : $this->expire_date ), $dateInterval)
            ->format("Y-m-d H:i:s");
    }

    public function expired(){
        return date_create() > date_create($this->expire_date);
    }

}