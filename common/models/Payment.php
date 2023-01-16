<?php
namespace common\models;

use common\classes\PayU;
use common\components\OrderService;
use common\components\PackageService;
use common\notifications\Notification;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\Url;

/**
 * Class Payment
 * @package common\models
 *
 * @property int $id
 * @property int $dial_id
 * @property int $user_package_id
 * @property float $sum
 * @property int $status
 * @property string $info
 * @property int $type
 * @property int $user_id
 * @property string $created
 * @property string $service_name
 * @property string $name
 * @property Request $request
 * @property float $discount
 * @property int $promocode_set
 * @property string $promocode
 * @property float $base_sum
 * @property int $target
 *
 */
class Payment extends ActiveRecord
{
    /** черновик */
    const STATUS_DRAFT = 0;
    /** платеж ждет подтверждения */
    const STATUS_WAITING_CONFIRMATION = 1;
    /** платеж завершен */
    const STATUS_CONFIRMED = 2;
    const STATUS_CANCELLED = 3;


    /** резервирование средств для заказа */
    const TYPE_RESERVE = 1;
    /** оплата пакета  */
    const TYPE_PACKAGE_PAYMENT = 2;
    /** оплата продления пакета */
    const TYPE_PACKAGE_EXTENSION = 3;



    /**
     * @return string
     */
    public static function tableName()
    {
        return 'payment';
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['request_id', 'price' ],'safe']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        if($this->type == self::TYPE_PACKAGE_PAYMENT)
        {
            /** @var UserPackage $userPackage */
            $userPackage = UserPackage::findOne($this->target);
            $packageName = $userPackage->package->name;
            return "Оплата пакета " . $packageName . ".";
        }

        return '';
    }


    /**
     * Название оплаты
     *
     * @return string
     */
    public function getName()
    {
        switch($this->type){
            case Payment::TYPE_RESERVE: return "резервирование средств";
            case Payment::TYPE_PACKAGE_PAYMENT: return $this->service_name;
        }

        return 'без названия';
    }


    /**
     * Пользователь - плательщик
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class,['id' => 'user_id']);
    }


    public function onAbort(){}

    public function onProcess(){
        $this->status = Payment::STATUS_PROCESSING;
        $this->save(false);
        \Yii::info("Статус оплаты изменен на STATUS_PROCESSING , id=" . $this->id, __METHOD__);
    }

    public static function promocodeAllowedTypes(){
        return [ self::TYPE_PACKAGE_EXTENSION, self::TYPE_PACKAGE_PAYMENT ];
    }

    /**
     * Принимает ли эта оплата промокоды
     *
     * @return bool
     */
    public function promocodeAllowed(){
        return in_array($this->type, self::promocodeAllowedTypes());
    }

    /**
     * Можно ли в эту оплату установить промокод
     *
     * @return bool
     */
    public function canSetPromocode(){
        return ($this->status == Payment::STATUS_DRAFT) && $this->promocodeAllowed();
    }


    public function applyPromocode($promocode){

        if(empty($promocode)){
            $this->addError('promocode', "Пустой промокод");
            return false;
        }

        if(!in_array($this->type, self::promocodeAllowedTypes()))
        {
            $this->addError('promocode', "Промокод не может быть применен к оплате этого типа");
            return false;
        }

        if($this->promocode){
            $this->addError('promocode', "В оплату уже включен промокод");
            return false;
        }

        $promocode = Promocode::findOne(['code' => $promocode, 'used' => 0]);

        if($promocode == null) {
            $this->addError('promocode', "Промокод не найден");
            return false;
        }

        /** @var PromocodesSet $promocodesSet */
        $promocodesSet = $promocode->set;

        if($promocodesSet == null)  {
            \Yii::error("Набор промокодов c id $promocode->set_id не найден.", __METHOD__);
            $this->addError('promocode', "Ошибка при активации промокода");
            return false;
        }

        if(!$promocodesSet->isActive){
            $this->addError('promocode', "Этот промокод неактивен");
            return false;
        }

        $this->promocode = $promocode->code;
        $this->promocode_set = $promocode->set_id;
        $this->discount = $promocodesSet->discount;
        $this->sum = $this->base_sum * (1 - $this->discount);

        return true;
    }


    /**
     * @return Promocode|null
     */
    public function getPromocode(){
        return Promocode::findOne($this->promocode);
    }

}