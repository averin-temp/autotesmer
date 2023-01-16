<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 02.12.2019
 * Time: 18:44
 */

namespace common\components;


use yii\base\Component;

/**
 * Class Notifications
 * @package common\components
 */
class Notifications extends Component
{
    public function sendSupportMessage($message){

        $supportEmail = \Yii::$app->params['supportEmail'];

        return \Yii::$app->mailer->compose()
            ->setFrom('website@autotesmer.ru')
            ->setTo($supportEmail)
            ->setSubject('Уведомление')
            ->setHtmlBody($message)
            ->send();
    }
}