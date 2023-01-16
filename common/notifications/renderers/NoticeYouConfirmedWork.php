<?php

namespace common\notifications\renderers;

use common\classes\OrderCategory;
use common\models\Order;

class NoticeYouConfirmedWork implements NotificationRenderer
{
    public function html($params){

        /** @var Order $order */
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

        $expert = $order->expert;


        if($expert){
            $expertName = $expert->surnameWithInitials();
        } else {
            $expertName = "(эксперт не найден)";
        }


        $sum = $order->budget_from . ' - ' . $order->budget_to . ' ' . $order->currency->abbr;



        $html = "Вы подтвердили выполнение работ по подбору $vehicleType у эксперта $expertName на сумму $sum";

        return $html;
    }

    public function email($params){
        /** @var Order $order */
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

        $expert = $order->expert;
        if($expert){
            $expertName = $expert->surnameWithInitials();
        } else {
            $expertName = "(эксперт не найден)";
        }

        $sum = $order->budget_from . ' - ' . $order->budget_to . ' ' . $order->currency->abbr;
        $html = "Вы подтвердили выполнение работ по подбору $vehicleType у эксперта $expertName на сумму $sum";

        return $html;
    }
}