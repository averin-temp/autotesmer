<?php
namespace common\helpers;

class DataHelper {

    public static function onlyNumbers($value){
        return preg_replace("/[^0-9]/", '', $value);
    }
}