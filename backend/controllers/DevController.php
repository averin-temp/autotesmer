<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 21.02.2020
 * Time: 23:02
 */

namespace backend\controllers;

use yii\web\Controller;
use common\classes\DevHelper;

class DevController extends Controller  {

    public function actionClear()
    {
        DevHelper::clearDatabase();
        return $this->goHome();
    }

}