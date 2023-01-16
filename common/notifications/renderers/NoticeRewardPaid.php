<?php

namespace common\notifications\renderers;

class NoticeRewardPaid implements NotificationRenderer
{
    public function html($params){
        $html = "награда выплачена";
        return $html;
    }

    public function email($params){
        return "награда выплачена";
    }
}