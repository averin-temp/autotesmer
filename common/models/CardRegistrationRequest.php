<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class CardRegistrationRequest
 * @package common\models
 *
 * @property $id int
 * @property $request_id int
 * @property $user_id int
 * @property $status int
 */
class CardRegistrationRequest extends ActiveRecord
{

    const STATUS_WAITING_CONFIRMATION = 1;
    const STATUS_CONFIRMED = 2;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'card_registration_request';
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


}