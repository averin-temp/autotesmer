<?php

namespace frontend\widgets;

use common\notifications\Notification;
use common\models\Order;
use common\models\User;
use common\models\Video;
use yii\base\Widget;

/**
 * Class IconsBar
 * @package frontend\widgets
 */
class LastVideosWidget extends Widget{


    public function run()
    {
        $videos = Video::find()->orderBy('posted')->limit(3)->all();
        return $this->render('//widgets/last-videos', ['videos' => $videos]);
    }


}
