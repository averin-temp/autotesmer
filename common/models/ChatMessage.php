<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class ChatMessage
 * @package common\models
 *
 * @property int $id
 * @property int $chat_id
 * @property \DateTime $time
 * @property int $author_id
 * @property string $text
 * @property int $viewed
 */
class ChatMessage extends ActiveRecord{

    public static function tableName()
    {
        return "chat_messages";
    }

    public function getTime($format){
        return date_create($this->time)->format($format);
    }
}