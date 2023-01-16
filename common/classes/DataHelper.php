<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 11.11.2019
 * Time: 20:47
 */

namespace common\classes;


class DataHelper
{

    public static function getParam($name, $variants, $default){
        $param = \Yii::$app->request->get($name, $default);

        if(!in_array($param,$variants)){
            $param = $default;
        }

        return $param;
    }


    public static function prettyPhone($numbers){

        if(strlen($numbers) != 11 ) {
            return $numbers;
        }

        //+7 (906) 868-67-76
        $phone = "+".$numbers[0]." (".$numbers[1].$numbers[2].$numbers[3].") ".$numbers[4].$numbers[5].$numbers[6]."-".$numbers[7].$numbers[8]."-".$numbers[9].$numbers[10];

        return $phone;
    }

}