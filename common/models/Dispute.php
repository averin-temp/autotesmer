<?php
namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class Dispute
 * @package common\models
 *
 * @property $id int
 * @property $client_chat_id int
 * @property $expert_chat_id int
 * @property $order_id int
 * @property $dial_chat_id int
 * @property $client_id int
 * @property $expert_id int
 * @property $status int
 * @property $client_appeal_id int
 * @property $expert_appeal_id int
 * @property $clientChat common\models\Chat
 * @property $expertChat Chat
 * @property $dialChat Chat
 * @property $clientAppeal Appeal
 * @property $expertAppeal Appeal
 * @property $dial_id int
 *
 *
 */
class Dispute extends ActiveRecord{

    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;

    const DECISION_CONTINUE_DIAL = 1;
    const DECISION_CLOSE_DIAL = 2;
    const DECISION_CANCEL_DIAL = 3;


    /**
     * @return string
     */
    public static function tableName()
    {
        return 'dispute';
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient(){
        return $this->hasOne(User::class,['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpert(){
        return $this->hasOne(User::class,['id' => 'expert_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDial(){
        return $this->hasOne(Dial::class,['id' => 'dial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientChat(){
        return $this->hasOne(Chat::class,['id' => 'client_chat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpertChat(){
        return $this->hasOne(Chat::class,['id' => 'expert_chat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDialChat(){
        return $this->hasOne(Chat::class,['id' => 'dial_chat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientAppeal(){
        return $this->hasOne(Appeal::class,['id' => 'client_appeal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpertAppeal(){
        return $this->hasOne(Appeal::class,['id' => 'expert_appeal_id']);
    }

}