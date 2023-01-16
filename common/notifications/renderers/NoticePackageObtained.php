<?php

namespace common\notifications\renderers;

class NoticePackageObtained implements NotificationRenderer
{
    public function html($params){
        $html = "Приобретен пакет";
        return $html;
    }

    public function email($params){
        $html = "Приобретен пакет";
        return $html;
    }
}