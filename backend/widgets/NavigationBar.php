<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 28.04.2019
 * Time: 16:59
 */

namespace backend\widgets;

use common\models\AdminNotification;
use common\notifications\Notification;
use common\models\User;
use yii\base\Widget;

/**
 * Class NavigationBar
 * @package backend\widgets
 *
 * @property User $current_user
 */
class NavigationBar extends Widget
{
    public $current_user;

    public function init()
    {
        parent::init();
        $this->current_user = \Yii::$app->user->identity;
    }

    public function run()
    {

        $notifications = AdminNotification::findAll(['target_id' => $this->current_user, 'viewed' => 0 ]);
        return $this->render('//widgets/navigation-bar', ['notifications' => $notifications, 'user' => $this->current_user]);
    }

}