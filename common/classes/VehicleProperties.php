<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 09.09.2019
 * Time: 14:56
 */

namespace common\classes;


class VehicleProperties
{

    public static function bodies($category = null){
        $bodies =  [
            VehicleCategory::FREIGHT => [
                // грузовые
                1 => 'Фургон',
                2 => 'Грузовик',
                3 => 'Сдельный тягач',
            ],
            VehicleCategory::AUTO => [
                // легковые
                4 => 'Седан',
                5 => 'Хэтчбек',
                6 => 'Лифтбек',
                7 => 'Внедорожник',
                8 => 'Универсал',
                9 => 'Купе',
                10 => 'Минивэн',
                11 => 'Пикап',
                12 => 'Лимузин',
                13 => 'Фургон',
                14 => 'Кабриолет',
            ],
        ];

        if($category) {
            return isset($bodies[$category]) ? $bodies[$category] : [] ;
        }

        return $bodies;

    }

    public static function drives(){
        return [
            1 => 'Заднеприводный с подключаемым передним',
            2 => 'Задний',
            3 => 'Передний',
            4 => 'Полный',
            5 => 'Полный подключаемый',
            6 => 'Постоянный привод на все колеса',
        ];
    }
}