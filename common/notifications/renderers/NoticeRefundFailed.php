<?php

namespace common\notifications\renderers;

class NoticeRefundFailed implements NotificationRenderer
{
    public function html($params){
        $html = "возврат зарезервированных средств за сделку не выполнен";
        return $html;
    }

    public function email($params){
        return "возврат зарезервированных средств за сделку  не выполнен";
    }
}