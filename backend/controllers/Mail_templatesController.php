<?php
namespace backend\controllers;

use common\models\Mailing;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\MailTemplate;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class Mail_templatesController extends Controller
{
    public $defaultAction = "list";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list'],
                        'roles' => ['accessMailTemplates'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit', 'create', 'save', 'delete', 'batch'],
                        'roles' => ['editMailTemplates'],
                    ],
                ],
            ],
        ];
    }


    public function actionList(){
        $templates = MailTemplate::find()->all();
        return $this->render('list', ['templates' => $templates]);
    }


    public function actionCreate(){
        $template = new MailTemplate();
        return $this->render('edit', [ 'template' => $template ]);
    }


    public function actionEdit($id){
        $template = MailTemplate::findOne($id);
        return $this->render('edit', [ 'template' => $template ]);
    }


    public function actionSave(){
        $id = \Yii::$app->request->post('id');
        if($id) {
            if(!$template = MailTemplate::findOne($id)){
                throw new NotFoundHttpException("Шаблон не найден");
            }
        } else {
            $template = new MailTemplate();
        }

        if($template->load(\Yii::$app->request->post(),'')){
                if($template->save()){
                    $this->setFlash('edit-template', 'success', 'Шаблон сохранен');
                    return $this->redirect(['mail_templates/edit', 'id' => $template->id ]);
                }
        }


        return $this->render('edit', [
            'template' => $template,
        ]);
    }


    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }

    public function actionDelete($id){
        $template = MailTemplate::findOne($id);
        if($template->delete()){
            $this->setFlash('mail-template-operation', true, 'Почтовый шаблон удален');
        } else {
            $this->setFlash('mail-template-operation', false, 'Почтовый шаблон не удален');
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
                $templates = MailTemplate::findAll(['id' => $ids]);

                foreach($templates as $template){
                    $template->delete();
                }

                $this->setFlash('mail-template-operation', true, "Шаблоны удалены");
            }

        } catch (Exception $e){
            $this->setFlash('mail-template-operation', false, $e->getMessage());
        }

        return $this->redirect(['list']);
    }
}
