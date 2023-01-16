<?php

namespace frontend\widgets;

use yii\db\Query;
use common\models\Banner;
use yii\base\Widget;

/**
 * Class BannersWidget
 * @package frontend\widgets
 */
class BannersWidget extends Widget{

    public $position;

    public function run()
    {
        $banners = Banner::findAll((new Query())->select('banner_id')->from('banner_position')->where(['position' => $this->position]));
        foreach($banners as $banner){
            $banner->shown();
        }
        return $this->render('//widgets/banners', ['banners' => $banners]);
    }


}
