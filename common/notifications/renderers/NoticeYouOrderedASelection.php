<?php

namespace common\notifications\renderers;

use common\classes\OrderCategory;
use common\classes\OrderType;
use common\models\Order;

class NoticeYouOrderedASelection implements NotificationRenderer
{

    /**
     * @param $params
     * @return string
     */
    public function html($params){

        $order = Order::findOne($params->order_id);

        if($order->category == OrderCategory::CATEGORY_AUTO){
            $vehicleType = 'автомобиля';
        }if($order->category == OrderCategory::CATEGORY_FREIGHT){
            $vehicleType = 'грузового транспорта';
        }if($order->category == OrderCategory::CATEGORY_MOTO){
            $vehicleType = 'мотоцикла';
        }if($order->category == OrderCategory::CATEGORY_WATER){
            $vehicleType = 'водного транспортного средства';
        }if($order->category == OrderCategory::CATEGORY_COMMERCE){
            $vehicleType = 'коммерческого транспортного средства';
        }

        $sum = $order->budget_from . ' - ' . $order->budget_to . ' ' . $order->currency->abbr;

        if($order->type == OrderType::TYPE_ONE_TIME_INSPECTION){
            $message = "Вы заказали разовый осмотр $vehicleType на сумму $sum";
        } elseif($order->type == OrderType::TYPE_EXPERT_FOR_DAY){
            $message = "Вы заказали услуги эксперта на день на сумму $sum";
        }elseif($order->type == OrderType::TYPE_FULL_SELECTION){
            $message = "Вы заказали подбор $vehicleType под ключ на сумму $sum";
        } else {
            $message = 'warning: неизвестный тип заказа';
        }

        return $message;
    }

    public function email($params){
        $order = Order::findOne($params->order_id);

        if($order->category == OrderCategory::CATEGORY_AUTO){
            $vehicleType = 'автомобиля';
        }if($order->category == OrderCategory::CATEGORY_FREIGHT){
            $vehicleType = 'грузового транспорта';
        }if($order->category == OrderCategory::CATEGORY_MOTO){
            $vehicleType = 'мотоцикла';
        }if($order->category == OrderCategory::CATEGORY_WATER){
            $vehicleType = 'водного транспортного средства';
        }if($order->category == OrderCategory::CATEGORY_COMMERCE){
            $vehicleType = 'коммерческого транспортного средства';
        }

        $sum = $order->budget_from . ' - ' . $order->budget_to . ' ' . $order->currency->abbr;

        if($order->type == OrderType::TYPE_ONE_TIME_INSPECTION){
            $message = "Вы заказали разовый осмотр $vehicleType на сумму $sum";
        } elseif($order->type == OrderType::TYPE_EXPERT_FOR_DAY){
            $message = "Вы заказали услуги эксперта на день на сумму $sum";
        }elseif($order->type == OrderType::TYPE_FULL_SELECTION){
            $message = "Вы заказали подбор $vehicleType под ключ на сумму $sum";
        } else {
            $message = 'warning: неизвестный тип заказа';
        }

        return $message;
    }

}