<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Class Review
 * @package common\models
 *
 * @property int $id
 * @property int $from
 * @property int $to
 * @property int $order_id
 * @property string $content
 * @property int $evaluation
 * @property string $created
 * @property int $sender User
 * @property int $receiver User
 *
 */
class Review extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'review';
    }


    /**
     * @return User|null
     * @throws NotFoundHttpException
     */
    public function getSender(){
        $user = User::findOne($this->from);
        if(empty($user))
            throw new NotFoundHttpException("Пользователь не найден");
        return $user;
    }

    /**
     * @return User|null
     * @throws NotFoundHttpException
     */
    public function getReceiver(){
        $user = User::findOne($this->to);
        if(empty($user))
            throw new NotFoundHttpException("Пользователь не найден");
        return $user;
    }


    public function getDate($format){
        return date_create($this->created)->format($format);
    }


}