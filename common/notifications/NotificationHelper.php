<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 26.09.2019
 * Time: 0:54
 */

namespace common\notifications;


use common\models\User;

class NotificationHelper
{
    public static function sendWorksInYourRegion($region_id){

        $users = User::findAll(['city_id' => $region_id]);

        foreach($users as $user){
            Notification::send('works_in_your_region',['target_user' => $user->id]);
        }

    }

}