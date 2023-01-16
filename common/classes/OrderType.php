<?php

namespace common\classes;


class OrderType
{
    const TYPE_ONE_TIME_INSPECTION = 1;
    const TYPE_EXPERT_FOR_DAY = 2;
    const TYPE_FULL_SELECTION = 3;

    public static function types(){
        return [
            self::TYPE_ONE_TIME_INSPECTION => [
                'label' => "Разовый осмотр",
            ],
            self::TYPE_EXPERT_FOR_DAY => [
                'label' => "Эксперт на день",
            ],
            self::TYPE_FULL_SELECTION => [
                'label' => "Подбор под ключ",
            ],
        ];
    }

    public static function label($type){
        $info = self::types();
        return $info[$type]['label'];
    }


}