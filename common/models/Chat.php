<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Chat
 * @package common\models
 *
 * @property int $id
 * @property int $owner_id
 * @property int $user1_id
 * @property int $user2_id
 * @property array $messages
 *
 */
class Chat extends ActiveRecord{


    public function getMessages(){
        return $this->hasMany(ChatMessage::class, ['chat_id' => 'id']);
    }

    public function getFiles(){
        return $this->hasMany(File::class, ['chat_id' => 'id']);
    }

    public function newMessagesFor($user_id){
        return $this->getMessages()->andWhere(['and', ['not' , "author_id = $user_id"], ['viewed' => 0]])->all();
    }

}