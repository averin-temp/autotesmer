<?php

namespace common\notifications;

use yii\db\ActiveRecord;

class NotificationType extends ActiveRecord
{
    public static function tableName()
    {
        return 'notification_types';
    }
}