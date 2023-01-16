<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 06.05.2019
 * Time: 0:44
 */

namespace common\classes;


use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class OrderCategory
{
    const CATEGORY_AUTO = 1;
    const CATEGORY_FREIGHT = 2;
    const CATEGORY_MOTO = 3;
    const CATEGORY_COMMERCE = 4;
    const CATEGORY_WATER = 5;

    const CATEGORY_DEFAULT = 1;

    public static function categories(){
        return [
            self::CATEGORY_AUTO => [
                'label' => 'Легковые',
                'alias' => 'auto',
                'view' => '//create_order/auto',
                'image' => '@web/img/types/4.jpg'
            ],
            /**self::CATEGORY_FREIGHT => [
                'label' => 'Грузовые',
                'alias' => 'freight',
                'view' => '//create_order/freight',
                'image' => '@web/img/types/2.png'
            ],
            self::CATEGORY_MOTO => [
                'label' => 'Мото',
                'alias' => 'moto',
                'view' => '//create_order/moto',
                'image' => '@web/img/types/5.jpg'
            ],
            self::CATEGORY_COMMERCE => [
                'label' => 'Коммерческий транспорт',
                'alias' => 'commerce',
                'view' => '//create_order/commerce',
                'image' => '@web/img/types/3.jpg'
            ],
            self::CATEGORY_WATER => [
                'label' => 'Водный транспорт',
                'alias' => 'water',
                'view' => '//create_order/water',
                'image' => '@web/img/types/1.jpg'
            ],*/
        ];
    }

    public static function label($category){
        $categories = self::categories();
        return $categories[$category]['label'];
    }

}