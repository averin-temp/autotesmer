<?php

namespace common\notifications\renderers;

class NoticeRefundPaid implements NotificationRenderer
{
    public function html($params){
        $html = "возврат зарезервированных средств за сделку выполнен";
        return $html;
    }

    public function email($params){
        return "возврат зарезервированных средств за сделку выполнен";
    }
}