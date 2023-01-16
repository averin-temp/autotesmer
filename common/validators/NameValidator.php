<?php

namespace common\validators;

use yii\validators\Validator;

class NameValidator extends Validator
{



    public function validateAttribute($model, $attribute)
    {
        if(!preg_match('/^[a-zA-Zа-яА-Я]+$/ui', $model->$attribute))
        {
            $this->addError($model, $attribute, $this->message);
        }
    }
}