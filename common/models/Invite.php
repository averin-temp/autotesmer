<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Invite
 * @package common\models
 *
 * @property int  $id
 * @property int  $user_id
 * @property string  $key
 * @property User  $user
 */
class Invite extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'invites';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}