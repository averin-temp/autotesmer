<?php
namespace frontend\widgets;

use yii\base\Widget;

class SocialRegistrationWidget extends Widget
{
    public $userType;

    public function run()
    {
        $networks = \Yii::$app->oauth->socialNetworks;
        return $this->render('//widgets/social-registration', ['networks' => $networks, 'type' => $this->userType ]);
    }
}