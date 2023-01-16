<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Payment
 * @package common\models
 *
 * @property int $id
 * @property float $sum
 * @property int $status
 * @property int $type
 * @property int $user_id
 * @property User $user
 * @property int $dial_id
 * @property Dial $dial
 * @property string $description
 * @property int $target
 */
class Payout extends ActiveRecord
{

    const STATUS_WAITING_CONFIRMATION = 1;
    const STATUS_CONFIRMED = 2;
    const STATUS_CANCELLED = 3;


    /** возврат средств за сделку */
    const TYPE_REFUND = 1;
    /** выплата вознаграждения */
    const TYPE_REWARD = 2;
    /** простой возврат средств */
    const TYPE_REVERSE = 3;




    /**
     * @return string
     */
    public static function tableName()
    {
        return 'payout';
    }

    public function rules()
    {
        return [
            [['request_id', 'price' ],'safe']
        ];
    }

    /**
     *
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest(){
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Сделка для которой производится выплата
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDial(){
        return $this->hasOne(Dial::class, ['id' => 'dial_id']);
    }

    /**
     * Текстовое описание выплаты
     *
     * @return string
     */
    public function getDescription(){
        return '';
    }

}