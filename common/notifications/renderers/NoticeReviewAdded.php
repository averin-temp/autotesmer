<?php

namespace common\notifications\renderers;

class NoticeReviewAdded implements NotificationRenderer
{
    public function html($params){
        $html = "Вам оставили новый отзыв";
        return $html;
    }

    public function email($params){
        $html = "Вам оставили новый отзыв";
        return $html;
    }
}