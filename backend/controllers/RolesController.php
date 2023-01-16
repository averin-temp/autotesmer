<?php

namespace backend\controllers;

use app\models\AccessSettingsModel;
use common\models\Role;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use common\models\Group;
use yii\filters\AccessControl;

class RolesController extends Controller{

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['accessRoles'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit', 'delete', 'save', 'add', 'batch'],
                        'roles' => ['editRoles'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(){
        $roles = \Yii::$app->authManager->getRoles();
        $can_edit = \Yii::$app->user->can('editRoles');
        $constant_roles = ["Эксперт", "Клиент", "Администратор"];
        return $this->render('list', ['roles' => $roles, 'can_edit' => $can_edit, 'constant_roles' => $constant_roles ]);
    }

    /**
     * @param $name
     * @return string
     */
    public function actionEdit($name){
        $role = \Yii::$app->authManager->getRole($name);
        $accessModel = new AccessSettingsModel();
        $accessModel->loadRole($role);
        $dependencies = AccessSettingsModel::getAccessDependencies();
        $dependencies= json_encode($dependencies);
        $report = \Yii::$app->session->getFlash('saving-report');
        return $this->render('edit', [
            'model' => $accessModel,
            'report' => $report,
            'dependencies' => $dependencies
        ]);
    }

    /**
     * @return string
     */
    public function actionAdd(){
        $model = new AccessSettingsModel();
        $dependencies = AccessSettingsModel::getAccessDependencies();
        $dependencies = json_encode($dependencies);
        return $this->render('edit', [
            'model' => $model,
            'report' => '',
            'dependencies' => $dependencies
        ]);
    }

    /**
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDelete($name){
        $authManager = \Yii::$app->authManager;
        $role = $authManager->getRole($name);
        $authManager->remove($role);
        \Yii::$app->session->setFlash('role-table', ['success' => true, 'message' => "Роль успешно удалена" ]);
        return $this->redirect(['/roles']);
    }


    /**
     * @param $name
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionSave(){

        $request = \Yii::$app->request;
        $authManager = \Yii::$app->authManager;

        $id = $request->post('id');
        $accessModel = new AccessSettingsModel();
        if($id){
            $role = $authManager->getRole($id);
            $accessModel->loadRole($role);
        }

        $accessModel->clearValues();
        if($accessModel->load($request->post())){
            if($accessModel->save()){
                \Yii::$app->session->setFlash('saving-report', ['status' => 'success', 'message' => 'Успешно сохранено']);
                return $this->redirect([ '/roles/edit', 'name' => $accessModel->name ]);
            }
        }

        $report = \Yii::$app->session->getFlash('saving-report');

        $dependencies = AccessSettingsModel::getAccessDependencies();
        $dependencies= json_encode($dependencies);

        return $this->render('edit', [
            'model' => $accessModel,
            'report' => $report,
            'dependencies' => $dependencies
        ]);
    }

    public function actionBatch(){

        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('trim', $ids);
        $action = $request->post('action');

        try{
            if($action == 'delete')
            {
                foreach($ids as $roleName)
                {
                    if(!in_array($roleName,[ 'Эксперт', 'Клиент', 'Администратор']))
                    {
                        Yii::$app->authManager->remove(
                            Yii::$app->authManager->getRole($roleName)
                        );
                    }
                }
                \Yii::$app->session->setFlash('role-table', ['success' => true, 'message' => "Роли удалены" ]);
            }

        } catch (Exception $e){
            \Yii::$app->session->setFlash('role-table', ['success' => false, 'message' => $e->getMessage() ]);
        }

        return $this->redirect(['index']);
    }


}