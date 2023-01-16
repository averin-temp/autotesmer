<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class UserPackage
 * @package common\models
 *
 * @property PackageVariant     $packageVariant      Вариант пакета-оригинала
 * @property array              $services            Услуги пакета
 * @property int                $package_variant_id  ID варианта пакета-оригинала
 * @property int                $package_id          ID пакета-оригинала
 * @property int                $user_id             ID пользователя - владельца пакета
 * @property User                $user             ID пользователя - владельца пакета
 * @property int                $paid                Оплачен ли пакет
 * @property int                $created             Дата создания пакета
 * @property int                $activation_date     Дата активации пакета
 * @property int                $payment_id          ID оплаты пакета
 * @property Payment            $payment             Оплата пакета
 * @property Package            $package             Пакет-оригинал
 *
 */
class UserPackage extends ActiveRecord{

    private $_services;


    public static function tableName()
    {
        return 'user_package';
    }


    /**
     * Возвращает службы
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices(){
        return $this->hasMany(Service::class, ['package_variant_id' => 'package_variant_id']);
    }

    /**
     *
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackageVariant(){
        return $this->hasOne(PackageVariant::class, ['id' => 'package_variant_id']);
    }


    /**
     * Оплата пакета
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment(){
        return $this->hasOne(Payment::class, ['id' => 'payment_id' ]);
    }

    /**
     * Возвращает услуги пакета по типу
     *
     * @param $type
     * @return null
     */
    public function getServiceByType($type){
        $indexedServices = ArrayHelper::index($this->services, 'id');
        return empty($indexedServices[$type]) ? null : $indexedServices[$type];
    }

    /**
     * Возвращает оставшееся время пакета
     *
     * @return int|mixed
     */
    public function getTimeLeft(){
        $services = $this->services;
        $expire = null;
        foreach($services as $service){
            /** @var $service Service */
            $serviceExpireDateTime = date_create($service->expire_date);
            if(!$expire) $expire = $serviceExpireDateTime;
            $expire = $serviceExpireDateTime > $expire ? $serviceExpireDateTime : $expire;
        }

        $current_time = date_create();

        if($expire == null || $current_time > $expire) {
            return 0;
        }

        return date_diff($expire, $current_time)->days;
    }


    public function getTimeStart(){
        return $this->activation_date;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackage(){
        return $this->hasOne(Package::class, ['id' => 'package_id']);
    }


    public function beforeDelete()
    {
        self::deleteServices();
        return parent::beforeDelete();
    }

    public function deleteServices(){
        Service::deleteAll(['user_package_id' => $this->id]);
    }

    /**
     * Пользователь заказавший пакет
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::class,['id' => 'user_id']);
    }

}