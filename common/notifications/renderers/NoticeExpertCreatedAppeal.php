<?php

namespace common\notifications\renderers;

class NoticeExpertCreatedAppeal implements NotificationRenderer
{
    public function html($params){
        $html = "Эксперт открыл арбитраж";
        return $html;
    }

    public function email($params){
        return 'Эксперт открыл арбитраж';
    }
}