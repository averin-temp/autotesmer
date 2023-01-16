<?php

namespace common\notifications\renderers;


class NoticeDocumentsApproved implements NotificationRenderer
{
    public function html($params){
        $html = "Ваши документы прошли проверку";
        return $html;
    }

    public function email($params){
        return 'Ваши документы прошли проверку';
    }
}