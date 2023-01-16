<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class RequestDialog extends Widget
{
    public $request;


    public function run()
    {
        return ($this->request) ? $this->render('//widgets/request-dialog', ['request' => $this->request]) : '';
    }
}