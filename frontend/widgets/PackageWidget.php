<?php

namespace frontend\widgets;

use common\notifications\Notification;
use common\models\Order;
use common\models\User;
use yii\base\Widget;

/**
 * Class PackageWidget
 * @package frontend\widgets
 */
class PackageWidget extends Widget{

    public $price;
    public $services;
    public $link;
    public $caption;

    public function run()
    {
        return $this->render('//widgets/package', [
            'caption' => $this->caption,
            'price' => $this->price,
            'services' => $this->services,
            'buy_link' => $this->link
        ]);
    }
}
