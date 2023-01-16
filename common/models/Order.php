<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use common\classes\OrderCategory;
use common\classes\OrderType;
use common\classes\Rating;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class Order
 * @package common\models
 *
 * @property int            $id
 * @property float          $budget_from            Бюджет от
 * @property float          $budget_to              Бюджет до
 * @property int            $body                   Кузов
 * @property int            $category               Категория транспорта
 * @property VehicleBrand   $mark                   Марка
 * @property int            $mark_id                ID марки
 * @property VehicleModel   $model                  Модель
 * @property VehicleModel   $model_id               ID модели
 * @property int            $mass                   Масса
 * @property int            $drive                  Привод
 * @property int            $transmission           Трансмиссия
 * @property int            $engine                 Двигатель
 * @property int            $original_pts           Оригинал ПТС
 * @property int            $currency_id            ID Валюта
 * @property Currency       $currency               Валюта
 * @property int            $year_from              Нижний предел года выпуска
 * @property int            $year_to                Год до
 * @property User           $client                 Заказчик
 * @property Request[]      $requests               Заявки экспертов
 * @property User           $publication_date       Дата публикации заказа
 * @property User           $period_from            Срок подбора от
 * @property User           $period_to              Срок подбора до
 * @property int            $expert_id              Выбранный исполинтель
 * @property User           $expert                 Выбранный исполинтель
 * @property int            $closed                 Закрыт ли заказ
 * @property int            $client_id              ID заказчика
 * @property int            $client_city            ID Город заказчика
 * @property City           $clientCity             Город заказчика
 * @property string         $region                 Город заказчика
 * @property string         $comment                Комментарий заказчика
 * @property string         $water_category         Подкатегория водного транспорта
 * @property string         $commerce_category      Подкатегория коммерческого транспорта
 * @property int            $status                 Подкатегория коммерческого транспорта
 * @property int            $dial_id                Идентификатор сделки
 * @property Dial           $dial                   Cделка
 * @property int            $published              Опубликован или нет
 * @property int            $original_body          Кузов, который был указан при создании заказа
 * @property int            $original_year_from     Нижний предел года выпуска, который был указан при создании заказа
 * @property int            $original_mark          Марка , которая была указана при создании заказа
 *
 */
class Order extends ActiveRecord
{

    const STATUS_FREE = 1;
    const STATUS_WAITING_RESERVATION = 2;
    const STATUS_WORK = 3;
    const STATUS_DISPUTE = 4;
    const STATUS_CLOSED = 5;
    const STATUS_CANCELLED = 6;


    const SCENARIO_AUTO     = 1;
    const SCENARIO_FREIGHT  = 2;
    const SCENARIO_MOTO     = 3;
    const SCENARIO_COMMERCE = 4;
    const SCENARIO_WATER    = 5;
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function rules()
    {
        return [

            // common
            [['type', 'category', 'client_id'], 'required'],
            [['comment'], 'required', 'message' => 'Введите комментарий'],
            //[['currency_id'], 'required', 'message' => 'Укажите валюту'],
            [['currency_id'], 'default', 'value' => 1 ],
            [['period_from', 'period_to'], 'required', 'message' => 'Укажите сроки'],
            [['period_from', 'period_to'], 'number', 'message' => 'Введите количество дней числом'],
            [['budget_to'], 'required', 'message' => 'Укажите бюджет'],
            [['budget_from'], 'required', 'message' => 'Укажите бюджет'],
            [['budget_to', 'budget_from'], 'number'],
            ['budget_to', 'compare', 'compareAttribute' => 'budget_from', 'operator' => '>=', 'type' => 'number', 'message' => "Нижняя граница бюджета больше верхней" ],
            ['period_to', 'compare', 'compareAttribute' => 'period_from', 'operator' => '>=', 'type' => 'number', 'message' => "Нижняя граница срока больше верхней" ],
            ['type', 'validateType'],
            ['category', 'validateCategory'],


            // SCENARIO_AUTO
            //[['body'], 'required', 'message' => 'Укажите тип кузова', 'on' => self::SCENARIO_AUTO],
            //[['drive'], 'required', 'message' => 'Укажите тип привода', 'on' => self::SCENARIO_AUTO],
            //[['engine'], 'required', 'message' => 'Укажите тип двигателя', 'on' => self::SCENARIO_AUTO],
            //[['transmission'], 'required', 'message' => 'Укажите тип трансмиссии', 'on' => self::SCENARIO_AUTO],
            [['engine_volume_from'], 'required', 'message' => 'Укажите объем двигателя', 'on' => self::SCENARIO_AUTO],
            [['engine_volume_to'], 'required', 'message' => 'Укажите объем двигателя', 'on' => self::SCENARIO_AUTO],
            [['power_from'], 'required', 'message' => 'Укажите мощность', 'on' => self::SCENARIO_AUTO],
            [['power_to'], 'required', 'message' => 'Укажите мощность', 'on' => self::SCENARIO_AUTO],
            ['model_id', 'exist', 'targetClass' => VehicleModel::class, 'targetAttribute' => ['model_id' => 'id'], 'skipOnEmpty' => true, 'on' => self::SCENARIO_AUTO],
            ['mark_id', 'exist', 'targetClass' => VehicleBrand::class, 'targetAttribute' => ['mark_id' => 'id'], 'skipOnEmpty' => true, 'on' => self::SCENARIO_AUTO],


            [['moto_hours_from'], 'required', 'message' => 'Укажите моточасы', 'on' => self::SCENARIO_COMMERCE],
            [['moto_hours_to'], 'required', 'message' => 'Укажите моточасы', 'on' => self::SCENARIO_COMMERCE],
            [['commerce_category'], 'required', 'message' => 'Укажите категорию', 'on' => self::SCENARIO_COMMERCE],


            [['mass'], 'required', 'message' => 'Укажите массу', 'on' => self::SCENARIO_FREIGHT],
            [['body'], 'required', 'message' => 'Укажите тип кузова', 'on' => self::SCENARIO_FREIGHT],
            [['drive'], 'required', 'message' => 'Укажите тип привода', 'on' => self::SCENARIO_FREIGHT],
            [['engine'], 'required', 'message' => 'Укажите тип двигателя', 'on' => self::SCENARIO_FREIGHT],
            [['transmission'], 'required', 'message' => 'Укажите тип трансмиссии', 'on' => self::SCENARIO_FREIGHT],


            [['transmission'], 'required', 'message' => 'Укажите тип трансмиссии', 'on' => self::SCENARIO_MOTO],
            [['moto_category'], 'required', 'message' => 'Укажите категорию транспорта', 'on' => self::SCENARIO_MOTO],
            [['engine_volume_from'], 'required', 'message' => 'Укажите объем двигателя', 'on' => self::SCENARIO_MOTO],
            [['engine_volume_to'], 'required', 'message' => 'Укажите объем двигателя', 'on' => self::SCENARIO_MOTO],
            [['engine'], 'required', 'message' => 'Укажите тип двигателя', 'on' => self::SCENARIO_MOTO],
            [['power_from'], 'required', 'message' => 'Укажите мощность', 'on' => self::SCENARIO_MOTO],
            [['power_to'], 'required', 'message' => 'Укажите мощность', 'on' => self::SCENARIO_MOTO],


            [['water_category'], 'required', 'message' => 'Укажите категорию транспорта', 'on' => self::SCENARIO_WATER],
            [['moto_hours_from'], 'required', 'message' => 'Укажите моточасы', 'on' => self::SCENARIO_WATER],
            [['moto_hours_to'], 'required', 'message' => 'Укажите моточасы', 'on' => self::SCENARIO_WATER],
            [['power_from'], 'required', 'message' => 'Укажите мощность', 'on' => self::SCENARIO_WATER],
            [['power_to'], 'required', 'message' => 'Укажите мощность', 'on' => self::SCENARIO_WATER],

        ];

        // TODO: пока так, но позже обязательно убрать client_id из "безопасных атрибутов"
    }


    public function getModel(){
        return $this->hasOne(VehicleModel::class, ['id' => 'model_id']);
    }

    public function getMark(){
        return $this->hasOne(VehicleBrand::class, ['id' => 'mark_id']);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_AUTO] = [
            'id', 'category', 'type', 'mark_id', 'model_id', 'transmission',
            'drive', 'body', 'engine', 'year_to', 'year_from', 'power_from', 'power_to',
            'budget_from', 'budget_to', 'period_from', 'period_to','currency_id', 'original_pts',  'gbo',
            'engine_volume_from', 'engine_volume_to', 'comment'
        ];

        $scenarios[self::SCENARIO_COMMERCE] = [
            'id','category', 'type', 'mark', 'commerce_category', 'moto_hours_from', 'moto_hours_to',
            'year_to', 'year_from', 'budget_from', 'budget_to', 'currency_id',
            'engine_volume_from', 'engine_volume_to', 'original_pts', 'comment', 'period_from', 'period_to'
        ];

        $scenarios[self::SCENARIO_FREIGHT] = [
            'id','category', 'type', 'mark', 'transmission',
            'drive', 'mass', 'engine', 'moto_hours_from', 'moto_hours_to',
            'year_to', 'year_from', 'budget_from', 'budget_to', 'currency_id',
            'original_pts', 'comment', 'body', 'period_from', 'period_to'
        ];

        $scenarios[self::SCENARIO_MOTO] = [
            'id','category', 'type', 'mark', 'engine', 'moto_category',
            'drive', 'mass', 'engine', 'engine_volume_from', 'engine_volume_to',
            'year_to', 'year_from', 'budget_from', 'budget_to', 'currency_id',
            'original_pts', 'comment', 'period_from', 'period_to'
        ];

        $scenarios[self::SCENARIO_WATER] = [
            'id','category', 'type', 'mark', 'water_category',
            'drive', 'mass', 'engine', 'moto_hours_from', 'moto_hours_to',
            'year_to', 'year_from', 'budget_from', 'budget_to', 'currency_id',
            'power_from', 'power_to', 'original_pts', 'comment', 'period_from', 'period_to'
        ];

        return $scenarios;
    }

    public function validateType($attribute, $params){
        if(!in_array($this->$attribute, array_keys( OrderType::types() ))){
            $this->addError($attribute, "Неверный тип заказа");
        }
    }

    public function validateCategory($attribute, $params){
        if(!in_array($this->$attribute, array_keys( OrderCategory::categories() ))){
            $this->addError($attribute, "Неверная категория заказа");
        }
    }

    public function getScenarioFor($category){
        switch($category){
            case OrderCategory::CATEGORY_AUTO:
                return self::SCENARIO_AUTO;
            case OrderCategory::CATEGORY_FREIGHT:
                return self::SCENARIO_FREIGHT;
            case OrderCategory::CATEGORY_MOTO:
                return self::SCENARIO_MOTO;
            case OrderCategory::CATEGORY_COMMERCE:
                return self::SCENARIO_COMMERCE;
            case OrderCategory::CATEGORY_WATER:
                return self::SCENARIO_WATER;
            default: throw new NotFoundHttpException("неверный сценарий модели");
        }
    }

    public function getClient(){
        return $this->hasOne(User::class, ['id' => 'client_id']);
    }

    public function publicationDate($format){
        return date_create($this->publication_date)->format($format);
    }

    public function requestsCount(){
        $requests = $this->requests;
        return count($requests);
    }

    public function getExpert(){
        return $this->hasOne(User::class, ['id' => 'expert_id']);
    }


    /**
     * @param $user_id
     * @return Request|null
     */
    public function getUserRequest($user_id){
        return Request::findOne(['expert_id' => $user_id, 'order_id' => $this->id]);
    }

    /**
     * @return ActiveQuery
     */
    public function getRequests(){
        return $this->hasMany(Request::class, ['order_id' => 'id']);
    }


    public function getActiveRequests()
    {
        return $this->hasMany(Request::class, ['order_id' => 'id'])->where(['status' => [
            Request::STATUS_OPEN,
            Request::STATUS_WAITING_ACCEPTANCE
        ] ]);
    }

    /**
     * @param $expert_id
     * @return Brief|null
     */
    public function getBriefFrom($expert_id){
        return Brief::findOne(['order_id' => $this->id, 'request_id' => $this->getRequestFrom($expert_id) ]);
    }

    /**
     * @param $expert_id
     * @return Request|null
     */
    public function getRequestFrom($expert_id){
        return Request::findOne(['order_id' => $this->id, 'expert_id' => $expert_id]);
    }



    public function categoryLabel(){
        $categories = OrderCategory::categories();
        return $categories[$this->category]['label'];
    }

    public function typeLabel(){
        $types = OrderType::types();
        return $types[$this->type]['label'];
    }

    public function chatWith($user_id){
        return Chat::findOne(['order_id' => $this->id, 'expert_id' => $user_id]);
    }

    public static function bodies($category = null){
        $bodies =  [
            OrderCategory::CATEGORY_FREIGHT => [
                // грузовые
                1 => 'Фургон',
                2 => 'Грузовик',
                3 => 'Сдельный тягач',
            ],
            OrderCategory::CATEGORY_AUTO => [
                // легковые
                4 => 'Седан',
                5 => 'Хэтчбек',
                6 => 'Лифтбек',
                7 => 'Внедорожник',
                8 => 'Универсал',
                9 => 'Купе',
                10 => 'Минивэн',
                11 => 'Пикап',
                12 => 'Лимузин',
                13 => 'Фургон',
                14 => 'Кабриолет',
            ],
        ];

        if($category) {
            return isset($bodies[$category]) ? $bodies[$category] : [] ;
        }
        return $bodies;

    }


    public function errorField($attribute){
        if($this->hasErrors($attribute)){
            echo "<div class='form-error'><p>" . $this->getFirstError($attribute) . "</p></div>";
        }
    }


    public static function subcategories($category = null){
        $subs = [
            OrderCategory::CATEGORY_MOTO => [
                1 => 'Мотоцикл',
                2 => 'Скутер',
                3 => 'Мотовездеход',
                4 => 'Снегоход'
            ],
            OrderCategory::CATEGORY_COMMERCE => [
                5 => 'Автобус',
                6 => 'Прицеп',
                7 => 'Сельскохозяйственная',
                8 => 'Строительная',
                9 => 'Коммунальная',
                10 => 'Автокраны'
            ],
            OrderCategory::CATEGORY_WATER => [
                11 => 'Моторная лодка',
                12 => 'Катера и яхты',
                13 => 'Надувные лодки',
                14 => 'Гидроциклы',
                15 => 'Весельные лодки',
                16 => 'Каяки и каноэ'
            ],
        ];
        if($category) {

            return isset($subs[$category]) ? $subs[$category] : [] ;
        }
        return $subs;
    }


    public static function commerce_categories(){
        return [
            1 => 'Автобус',
            2 => 'Прицеп',
            3 => 'Сельскохозяйственная',
            4 => 'Строительная',
            5 => 'Коммунальная',
            6 => 'Автокраны'
        ];
    }

    public static function water_categories(){
        return [
            1 => 'Моторная лодка',
            2 => 'Катера и яхты',
            3 => 'Надувные лодки',
            4 => 'Гидроциклы',
            5 => 'Весельные лодки',
            6 => 'Каяки и каноэ'
        ];
    }

    public static function moto_categories(){
        return [
            1 => 'Мотоцикл',
            2 => 'Скутер',
            3 => 'Мотовездеход',
            4 => 'Снегоход'
        ];
    }

    public static function engines($category = null){
        $engines = [

            OrderCategory::CATEGORY_FREIGHT => [
                1 => 'Дизельный',
                2 => 'Бензиновый',
            ],
            OrderCategory::CATEGORY_MOTO => [
                3 => '4 такта',
                4 => '2 такта'
            ],
            OrderCategory::CATEGORY_AUTO => [
                1 => 'Дизельный',
                2 => 'Бензиновый',
                5 => 'Электрически',
                6 =>  'Гибридный',
            ],



        ];

        if($category) return isset($engines[$category]) ? $engines[$category] : [] ;
        return $engines;

    }

    public static function drives(){
        return [
            1 => 'Заднеприводный с подключаемым передним',
            2 => 'Задний',
            3 => 'Передний',
            4 => 'Полный',
            5 => 'Полный подключаемый',
            6 => 'Постоянный привод на все колеса',
        ];
    }

    public static function masses(){
        $masses = [
            1 => 'до 1 т',
            2 => '1 - 1,5 т',
            3 => 'от 1,5 т',
        ];
        return $masses;
    }

    public static function transmissions(){
        return [
            1 => 'Автомат',
            2 => 'Робот',
            3 => 'Механика',
            4 => 'Вариатор',
        ];
    }


    public function getRegion(){

        if($this->client_city == '') return "Россия";

        $region = (new Query())
            ->select('name')
            ->from('city')
            ->where(['id' => $this->client_city ])
            ->one();

        if(empty($region))
            throw new ServerErrorHttpException("не найден регион в заказе");

        return $region['name'];
    }



    public function nameLabel(){

        $parts = [];

        if($this->model){
            $parts[] = $this->model->name;
        } else {
            $parts[] = "Любая марка";
        }

        if($this->body){
            $parts[] = self::bodies($this->category)[$this->body];
        }

        if($this->year_from){
            $parts[] = $this->year_from . ' года';
        }

        return implode(' ', $parts);
    }


    /////////////////////////////////
    /// функции отзывов

    /**
     * Возвращает все отзывы , относящиеся к заказу
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews(){
        return $this->hasMany(Review::class, ['order_id' => 'id']);
    }

    /**
     * Возвращает отзыв эксперта или null
     * @return \yii\db\ActiveQuery
     */
    public function getExpertReview(){
        return $this->hasOne(Review::class,['order_id' => 'id'])
            ->where(['from' => $this->expert_id, 'to' => $this->client_id]);
    }

    /**
     * Возвращает отзыв клиента или null
     * @return \yii\db\ActiveQuery
     */
    public function getClientReview(){
        return $this->hasOne(Review::class,['order_id' => 'id'])
            ->where(['from' =>  $this->client_id , 'to' => $this->expert_id]);
    }

    /**
     * Возвращает отзывы клиента и эксперта в виде массива с ключами 'client', 'expert'
     * @return array
     */
    public function getReviewsSorted(){
        $sorted = [];
        foreach($this->reviews as $review){
            if($review->from == $this->client_id) $sorted['client'] = $review;
            if($review->from == $this->expert_id) $sorted['expert'] = $review;
        }
        return $sorted;
    }

    public function getClientCity(){
        return $this->hasOne(City::class, ['id' => 'client_city']);
    }


    public function getCurrency(){
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    /**
     * Возвращает сделку
     *
     * @return ActiveQuery
     */
    public function getDial(){
        return $this->hasOne(Dial::class, ['id' => 'dial_id'])
            ->where(['status' => [
                Dial::STATUS_WAITING_RESERVATION,
                Dial::STATUS_WORK,
                Dial::STATUS_DISPUTE,
                Dial::STATUS_COMPLETED
            ]]);
    }


    public function getVehicleCategory(){
        return $this->category;
    }


    public function close(){
        $this->status = self::STATUS_CLOSED;
        $this->save(false);
        $this->expert->updateRating(Rating::COMPLETE_DIAL_RATING_POINTS);
        $this->client->sendNotification('you_confirmed_work');
    }

    /**
     * Может ли заказ быть отменен
     *
     * @return bool
     */
    public function canBeCanceled(){
        return $this->status == Order::STATUS_FREE || $this->status == Order::STATUS_WAITING_RESERVATION;
    }




}