<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Package
 * @package common\models
 *
 * @property int $id                ID пакета
 * @property string $name           Имя пакета
 * @property \DateTime $created     Время создания базового пакета
 * @property array $variants     Варианты пакета
 * @property array $allVariantsServices     Все услуги
 */
class Package extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'packages';
    }

    public function rules()
    {
        return [
            ['name', 'required', 'message' => "Укажите название пакета"],
            ['name', 'trim'],
        ];
    }

    public function getVariants(){
        return $this->hasMany(PackageVariant::class, ['base_id' => 'id']);
    }

    public function getAllVariantsServices(){

        $allServices = [];
        /** @var $variants PackageVariant */
        $variants = $this->variants;
        foreach($variants as $variant){
            $servicesSettings = $variant->servicesSettings;
            $allServices = array_merge($allServices, $servicesSettings);
        }

        $list = [];
        foreach($allServices as $serviceOptions){
            /** @var $serviceOptions ServiceOptions */
            $list[$serviceOptions->service_type] = Service::labels()[$serviceOptions->service_type];
        }

        return $list;
    }

    public function priceFrom(){

        $variants = $this->variants;

        $prices = [];
        foreach($variants as $variant)
        {
            $prices[] = $variant->price;
        }

        $price = min($prices);

        return $price;
    }

}