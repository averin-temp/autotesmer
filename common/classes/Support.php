<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 29.11.2019
 * Time: 18:26
 */

namespace common\classes;


use yii\base\Component;

class Support extends Component
{
    const MESSAGE_STATUS_ERROR = 1;

    public $adminEmail;
    public $webmasterEmail;

    public function notify($message){

        \Yii::$app->mailer->compose()
            ->setFrom('noreply@autotesmer.ru')
            ->setTo($this->webmasterEmail)
            ->setSubject('SITE ERROR')
            ->setTextBody($message)
            ->send();

    }

}