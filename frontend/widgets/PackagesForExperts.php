<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 09.12.2019
 * Time: 14:39
 */

namespace frontend\widgets;


use yii\base\Widget;

class PackagesForExperts extends Widget
{

    public $packages;

    public function run()
    {
        return $this->render('packages-for-experts', [ 'packages' => $this->packages ]);
    }

}