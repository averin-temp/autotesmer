<?php

namespace backend\controllers;

use common\models\Group;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Banner;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class BannersController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['accessBanners'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit','delete', 'batch'],
                        'roles' => ['editBanners'],
                    ],
                ],
            ],
        ];
    }

    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }

    public function actionIndex(){
        $data = Banner::find()->all();
        return $this->render('list', ['banners' => $data]);
    }


    public function actionEdit(){

        $id = \Yii::$app->request->get('id');
        if($id) {
            if(!$banner = Banner::findOne($id)){
                throw new NotFoundHttpException("Банер не найден");
            }
        } else {
            $banner = new Banner();
        }

        if($banner->load(\Yii::$app->request->post(),'')){
            $banner->uploadedImage = UploadedFile::getInstanceByName('banner_file');



            if($banner->validate()){
                $banner->saveImage();
                if($banner->save(false)){
                    $this->setFlash('edit-banner', true, 'Баннер сохранен');
                    return $this->redirect(['edit', 'id' => $banner->id]);
                }
            }
        }

        $groups = Group::find()->all();
        return $this->render('edit', ['banner' => $banner, 'groups' => $groups]);
    }


    public function actionDelete($id){
        $banner = Banner::findOne($id);
        if($banner->delete()){
            $this->setFlash('banner-table', true, 'Баннер удален');
        } else {
            $this->setFlash('banner-table', false, 'Баннер не удален');
        }
        return $this->redirect(['list']);
    }

    public function actionBatch(){

        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('intval', $ids);
        $action = $request->post('action');

        try{
            if($action == 'delete')
            {
                $banners = Banner::findAll(['id' => $ids]);

                foreach($banners as $banner){
                    $banner->delete();
                }

                $this->setFlash('banner-table', true,"Баннеры удалены" );
            }

        } catch (Exception $e){
            $this->setFlash('banner-table', false , $e->getMessage() );
        }

        return $this->redirect(['index']);
    }


}