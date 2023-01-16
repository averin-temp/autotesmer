<?php
namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class Appeal
 * @package common\models
 *
 *
 * @property $status int
 * @property $user_id int
 * @property $dial_id int
 * @property $dispute_id int
 * @property $content string
 * @property $user User
 * @property $dial Dial
 * @property $dispute Dispute
 */
class Appeal extends ActiveRecord{


    /**
     * @return string
     */
    public static function tableName()
    {
        return 'appeal';
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['content'], 'required', 'message' => "Напишите тут суть жалобы"],
            [['dial_id'], 'required' ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::class,['id' => 'user_id']);
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
    public function getDispute(){
        return $this->hasOne(Dispute::class,['id' => 'dispute_id']);
    }




}