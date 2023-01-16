<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 30.04.2019
 * Time: 19:59
 */

namespace common\models;


use common\classes\Rating;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * Class SafeDial
 * @package common\models
 *
 * @property $id            int
 * @property $order_id      int
 * @property $expert_id     int
 * @property $client_id     int
 * @property $type          int
 * @property $status        int
 * @property Order      $order
 * @property User       $client
 * @property User       $expert
 * @property $request_id    int
 * @property Request        $request
 * @property Brief $brief
 * @property $payout_id     int
 * @property $chat_id       int
 * @property $chat          Chat
 * @property $dispute_id    int
 * @property Dispute        $dispute
 * @property $sum           float
 * @property $payment_id    int
 * @property $brief_id    int
 * @property float    $reward       Вознаграждение за выполнение заказа
 *
 */
class Dial extends ActiveRecord
{
    const TYPE_NORMAL = 1;
    const TYPE_SAFE = 2;

    const STATUS_WAITING_RESERVATION = 1;
    const STATUS_WORK = 2;
    const STATUS_DISPUTE = 3;
    const STATUS_COMPLETED = 5;
    const STATUS_CANCELLED = 6;




    public static function tableName()
    {
        return 'dial';
    }

    public function rules()
    {
        return [
            [['type', 'status'], 'safe'],

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder(){
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient(){
        return $this->hasOne(User::class, ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpert(){
        return $this->hasOne(User::class, ['id' => 'expert_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest(){
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrief(){
        return $this->hasOne(Brief::class, ['request_id' => 'request_id' ]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChat(){
        return $this->hasOne(Chat::class, ['id' => 'chat_id' ]);
    }

    /**
     * Возвращает оплату резервирования вознаграждения за сделку
     *
     * @return Payment|null
     */
    public function getPayment(){
        return $this->hasOne(Payment::class, ['id' => 'payment_id']);
        /* return Payment::findOne([
            'status' => [Payment::STATUS_WAITING_CONFIRMATION, Payment::STATUS_DRAFT],
            'target' => $this->id,
            'type' => Payment::TYPE_RESERVE
        ]);*/
    }


    public function complete(){
        $this->status = self::STATUS_COMPLETED;
        $this->save(false);
        $this->order->close();
    }


    /**
     * Может ли быть отменена сделка
     * @return bool
     */
    public function canBeCanceled(){
        if($this->type == self::TYPE_SAFE){
            return $this->status == self::STATUS_WAITING_RESERVATION;
        }

        // if($this->type == self::TYPE_NORMAL)
        return $this->status == self::STATUS_WORK;
    }

    /**
     * Может быть оспорена
     *
     * @return bool
     */
    public function canBeChallenged(){
        return $this->type == self::TYPE_SAFE && $this->status == self::STATUS_WORK;
    }

}