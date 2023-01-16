<?php
namespace backend\controllers;

use common\models\Page;
use Yii;
use yii\web\Controller;
use app\models\LoginModel;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class LoginController extends Controller
{

    public $defaultAction = 'login';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }



    public function actionLogin(){

        $this->layout = 'enter-page';

        $model = new LoginModel();

        if($model->load(Yii::$app->request->post(), '')){
            if($model->login()){
                return $this->redirect(['/dashboard']);
            }
        }

        $networks = \Yii::$app->oauth->socials;

        return $this->render('index', [
            'model' => $model,
            'networks' => $networks
        ]);
    }

    public function actionLogout(){
        \Yii::$app->user->logout();
        return $this->redirect('/login');
    }

}
