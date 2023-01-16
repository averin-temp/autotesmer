<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Currency
 * @package common\models
 *
 * @property int $id
 * @property int $abbr
 */
class Currency extends ActiveRecord{

    public static function tableName()
    {
        return 'currency';
    }

}