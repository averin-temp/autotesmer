<?php

namespace common\notifications\renderers;

use common\classes\OrderCategory;
use common\models\Dial;
use common\models\Order;

class NoticeYouMadeADeposit implements NotificationRenderer
{
    public function html($params){

        /** @var Dial $dial */
        $dial = Dial::findOne($params->dial_id);
        $order = $dial->order;
        $expert = $order->expert;
        $sum = $order->budget_from . ' - ' . $order->budget_to . ' ' . $order->currency->abbr;

        if($expert){
            $expertName = $expert->surnameWithInitials();
        } else {
            $expertName = "(эксперт не найден)";
        }

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

        $html = "Вы внесли депозит в размере $sum на осмотр $vehicleType экспертом $expertName";

        return $html;
    }

    public function email($params){
        /** @var Dial $dial */
        $dial = Dial::findOne($params->dial_id);
        $order = $dial->order;
        $expert = $order->expert;
        $sum = $order->budget_from . ' - ' . $order->budget_to . ' ' . $order->currency->abbr;


        if($expert){
            $expertName = $expert->surnameWithInitials();
        } else {
            $expertName = "(эксперт не найден)";
        }

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

        $html = "Вы внесли депозит в размере $sum на осмотр $vehicleType экспертом $expertName";

        return $html;
    }
}