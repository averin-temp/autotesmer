<?php

namespace common\notifications\renderers;

class NoticeReverseFailed implements NotificationRenderer
{
    public function html($params){
        $html = "возврат средств не удался";
        return $html;
    }

    public function email($params){
        return 'возврат средств не удался';
    }
}