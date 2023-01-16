<?php

namespace common\notifications\renderers;

class NoticeReportReceived implements NotificationRenderer
{
    public function html($params){
        $html = "По вашему заказу получен новый отчет";
        return $html;
    }

    public function email($params){
        $html = "По вашему заказу получен новый отчет";
        return $html;
    }
}