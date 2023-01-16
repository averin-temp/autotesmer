<?php

namespace common\notifications\renderers;

class NoticeCardRegistered implements NotificationRenderer
{
    public function html($params){
        $html = "Ваша карта была успешно привязана";
        return $html;
    }

    public function email($params){
        return 'Ваша карта была успешно привязана';
    }
}