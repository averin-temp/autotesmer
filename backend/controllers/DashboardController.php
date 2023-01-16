<?php
namespace backend\controllers;

use common\classes\Statistics;
use yii\filters\AccessControl;
use common\models\Page;
use Yii;
use yii\web\Controller;
use app\models\LoginModel;

/**
 * Site controller
 */
class DashboardController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['accessBackend'],
                    ],
                ],
            ],
        ];
    }


    /**
     * @return string
     */
    public function actionIndex(){
        /** @var Statistics $statistics */
        $statistics = \Yii::$app->statistics;

        $ordersCount = $statistics->getNewOrdersCount();
        $ordersCount = $statistics->getNewOrdersCount();

        return $this->render('//dashboard/index');
    }

}
