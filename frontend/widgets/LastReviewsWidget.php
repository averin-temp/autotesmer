<?php

namespace frontend\widgets;

use common\models\Review;
use yii\base\Widget;

/**
 * Class IconsBar
 * @package frontend\widgets
 */
class LastReviewsWidget extends Widget{


    public function run()
    {
        $reviews = Review::find()->orderBy('created')->limit(3)->all();
        return $this->render('//widgets/last-reviews', ['reviews' => $reviews]);
    }


}
