<?php

namespace common\notifications\renderers;

class NoticeRewardFailed implements NotificationRenderer
{
    public function html($params){
        $html = "награда не выплачена";
        return $html;
    }

    public function email($params){
        return "награда не выплачена";
    }
}