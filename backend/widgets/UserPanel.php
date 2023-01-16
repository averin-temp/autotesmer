<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class UserPanel extends Widget
{
    public $user;

    public function run()
    {
        return $this->render('//widgets/user-panel', ['user' => $this->user]);
    }
}