<?php

namespace backend\controllers;

use common\models\Advertising;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;


class AdvertisingController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['accessAdvertising'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete', 'batch'],
                        'roles' => ['editAdvertising'],
                    ],
                ],
            ],
        ];
    }

    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }

    public function actionIndex(){
        $models = Advertising::find()->all();
        return $this->render('index', ['models' => $models]);
    }

    public function actionDelete($id){
        $model = Advertising::findOne($id);
        if($model->delete()){
            $this->setFlash('advertising-table', true, 'Заявка удалена');
        } else {
            $this->setFlash('advertising-table', false, 'Заявка не удален');
        }
        return $this->redirect(['index']);
    }

    public function actionBatch(){

        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('intval', $ids);
        $action = $request->post('action');

        try{
            if($action == 'delete')
            {
                $banners = Advertising::findAll(['id' => $ids]);

                foreach($banners as $banner){
                    $banner->delete();
                }

                $this->setFlash('advertising-table', true,"Заявки удалены" );
            }

        } catch (Exception $e){
            $this->setFlash('advertising-table', false , $e->getMessage() );
        }

        return $this->redirect(['index']);
    }


}