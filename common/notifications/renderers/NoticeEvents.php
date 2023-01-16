<?php

namespace common\notifications\renderers;


class NoticeEvents implements NotificationRenderer
{
    public function html($params){
        $html = "незаполнены настройки уведомления";
        return $html;
    }

    public function email($params){
        return 'незаполнены настройки уведомления';
    }
}