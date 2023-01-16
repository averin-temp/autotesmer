<?php

namespace common\notifications\renderers;

use common\models\Order;
use common\models\User;

class NoticeWorksInYourRegion implements NotificationRenderer
{
    public function html($params){

        $user = User::findOne($params->target_user);
        $count =  Order::find()->where(['client_city' => $user->city_id, 'status' => Order::STATUS_FREE])->count();
        $html = "В вашем регионе опубликовано $count новых заказов";
        return $html;
    }

    public function email($params){
        $user = User::findOne($params->target_user);
        $count =  Order::find()->where(['client_city' => $user->city_id, 'status' => Order::STATUS_FREE])->count();
        $html = "В вашем регионе опубликовано $count новых заказов";
        return $html;
    }
}