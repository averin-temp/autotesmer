<?php

namespace common\notifications\renderers;

use common\models\User;

class NoticeNewRequest implements NotificationRenderer
{
    public function html($params){
        $expert = User::findOne($params->expert);

        if($expert){
            $expertName = $expert->surnameWithInitials();
        } else {
            $expertName = "(эксперт не найден)";
        }

        $html = "По вашей заявке поступило новое предложение от эксперта " . $expertName;
        return $html;
    }

    public function email($params){
        $expert = User::findOne($params->expert);
        if($expert){
            $expertName = $expert->surnameWithInitials();
        } else {
            $expertName = "(эксперт не найден)";
        }
        $html = "По вашей заявке поступило новое предложение от эксперта " . $expertName;
        return $html;
    }
}