<?php
namespace backend\controllers;

use common\models\Group;
use common\models\MailTemplate;
use common\models\PromocodesSet;
use common\models\Role;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\Mailing;
use yii\web\NotFoundHttpException;
use yii\web\Response;


/**
 * Site controller
 */
class MailingController extends Controller
{
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
                        'roles' => ['accessMailing'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit', 'delete', 'create', 'save', 'execute', 'batch'],
                        'roles' => ['editMailing'],
                    ],
                ],
            ],
        ];
    }

    public function actionList(){
        $mailings = Mailing::find()->all();
        return $this->render('list', ['mailings' => $mailings]);
    }


    public function actionCreate(){
        $mailing = new Mailing();
        $templates = MailTemplate::find()->all();
        $groups = Group::find()->all();
        $roles = \Yii::$app->authManager->getRoles();
        $promocodesSets = PromocodesSet::find()->all();
        return $this->render('edit', [
            'mailing' => $mailing,
            'groups' => $groups,
            'templates' => $templates,
            'roles' => $roles,
            'promocodesSets' => $promocodesSets
        ]);
    }


    public function actionEdit($id){
        $mailing = Mailing::findOne($id);
        $templates = MailTemplate::find()->all();
        $groups = Group::find()->all();
        $roles = \Yii::$app->authManager->getRoles();
        $promocodesSets = PromocodesSet::find()->all();
        return $this->render('edit', [
            'mailing' => $mailing,
            'groups' => $groups,
            'templates' => $templates,
            'roles' => $roles,
            'promocodesSets' => $promocodesSets
        ]);
    }


    /**
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionSave(){
        $request = \Yii::$app->request;

        $id = $request->post('id');
        $shedule = $request->post('shedule', '');
        $post = $request->post();

        if($date = date_create_from_format('d.m.Y H:i' ,$shedule)){
            $post['shedule'] = $date->format('Y:m:d H:i:s');
        }

        if($id) {
            if(!$mailing = Mailing::findOne($id)){
                throw new NotFoundHttpException("Рассылка не найдена");
            }
        } else {
            $mailing = new Mailing();
        }

        if($mailing->load($post ,'')){
            if($mailing->validate()){
                if($mailing->save()){
                    $groups = $request->post('groups', []);
                    $roles = $request->post('roles', []);
                    $mailing->updateGroups($groups);
                    $mailing->updateRoles($roles);
                    $this->setFlash('edit-mailing', 'success', 'Рассылка сохранена');
                    return $this->redirect(['edit', 'id' => $mailing->id ]);
                }
            }
        }

        $templates = MailTemplate::find()->all();
        $groups = Group::find()->all();
        $roles = \Yii::$app->authManager->getRoles();
        $promocodesSets = PromocodesSet::find()->all();
        return $this->render('edit', [
            'mailing' => $mailing,
            'groups' => $groups,
            'templates' => $templates,
            'roles' => $roles,
            'promocodesSets' => $promocodesSets
        ]);
    }


    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id){
        $mailing = Mailing::findOne($id);
        if($mailing->delete()){
            $this->setFlash('banner-delete', 'success', 'Баннер удален');
        } else {
            $this->setFlash('banner-delete', 'error', 'Баннер не удален');
        }
        return $this->redirect(['list']);
    }


    public function actionExecute(){

        $id = \Yii::$app->request->getBodyParam('id');

        $mailing = Mailing::findOne($id);
        $mailing->execute();

        if(\Yii::$app->request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ['ok' => true];
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
                $mailings = Mailing::findAll(['id' => $ids]);

                foreach($mailings as $mailing){
                    $mailing->delete();
                }

                $this->setFlash('mailing-table',  true, "Рассылки удалены");
            }

        } catch (Exception $e){
            $this->setFlash('mailing-table',  false, $e->getMessage());
        }

        return $this->redirect(['list']);
    }
}
