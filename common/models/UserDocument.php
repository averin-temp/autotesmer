<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class UserDocument
 */
class UserDocument extends ActiveRecord{


    public static function tableName()
    {
        return 'user_documents';
    }
}