<?php

namespace frontend\widgets;

use common\models\MenuPosition;
use yii\base\Widget;
use yii\helpers\Url;

/**
 * Class BannersWidget
 * @package frontend\widgets
 */
class FooterMenuWidget extends Widget{

    public $position;

    public function run()
    {
        $position = MenuPosition::findOne(['name' => $this->position]);
        $menus = $position->menus;
        if(empty($menus)) return '';

        return $this->render('//widgets/footer_menu', [
            'menus' => $menus
        ]);
    }


}
