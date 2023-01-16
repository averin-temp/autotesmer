<?php

namespace frontend\widgets;

use common\notifications\Notification;
use common\models\User;
use yii\base\Widget;

/**
 * Class IconsBar
 * @package frontend\widgets
 */
class IconsBar extends Widget{


    public function run()
    {
        if(\Yii::$app->user->isGuest){
            return $this->render('//widgets/icon-bar', ['is_guest' => true]);
        }
        /** @var User $user */
        $user = \Yii::$app->user->identity;

        $notifications = $user->getNotifications()
            ->limit(10)
            ->orderBy([ 'time' => SORT_DESC ])
            ->all();

        $new_messages = false;
        foreach($notifications as $notification)
        {
            /** @var $notification \common\notifications\Notification */
            if($notification->readed == 0) {
                $new_messages = true;
                break;
            }
        }
        return $this->render('//widgets/icon-bar', ['is_guest' => false, 'current_user' => $user, 'notifications' => $notifications, 'new_messages' => $new_messages]);
    }


}
