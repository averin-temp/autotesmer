<?php

namespace common\notifications\renderers;

use common\models\Dial;
use common\models\User;

class NoticeYouHaveSecuredADeal implements NotificationRenderer
{
    public function html($params){

        /** @var Dial $order */
        $dial = $params->dial_id;
        $dial = Dial::findOne($dial);
        /** @var User $expert */
        $expert = $dial->expert;
        if($expert){
            $expertName = $expert->surnameWithInitials();
        } else {
            $expertName = "(эксперт не найден)";
        }
        $html = "Вы заключили безопасную сделку с экспертом $expertName";

        return $html;
    }

    public function email($params){
        /** @var Dial $order */
        $dial = $params->dial_id;
        $dial = Dial::findOne($dial);
        /** @var User $expert */
        $expert = $dial->expert;

        if($expert){
            $expertName = $expert->surnameWithInitials();
        } else {
            $expertName = "(эксперт не найден)";
        }

        $html = "Вы заключили безопасную сделку с экспертом $expertName";

        return $html;
    }
}