<?php

namespace common\notifications\renderers;

class NoticeClientCreatedAppeal implements NotificationRenderer
{
    public function html($params){
        $html = "Клиент открыл арбитраж";
        return $html;
    }

    public function email($params){
        return 'Клиент открыл арбитраж';
    }
}