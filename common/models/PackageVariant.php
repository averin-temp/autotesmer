<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 01.05.2019
 * Time: 19:11
 */

namespace common\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class PackageVariant
 * @package common\models
 *
 * @property int $id                ID
 * @property int $base_id           ID пакета
 * @property string $name           Название
 * @property float $price           Стоимость
 * @property Package $package       Пакет
 * @property array $servicesSettings  Настройки услуг
 * @property array $servicesNames  Имена услуг
 */
class PackageVariant extends ActiveRecord
{
    public $services_data;

    public static function tableName()
    {
        return 'package_variant';
    }

    public function rules()
    {
        return [

            [['price'],'required', 'message' => 'Укажите стоимость варианта пакета'],
            [['name'],'required', 'message' => 'Укажите название варианта пакета'],
            [['name','price'], 'trim'],
            [['price'], 'number', 'message' => 'Введите числовое значение'],
            [['services_data'],'safe'],

            [['type','days'],'safe']
        ];
    }

    public function saveServiceOptions(){
        $service_types = Service::types();
        foreach($service_types as $type => $label){
            $serviceOptions = ServiceOptions::findOne(['service_type' => $type, 'package_variant_id' => $this->id]);
            if(isset($this->services_data[$type])){
                $service_data = $this->services_data[$type];
                if(!empty($service_data['enabled'])){
                    if($serviceOptions == null) {
                        $serviceOptions = new ServiceOptions([
                            'package_variant_id' => $this->id,
                            'service_type' => $type,
                            'package_id' => $this->base_id
                        ]);
                    }
                    $serviceOptions->days = $service_data['days'];
                    $serviceOptions->save(false);
                    continue;
                }
            }

            if($serviceOptions != null){
                $serviceOptions->delete();
            }
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();
        ServiceOptions::deleteAll(['package_variant_id' => $this->id]);
    }

    public function getServicesSettings(){
        return $this->hasMany(ServiceOptions::class,['package_variant_id' => 'id']);
    }

    public function getServicesSettingsFormData(){
        $servicesSettings = $this->servicesSettings;
        $types = Service::types();

        $servicesSettings = ArrayHelper::index($servicesSettings,'service_type');
        $form_services = [];
        foreach($types as $type => $label){
            $form_services[$type] = isset($servicesSettings[$type]) ? $servicesSettings[$type] : null;
        }
        return $form_services;
    }

    public function getServicesNames(){
        $services = $this->servicesSettings;
        $labels = Service::labels();
        $names = [];
        foreach($services as $serviceOptions){
            $names[] = $labels[$serviceOptions->service_type];
        }
        return $names;
    }


    public function getServiceNames(){

        $services = $this->servicesSettings;
        $labels = Service::labels();
        $names = [];
        foreach($services as $serviceOptions){
            $serviceName = $labels[$serviceOptions->service_type];
            if(!in_array($serviceName,$names)){
                $names[] = $serviceName;
            }
        }
        return $names;

    }


    /**
     * @return array
     */
    public function getServiceTypes(){
        $services = $this->servicesSettings;
        $types = [];
        foreach($services as $serviceOptions){
            $types[$serviceOptions->service_type] = 1;
        }
        return array_keys($types);
    }



    public function hasServiceType($type){
        $types = $this->getServicesTypes();
        if(isset($types[$type]))
        {
            return true;
        }

        return false;
    }


    /**
     * Включает ли вариант услуги, перечисленные в параметре
     *
     * @param array $service_types        Типы услуг
     * @return bool
     */
    public function includesServices($service_types){

        $types = $this->getServiceTypes();
        $diff = array_diff($service_types, $types);

        if ( empty($diff) ) {
            return true;
        }

        return false;
    }



    public function getPackage(){
        return $this->hasOne(Package::class,['id' => 'base_id']);
    }



}