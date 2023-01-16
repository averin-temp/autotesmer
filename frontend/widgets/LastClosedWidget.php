<?php

namespace frontend\widgets;

use common\notifications\Notification;
use common\models\Order;
use common\models\User;
use yii\base\Widget;

/**
 * Class IconsBar
 * @package frontend\widgets
 */
class LastClosedWidget extends Widget{


    public function run()
    {
        $orders = Order::findAll(['closed' => 1]);
        return $this->render('//widgets/last-closed', ['orders' => $orders]);
    }


}
