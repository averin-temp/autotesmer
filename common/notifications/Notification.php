<?php

namespace common\notifications;

use common\models\User;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Class Notification
 * @package common\notifications
 *
 * @property int $target_user    Кому предназначено уведомление
 * @property User $user    Кому предназначено уведомление
 * @property int $id    Идентификатор
 * @property string $content    Содержание
 * @property int $readed    Прочтено ли суведомление
 * @property string $time    Время создания уведомления
 * @property-read $renderer  объект класса визуализатора
 *
 */
class Notification extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'notifications';
    }

    public function rules()
    {
        return [
            [['content', 'time', 'readed', 'target_user'],'safe']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType(){
        return $this->hasOne(NotificationType::class,['id' => 'type_id']);
    }

    /**
     * Возвращает класс-визуализатор для типа уведомления
     *
     * @return object
     */
    public function getRenderer(){

        $types = self::types();
        $type = $types[$this->type_id];
        $class = 'common\notifications\renderers\\' .  $type->renderer;
        $renderer = new $class();

        return $renderer;
    }


    /**
     * Возвращает все типы уведомлений из базы данных
     *
     * @return array|null|ActiveRecord[]
     */
    public static function types(){

        static $types = null;

        if($types == null) {
            $types = NotificationType::find()->indexBy('id')->all();
        }

        return $types;
    }

    /**
     * Возвращает разметку HTML для вывода уведомления на сайте
     *
     * @return mixed
     */
    public function render(){
        $params = json_decode($this->params);
        $renderer = $this->getRenderer();
        return $renderer->html($params);
    }

    /**
     * Возвращает содержимое email для уведомления, готовое к отправке по почте
     *
     * @return mixed
     */
    public function renderEmail(){
        $params = json_decode($this->params);
        $renderer = $this->getRenderer();
        return $renderer->email($params);
    }


    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'target_user']);
    }

    public function getTime($format){
        return date_create($this->time)->format($format);
    }


    public static function enabled($user_id,$type){
        $result = (new Query())->select($type)->from('notice_settings')->where(['user_id' => $user_id])->scalar();
        return (bool)$result;
    }

    public static function send($type, $params){

        \Yii::warning(print_r($params, true), __METHOD__);

        $user_id = $params['target_user'];
        $params['time'] = date('Y:m:d H:i:s');

        if(!static::enabled($user_id, $type)) return;

        $types = ArrayHelper::index( static::types(), 'name');

        $notification = new self([
            'target_user' => $user_id,
            'type_id' => $types[$type]->id,
            'params' => json_encode($params)
        ]);

        $notification->content = $notification->render();

        $notification->save(false);

        $notification->sendEmail();
    }


    /**
     * Отправляет уведомление через email
     *
     * @return bool
     */
    public function sendEmail(){
        if($this->user->email)
        return \Yii::$app->mailer->compose()
            ->setFrom('website@autotesmer.ru')
            ->setTo($this->user->email)
            ->setSubject('Уведомление')
            ->setHtmlBody($this->renderEmail())
            ->send();

        return false;
    }



}