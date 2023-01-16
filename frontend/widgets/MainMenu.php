<?php

namespace frontend\widgets;


use common\models\MenuPosition;
use yii\base\Widget;
use yii\helpers\Url;

/**
 * Class IconsBar
 * @package frontend\widgets
 */
class MainMenu extends Widget{

    public $position;

    public function run()
    {
        $position = MenuPosition::findOne(['name' => $this->position]);
        $menus = $position->menus;
        if(empty($menus)) return '';

        $menu = $menus[0];
        $items = $menu->items;
        $currentUrl = Url::current();
        $current_active = 0;
        foreach($items as $item){
            if($item->url == $currentUrl)
                $current_active = $item->id;
        }


        return $this->render('//widgets/mainmenu', [
            'items' => $items,
            'current_active' => $current_active
        ]);
    }


}
