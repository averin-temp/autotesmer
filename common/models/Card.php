<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Card
 * @package common\models
 *
 * @property $user_id int
 * @property $token int
 * @property $user User
 */
class Card extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'cards';
    }


    public function getUser(){
        return $this->hasOne(User::class,['id' => 'user_id']);
    }



}