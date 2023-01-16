<?php

namespace common\notifications\renderers;

class NoticeAdminMessage implements NotificationRenderer
{
    public function html($params){
        $html = "сообщение от администрации";
        return $html;
    }

    public function email($params){
        return 'сообщение от администрации';
    }
}