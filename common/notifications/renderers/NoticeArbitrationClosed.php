<?php

namespace common\notifications\renderers;

class NoticeArbitrationClosed implements NotificationRenderer
{
    public function html($params){
        $html = "Арбитраж завершил рассмотрение вашего спора";
        return $html;
    }

    public function email($params){
        return 'Арбитраж завершил рассмотрение вашего спора';
    }
}