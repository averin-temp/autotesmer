<?php

namespace common\validators;

use common\helpers\DataHelper;
use yii\validators\Validator;

class PhoneValidator extends Validator
{

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        $pattern = '/^\+(\d) \((\d{3})\) (\d{3})-(\d{2})-(\d{2})$/i';

        if(preg_match($pattern,$value)){
            $replacement = '${1}${2}${3}${4}${5}';
            $phone = preg_replace($pattern,$replacement,$value);
            $model->$attribute = $phone;
            return true;
        }

        $onlyNumbers = DataHelper::onlyNumbers($value);
        if(strlen($onlyNumbers) == 11){
            $model->$attribute = $onlyNumbers;
            return true;
        }

        $model->addError($attribute,"неверный номер телефона");
        return false;
    }
}