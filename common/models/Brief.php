<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use common\classes\OrderCategory;
use yii\db\ActiveRecord;

/**
 * Class Brief
 * @package common\models
 *
 * @property int        $id
 * @property int        $order_id
 * @property int        $request_id
 * @property Request    $request
 * @property int        $model_id
 * @property int        $mark_id
 * @property float      $price              Стоимость машины
 * @property int        $currency_id
 * @property float      $engine_volume
 * @property string     $kpp
 * @property int        $drive
 * @property int        $body
 * @property int        $year_from
 * @property float      $mileage
 * @property string     $equipment
 * @property string     $equipment2
 * @property string     $additionally
 * @property string     $about
 * @property int        $status
 * @property VehicleModel        $model
 * @property VehicleBrand        $mark
 * @property Order        $order
 * @property int        $dial_type
 * @property float      $reward              Плата за выполнение сделки
 *
 */
class Brief extends ActiveRecord
{

    const SCENARIO_CREATE = 1;

    const STATUS_FREE = 1;
    const STATUS_SENDED = 2;
    const STATUS_ACCEPTED = 3;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'brief';
    }

    public function rules()
    {
        $rules = [
            [
                [
                    'order_id',
                    'request_id',
                    'mark_id',
                    'model_id',
                    'currency_id',
                    'engine_volume',
                    'kpp',
                    'drive',
                    'body',
                    'year_from',
                    'mileage',

                    'price',
                    'colors',

                    'additionally',
                    'about',
                ],
                'safe',
                'on' => self::SCENARIO_DEFAULT
            ],
            [
                [
                    'order_id',
                    'request_id',
                    'currency_id',
                    'engine_volume',
                    'mileage',
                    'price'
                ],
                'required',
                'on' => self::SCENARIO_CREATE
            ],
            [['mileage'], 'required', 'message' => 'Укажите пробег', 'on' => self::SCENARIO_CREATE],
            [['year_from',], 'required', 'message' => 'Укажите год', 'on' => self::SCENARIO_CREATE],
            [['mark_id'], 'required', 'message' => 'Укажите марку', 'on' => self::SCENARIO_CREATE],
            [['model_id'], 'required', 'message' => 'Укажите модель', 'on' => self::SCENARIO_CREATE],
            [['kpp'], 'required', 'message' => 'Укажите трансмиссию', 'on' => self::SCENARIO_CREATE],
            [['drive'], 'required', 'message' => 'Укажите привод', 'on' => self::SCENARIO_CREATE],
            [['body'], 'required', 'message' => 'Укажите кузов', 'on' => self::SCENARIO_CREATE],
            [['additionally', 'about'], 'required', 'message' => 'Заполните это поле', 'on' => self::SCENARIO_CREATE],
            [['price','engine_volume', 'mileage', 'order_id', 'request_id', 'currency_id'], 'number', 'message' => "Неверный формат значения", 'on' => self::SCENARIO_CREATE],
            [['colors'], 'safe', 'on' => self::SCENARIO_CREATE],
            [['price', 'engine_volume', 'mileage'], 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number', 'message' => "Значение должно быть больше 0", 'on' => self::SCENARIO_CREATE],
        ];

        $category = $this->order->category;

        if(in_array($category, [OrderCategory::CATEGORY_FREIGHT, OrderCategory::CATEGORY_AUTO])){
            $rules[] = [['body'], 'required', 'message' => 'Выберите кузов' ];
        }

        return $rules;
    }





    public function transmissionLabel(){
        $transmissions = Order::transmissions();
        return isset($transmissions[$this->kpp]) ? $transmissions[$this->kpp] : 'неверное значение';

    }

    public function driveLabel(){
        $drives = Order::drives();
        return isset($drives[$this->drive]) ? $drives[$this->drive] : 'неверное значение';
    }

    public function getOrder(){
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getModel(){
        return $this->hasOne(VehicleModel::class, ['id' => 'model_id']);
    }

    public function getMark(){
        return $this->hasOne(VehicleBrand::class, ['id' => 'mark_id']);
    }

    public function getCurrency(){
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    public function getRequest(){
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }

    public function getBrief(){
        return $this->hasOne(Brief::class, ['id' => 'brief_id']);
    }


}