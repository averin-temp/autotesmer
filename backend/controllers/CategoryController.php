<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 30.04.2019
 * Time: 20:11
 */

namespace backend\controllers;


use common\classes\CategoryTree;
use common\models\Category;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
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
                        'roles' => ['accessCategories'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'edit', 'save', 'delete', 'batch'],
                        'roles' => ['editCategories'],
                    ],
                ],
            ],
        ];
    }

    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }

    public function actionList(){
        $categories = CategoryTree::getList();
        return $this->render('list', ['categories' => $categories ]);
    }


    public function actionEdit($id){
        if(!$category = Category::findOne($id)){
            throw new NotFoundHttpException("Не найдена категория");
        }
        $categories = Category::find()->all();
        return $this->render('edit', ['category' => $category, 'categories' => $categories]);
    }

    public function actionCreate(){
        $category = new Category();
        $categories = Category::find()->all();
        return $this->render('edit', ['category' => $category, 'categories' => $categories]);
    }

    public function actionDelete($id){
        if($category = Category::findOne($id)){
            $category->delete();
            $this->setFlash('category-table', 'success', 'Категория удалена');
            return $this->redirect(['list']);
        }
        throw new NotFoundHttpException("Не найдена категория");
    }

    public function actionSave(){

        if($id = \Yii::$app->request->post('id')){
            if(!$category = Category::findOne($id)){
                throw new NotFoundHttpException("Не найдена категория");
            }
        } else {
            $category = new Category();
        }

        if($category->load(\Yii::$app->request->post(),'') && $category->save()){
            $this->setFlash('edit-category', 'success', 'Категория сохранена');
            return $this->redirect(['edit', 'id' => $category->id]);
        }

        $categories = Category::find()->all();
        return $this->render('edit', ['category' => $category, 'categories' => $categories]);
    }


    public function actionBatch(){

        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('intval', $ids);
        $action = $request->post('action');

        try{
            if($action == 'delete')
            {
                foreach(Category::findAll(['id' => $ids]) as $category){
                    $category->delete();
                }
                \Yii::$app->session->setFlash('category-table', ['success' => true, 'message' => "Категории удалены" ]);
            }

        } catch (Exception $e){
            \Yii::$app->session->setFlash('category-table', ['success' => false, 'message' => $e->getMessage() ]);
        }

        return $this->redirect(['list']);
    }

}