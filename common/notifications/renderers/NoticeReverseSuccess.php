<?php

namespace common\notifications\renderers;

class NoticeReverseSuccess implements NotificationRenderer
{
    public function html($params){
        $html = "возврат средств";
        return $html;
    }

    public function email($params){
        return 'возврат средств';
    }
}