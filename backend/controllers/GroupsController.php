<?php

namespace backend\controllers;

use Yii;
use yii\base\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\Group;
use yii\filters\AccessControl;
use yii\web\Response;


class GroupsController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['accessGroups'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit', 'add', 'save', 'delete', 'batch'],
                        'roles' => ['editGroups'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $data = Group::find()->all();
        return $this->render('list', ['groups' => $data]);
    }

    public function actionEdit($id){
        $group = Group::findOne($id);
        return $this->render('edit', ['group' => $group ]);
    }

    public function actionAdd(){
        $group = new Group();
        return $this->render('edit', ['group' => $group ]);
    }

    public function actionSave(){

        if($id = Yii::$app->request->post('id')){
            if(!$group = Group::findOne($id))
                throw new Exception("Не найден указанный пользователь");
        } else {
            $group = new Group();
        }

        if($group->load(Yii::$app->request->post(), '')){
            if($group->validate())
            {
                $group->save(false);
                \Yii::$app->session->setFlash('saving-report', ['success' => true, 'message' => 'Успешно сохранено']);
                return $this->redirect(['edit', 'id' => $group->id]);
            }
        }
        return $this->render('edit', ['group' => $group]);
    }


    public function actionDelete($id){

        try{
            if(!$group = Group::findOne($id))
                throw new \Exception('Не найдена указанная группа');

            $group->delete();
            \Yii::$app->session->setFlash('operation-report', ['success' => true, 'message' => "Успешно удалено" ]);
        } catch(\Exception $e){
            \Yii::$app->session->setFlash('operation-report', ['success' => false, 'message' => $e->getMessage() ]);
        }

        return $this->redirect(['/groups']);

    }

    public function actionBatch(){

        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('intval', $ids);
        $action = $request->post('action');

        try{
            if($action == 'delete')
            {
                $groups = Group::findAll(['id' => $ids]);

                foreach($groups as $group){
                    $group->delete();
                }

                \Yii::$app->session->setFlash('operation-report', ['success' => true, 'message' => "Группы удалены" ]);
            }

        } catch (Exception $e){
            \Yii::$app->session->setFlash('operation-report', ['success' => false, 'message' => $e->getMessage() ]);
        }

        return $this->redirect(['index']);
    }

}