<?php

namespace common\notifications\renderers;

class NoticeYouCreatedAppeal implements NotificationRenderer
{
    public function html($params){
        $html = "Вы открыли арбитраж";
        return $html;
    }

    public function email($params){
        $html = "Вы открыли арбитраж";
        return $html;
    }
}