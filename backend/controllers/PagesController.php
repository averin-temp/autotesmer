<?php
namespace backend\controllers;

use common\models\Category;
use common\models\Page;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class PagesController extends Controller
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
                        'roles' => ['accessPages'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit','create','delete','save','batch'],
                        'roles' => ['editPages'],
                    ],
                ],
            ],
        ];
    }

    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }

    public function actionList(){
        $data = Page::find()->all();
        $categories = Category::find()->all();
        return $this->render('list', ['pages' => $data, 'categories' => $categories]);
    }


    public function actionEdit($id){
        if(!$page = Page::findOne($id)){
            throw new NotFoundHttpException("Не найдена страница");
        }
        $categories = Category::find()->all();
        return $this->render('edit', ['page' => $page, 'categories' => $categories]);
    }

    public function actionCreate(){
        $page = new Page();
        $categories = Category::find()->all();
        return $this->render('edit', ['page' => $page, 'categories' => $categories]);
    }

    public function actionDelete($id){
        if($page = Page::findOne($id)){
            $page->delete();
            $this->setFlash('pages-table', 'success', 'Страница удалена');
            return $this->redirect(['list']);
        }
        throw new NotFoundHttpException("Не найдена категория");
    }

    public function actionSave(){

        if($id = \Yii::$app->request->post('id')){
            if(!$page = Page::findOne($id)){
                throw new NotFoundHttpException("Не найдена страница");
            }
        } else {
            $page = new Page();
        }

        if($page->load(\Yii::$app->request->post(),'') && $page->save()){
            $this->setFlash('edit-page', 'success', 'Страница сохранена');
            return $this->redirect(['edit', 'id' => $page->id]);
        }

        $categories = Category::find()->all();
        return $this->render('edit', ['page' => $page, 'categories' => $categories]);
    }


    public function actionBatch(){

        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('intval', $ids);
        $action = $request->post('action');

        try{
            if($action == 'delete')
            {
                Page::deleteAll(['id' => $ids]);
                \Yii::$app->session->setFlash('pages-table', ['success' => true, 'message' => "Страницы удалены" ]);
            }

        } catch (Exception $e){
            \Yii::$app->session->setFlash('pages-table', ['success' => false, 'message' => $e->getMessage() ]);
        }

        return $this->redirect(['list']);
    }


}
