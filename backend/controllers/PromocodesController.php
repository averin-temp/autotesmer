<?php

namespace backend\controllers;

use common\models\Package;
use common\models\Promocode;
use Yii;
use yii\base\Exception;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\PromocodesSet;
use yii\web\NotFoundHttpException;

class PromocodesController extends Controller{

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
                        'roles' => ['accessPromocodes'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit','delete','create','generate', 'save', 'removecode', 'batch'],
                        'roles' => ['editPromocodes'],
                    ],
                ],
            ],
        ];
    }

    public function actionList(){
        $data = PromocodesSet::find()->all();
        return $this->render('list', ['promocodesSets' => $data]);
    }

    public function actionEdit($id){
        $packages = Package::find()->all();
        $data = PromocodesSet::findOne($id);
        return $this->render('edit', ['promocodesSet' => $data, 'packages' => $packages]);
    }

    public function actionCreate(){
        $packages = Package::find()->all();
        $data = new PromocodesSet();
        return $this->render('edit', ['promocodesSet' => $data, 'packages' => $packages ]);
    }

    public function actionGenerate(){
        $id = \Yii::$app->request->post('id');

        $number = \Yii::$app->request->post('number');
        if(!$promocode = PromocodesSet::findOne($id)){
            throw new NotFoundHttpException("не найден промокод");
        }
        $promocode->createCodes($number);
        $this->setFlash('promocode-edit', 'success', 'Коды созданы');
        return $this->redirect(['promocodes/edit', 'id' => $promocode->id]);
    }

    public function actionSave()
    {
        $id = \Yii::$app->request->post('id');
        if($id) {
            if(!$promocodesSet = PromocodesSet::findOne($id)){
                throw new NotFoundHttpException("Банер не найден");
            }
        } else {
            $promocodesSet = new PromocodesSet();
        }

        if($promocodesSet->load(\Yii::$app->request->post(),'')){
                if($promocodesSet->save()){

                    $promocodesSet->updatePackages();


                    $this->setFlash('promocode-edit', 'success', 'Набор сохранен');
                    return $this->redirect(['promocodes/edit', 'id' => $promocodesSet->id]);
                }
        }

        $packages = Package::find()->all();
        return $this->render('edit', ['promocodesSet' => $promocodesSet, 'packages' => $packages]);
    }

    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }


    public function actionDelete($id){
        if(PromocodesSet::deleteAll(['id' => $id])){
            \Yii::$app->db->createCommand()->delete('promocodes', ['set_id' => $id])->execute();
            $this->setFlash('promocode-edit', 'success', "Набор удален");
        }
        else {
            $this->setFlash('promocode-edit', 'success', "Набор удален");
        }

        return $this->redirect(['promocodes/list']);
    }

    public function actionRemovecode($code){
        $code = (new Query())->from('promocodes')->where(['code'=>$code])->one();
        \Yii::$app->db->createCommand()->delete('promocodes',['code' => $code['code']])->execute();
        $this->setFlash('promocode-edit', 'success', "Код {$code['code']} удален");
        return $this->redirect(['promocodes/edit', 'id' => $code['set_id']]);
    }


    public function actionBatch(){

        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('intval', $ids);
        $action = $request->post('action');

        try{
            if($action == 'delete')
            {
                $promocodeSets = PromocodesSet::findAll(['id' => $ids]);

                foreach($promocodeSets as $promocodeSet){
                    $promocodeSet->delete();
                }
                $this->setFlash('promocode-edit', true,  "Наборы удалены" );
            }

            if($action == 'delete-code')
            {
                $promocodes = Promocode::findAll(['code' => $ids]);

                foreach($promocodes as $promocode){
                    $promocode->delete();
                }
                $this->setFlash('promocode-edit', true,  "Коды удалены" );

            }

        } catch (Exception $e){
            $this->setFlash('promocode-edit', false,  $e->getMessage());
        }

        return $this->redirect(['list']);
    }


}