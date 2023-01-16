<?php

namespace backend\controllers;

use common\models\MenuItem;
use common\models\MenuPosition;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\Menu;
use yii\web\NotFoundHttpException;

class MenuController extends Controller{

    /**
     * Поведения
     *
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
                        'roles' => ['accessMenu'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['edit', 'save', 'add', 'delete', 'items', 'item', 'edit_item', 'save_item', 'new_item', 'delete_item', 'batch'],
                        'roles' => ['editMenu'],
                    ],
                ],
            ],
        ];
    }

    private function setFlash($key, $status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }

    /**
     * Список меню
     *
     * @return string
     */
    public function actionIndex(){
        $menus = Menu::find()->all();
        return $this->render('list', ['menus' => $menus]);
    }

    /**
     * Сохранить меню
     *
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionSave(){

        $request = \Yii::$app->request;
        if($id = $request->post('id')){
            $menu = Menu::findOne($id);
        } else {
            $menu = new Menu();
        }

        if($menu->load($request->post(),'') && $menu->save()){
            $menu->clearPositions();
            $menu->setPositions(\Yii::$app->request->post('positions'));
            $this->setFlash('edit-menu','success', "Меню сохранено");
            return $this->redirect(['edit', 'id' => $menu->id]);
        }

        $positions = MenuPosition::find()->all();
        $positions = ArrayHelper::map($positions,'id', 'name');
        $menuPositions =  ArrayHelper::getColumn($menu->positions,'id');
        return $this->render('edit', [
            'menu' => $menu,
            'positions' => $positions,
            'formAction' => Url::to(['save']),
            'menuPositions' => $menuPositions
        ]);
    }


    /**
     * Редактировать меню
     *
     * @param $id
     * @return string
     */
    public function actionEdit($id){
        $menu = Menu::findOne($id);
        $positions = MenuPosition::find()->all();
        $positions = ArrayHelper::map($positions,'id', 'name');
        $menuPositions =  ArrayHelper::getColumn($menu->positions,'id');
        return $this->render('edit', [
            'menu' => $menu,
            'positions' => $positions,
            'formAction' => Url::to(['save']),
            'menuPositions' => $menuPositions
        ]);
    }

    /**
     * Создать меню
     *
     * @return string
     */
    public function actionAdd(){
        $menu = new Menu();
        $positions = MenuPosition::find()->all();
        $positions = ArrayHelper::map($positions,'id', 'name');
        return $this->render('edit', [
            'menu' => $menu,
            'positions' => $positions,
            'formAction' => Url::to(['save']),
            'menuPositions' => []
        ]);
    }


    public function actionDelete_item($id){

        $menuItem = MenuItem::findOne($id);
        if(!$menuItem){
            throw new NotFoundHttpException("не найден пункт меню");
        }

        $menuItem->delete();

        $this->setFlash('menu-items-table', true, "Пункт меню удален");
        return $this->redirect(['items','menu_id' => $menuItem->menu_id]);

    }


    /**
     * Список пунктов меню
     *
     * @param $menu_id
     * @return string
     */
    public function actionItems($menu_id){
        $menu = Menu::findOne($menu_id);
        $items = MenuItem::findAll(['menu_id' => $menu->id]);
        return $this->render('items', [
            'items' => $items,
            'menu' => $menu
        ]);
    }

    /**
     * Редактировать пункт
     *
     * @param $id
     * @return string
     */
    public function actionEdit_item($id){
        $item = MenuItem::findOne($id);
        return $this->render('item', [
            'item' => $item,
        ]);
    }

    /**
     * Сохранить пункт
     *
     * @return string|\yii\web\Response
     */
    public function actionSave_item(){

        $request = \Yii::$app->request;
        if($id = $request->post('id')){
            $item = MenuItem::findOne($id);
        } else {
            $item = new MenuItem();
        }
        if($item->load($request->post(),'') && $item->save()){
            $this->setFlash('menu-items-table', 'success', "Пункт меню сохранен");
            return $this->redirect(['items','menu_id' => $item->menu_id]);
        }

        return $this->render('item', [
            'item' => $item,
        ]);
    }

    /**
     * Создать новый пункт
     *
     * @param $menu_id
     * @return string
     */
    public function actionNew_item($menu_id){
        $item = new MenuItem(['menu_id' => $menu_id]);
        return $this->render('item', [
            'item' => $item,
        ]);
    }


    /**
     * Удалить меню
     *
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id){
        $menu = Menu::findOne($id);
        $menu->delete();
        $this->setFlash('menu-table', true, "Меню удалено");
        return $this->redirect('index');
    }


    public function actionBatch()
    {
        $request = \Yii::$app->request;

        $ids = json_decode($request->post('ids'));
        $ids = array_map('intval', $ids);
        $action = $request->post('action');

        try{
            if($action == 'delete_items')
            {
                $menu_id = $request->post('menu_id');

                $items = MenuItem::findAll(['id' => $ids]);

                $menu = Menu::findOne($menu_id);


                if($menu == null)
                {
                    throw new Exception("не найдено меню");
                }

                foreach($items as $item){
                    $item->delete();
                }

                $this->setFlash('menu-items-table', true, "Пункты меню удалены");
                return $this->redirect(['items','menu_id' => $menu->id ]);
            }

            if($action == 'delete')
            {
                $menus = Menu::findAll(['id' => $ids]);

                foreach($menus as $menu){
                    $menu->delete();
                }

                $this->setFlash('menu-table', true,  "Меню удалены");
                return $this->redirect(['index']);
            }

            throw new Exception("Неизвестная команда");

        } catch (Exception $e){
            $this->setFlash('menu-table', false, $e->getMessage());
        }

        return $this->redirect(['index']);
    }



}