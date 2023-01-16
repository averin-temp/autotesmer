<?php

namespace common\classes;

use common\models\Order;
use common\models\User;
use yii\base\Component;

class Statistics extends Component
{




    public function getRegistrationsCount(){
        return 100;
    }

    public function getUniqueUsersCount(){
        return 100;
    }

    public function getNewOrdersCount(){
        return 100;
    }

    public function getUsersCount(){
        return User::find()->count();
    }

    public function getOrdersCount(){
        return Order::find()->count();;
    }

}