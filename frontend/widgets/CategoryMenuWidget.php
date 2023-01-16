<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 06.05.2019
 * Time: 0:36
 */

namespace frontend\widgets;


use common\classes\OrderCategory;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class CategoryMenuWidget extends Widget
{
    public $active;

    public function run()
    {
        if($this->active == null)
            $this->active = 'all';

        $categories = OrderCategory::categories();

        return $this->render('//widgets/category-menu', [
            'active' => $this->active,
            'categories' => $categories
        ]);
    }

}