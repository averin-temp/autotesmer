<?php

namespace common\notifications\renderers;

class NoticeYourInfoChanged implements NotificationRenderer
{
    public function html($params){
        $html = "Данные в вашем профиле были изменены";
        return $html;
    }

    public function email($params){
        $html = "Данные в вашем профиле были изменены";
        return $html;
    }
}