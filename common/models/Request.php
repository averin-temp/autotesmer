<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use Symfony\Component\Finder\Exception\AccessDeniedException;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * Class Request
 * @package common\models
 *
 * @property int        $id
 * @property string     $content
 * @property int        $expert_id
 * @property int        $order_id
 * @property Currency   $currency
 * @property int        $price
 * @property int        $period
 * @property Order      $order
 * @property User       $expert
 * @property Chat       $chat
 * @property int        $chat_id
 * @property Brief      $brief
 * @property int        $metric
 * @property int        $status
 *
 *
 */
class Request extends ActiveRecord
{

    const STATUS_OPEN = 1; //  заявка может быть изменена и удалена
    const STATUS_WAITING_ACCEPTANCE = 2;   // бриф отправлен клиенту, заявку нельзя удалять и изменять
    const STATUS_WAITING_RESERVATION = 3;    // ожидание подтверждения резервирования средств при безопасной сделке,  нельзя удалять и изменять заявку
    const STATUS_ACCEPTED = 4;  // заявка принята.
    const STATUS_REFUSED = 5; // заявка отклонена, можно удаляять но нельзя изменять

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'requests';
    }

    public function rules()
    {
        return [
            [['content'], 'string'],
            [['expert_id', 'order_id', 'period', 'currency_id', 'price', 'metric'], 'integer'],
            [['expert_id'], 'required', 'message' => "Необходим идентификатор эксперта"],
            [['order_id'], 'validateOrder'],
            [['content'], 'required', 'message' => "Добавьте комментарий"],
            [['price'], 'required', 'message' => "Укажите стоимость"],
            [['metric'], 'required', 'message' => "Укажите период"],
            [['period'], 'required', 'message' => "Укажите период"],
        ];
    }

    public function validateOrder($attribute, $params)
    {
        $order = Order::findOne($this->$attribute);

        if($order == null){
            throw new NotFoundHttpException("Не найден заказ");
        }

        if($order->status == Order::STATUS_CANCELLED)
        {
            throw new BadRequestHttpException("Заказ отменен");
        }
    }


    public function getOrder(){
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getExpert(){
        return $this->hasOne(User::class, ['id' => 'expert_id']);
    }

    public function getChat(){
        return $this->hasOne(Chat::class, ['id' => 'chat_id']);
    }

    public function getBrief(){
        return $this->hasOne(Brief::class, ['request_id' => 'id']);
    }

    public function getCurrency(){
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }


    public function beforeSave($insert)
    {
        if($insert){

            $chat = new Chat([
                'owner_id' => $this->order_id,
                'user1_id' => $this->order->client_id,
                'user2_id' => $this->expert_id
            ]);

            if($chat->save()){
                $this->chat_id = $chat->id;
                return true;
            }

            return false;
        }

        return true;
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function beforeDelete()
    {

        if($brief = $this->brief){
            $brief->delete();
        }
        $this->chat->delete();

        return parent::beforeDelete();
    }



}