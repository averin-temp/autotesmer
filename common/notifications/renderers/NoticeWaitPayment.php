<?php

namespace common\notifications\renderers;

use common\models\User;

class NoticeWaitPayment implements NotificationRenderer
{
    public function html($params){

        $client = User::findOne($params->target_user);

        if($client){
            $clientName = $client->surnameWithInitials();
        } else {
            $clientName = "(клиент не найден)";
        }

        $html = "$clientName подтвердил выполнение задания, ожидайте поступления денежных средств";
        return $html;
    }

    public function email($params){
        $client = User::findOne($params->target_user);
        if($client){
            $clientName = $client->surnameWithInitials();
        } else {
            $clientName = "(клиент не найден)";
        }

        $html = "$clientName подтвердил выполнение задания, ожидайте поступления денежных средств";
        return $html;
    }
}