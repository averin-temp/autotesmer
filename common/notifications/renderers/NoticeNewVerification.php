<?php

namespace common\notifications\renderers;

use common\models\User;

class NoticeNewVerification implements NotificationRenderer
{
    public function html($params){
        $user = User::findOne($params->target_user);
        $html = "<h3>Запрос на верификацию от $user->firstname $user->family.</h3>";
        return $html;
    }

    public function email($params){
        $user = User::findOne($params->target_user);
        $html = "<h3>Запрос на верификацию от $user->firstname $user->family.</h3>";
        return $html;
    }
}