<?php

namespace common\notifications\renderers;

class NoticeExpertizeApproved implements NotificationRenderer
{
    public function html($params){
        $html = "Вы прошли экспертизу на сайте Autotesmer";
        return $html;
    }

    public function email($params){
        return 'Вы прошли экспертизу на сайте Autotesmer';
    }
}