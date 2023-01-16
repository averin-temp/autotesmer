<?php

namespace backend\controllers;

use common\models\PackageVariant;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Package;
use yii\web\NotFoundHttpException;

class PackagesController extends Controller{

    public $defaultAction = 'list';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list'],
                        'roles' => ['accessPackages'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit', 'delete', 'add', 'addvariant', 'deletevariant', 'editvariant', 'savevariant', 'save', 'batch'],
                        'roles' => ['editPackages'],
                    ],
                ],
            ],
        ];
    }



    public function actionList(){
        $packages = Package::find()->all();
        return $this->render('list', ['packages' => $packages]);
    }

    public function actionEdit($id){
        $package = Package::findOne($id);
        if(empty($package)) throw new NotFoundHttpException("Нет пакетов с таким ID");
        return $this->render('edit', ['package' => $package]);
    }

    public function actionSave(){
        $id = \Yii::$app->request->post('id');
        if($id){
            if(!$package = Package::findOne($id)){
                throw new NotFoundHttpException("не найден пакет");
            }
        } else {
            $package = new Package();
        }

        if($package->load( \Yii::$app->request->post(),'')){
            if($package->save()) {
                $this->setFlash('edit-package', true, 'Пакет сохранен');
                return $this->redirect(['edit', 'id' => $package->id]);
            }
        }

        return $this->render('edit', ['package' => $package]);
    }


    public function actionSavevariant(){
        $request = \Yii::$app->request;
        $id = $request->post('id');
        $package_id = $request->post('package');

        if(!$package = Package::findOne($package_id))
            throw new NotFoundHttpException("Не найден пакет");
        if($id){
            if(!$packageVariant = PackageVariant::findOne($id))
                throw new NotFoundHttpException("Вариант не найден");
        } else {
            $packageVariant = new PackageVariant(['base_id' => $package->id]);
        }

        if($packageVariant->load($request->post(),'')){
            if($packageVariant->save()){
                $packageVariant->saveServiceOptions();
                $this->setFlash('package-variant-info', true, 'Вариант сохранен');
                return $this->redirect(['/packages/editvariant','id' => $packageVariant->id]);
            }
        }


        return $this->render('edit-variant', ['packageVariant' => $packageVariant, 'package' => $packageVariant->package] );
    }

    public function actionAddvariant($package)
    {
        if(!$package = Package::findOne($package))
            throw new NotFoundHttpException("Не найден пакет");

        $variant = new PackageVariant(['base_id' => $package->id]);
        return $this->render('edit-variant', [
            'packageVariant' => $variant,
            'package' => $variant->package
        ]);
    }


    public function actionDelete($id){
        if(!$package = Package::findOne($id)) throw new NotFoundHttpException("не найден пакет");
        if($package->delete()){
            $this->setFlash('package-table', true, 'Пакет удален');
        } else {
            $this->setFlash('package-table', false, 'Пакет не удален');
        }
        return $this->redirect(['list']);
    }

    public function actionDeletevariant($id){
        if(!$variant = PackageVariant::findOne($id)) throw new NotFoundHttpException("не найден ариант");
        if($variant->delete()){
            $this->setFlash('edit-package', true, 'Вариант удален');
        } else {
            $this->setFlash('edit-package', false, 'Вариант не удален');
        }
        return $this->redirect(['edit', 'id' => $variant->package->id]);
    }



    public function actionEditvariant($id){
        $packageVariant = PackageVariant::findOne($id);
        if(empty($packageVariant)) throw new NotFoundHttpException("Нет вариантов пакета с таким ID");
        return $this->render('edit-variant', [
            'packageVariant' => $packageVariant,
            'package' => $packageVariant->package
        ]);
    }



    public function actionAdd(){
        $package = new Package;
        return $this->render('edit', ['package' => $package]);
    }

    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }


    public function actionBatch()
    {
        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('intval', $ids);
        $action = $request->post('action');
        $package_id = $request->post('package');

        try{
            if($action == 'delete_variants')
            {
                $packageVariants = PackageVariant::findAll(['id' => $ids]);

                $package = Package::findOne($package_id);


                if($package == null)
                {
                    throw new Exception("Не найден пакет");
                }

                foreach($packageVariants as $variant){
                    $variant->delete();
                }

                $this->setFlash('edit-package', true, "Варианты удалены");
                return $this->redirect(['edit', 'id' => $package->id ]);
            }

            if($action == 'delete')
            {
                $packages = Package::findAll(['id' => $ids]);

                foreach($packages as $package){
                    $package->delete();
                }

                $this->setFlash('package-table', true,  "Пакеты удалены");
                return $this->redirect(['list']);
            }

            throw new Exception("Неизвестная команда");

        } catch (Exception $e){
            $this->setFlash('package-table', false, $e->getMessage());
        }

        return $this->redirect(['list']);
    }

}