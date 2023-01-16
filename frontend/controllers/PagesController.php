<?php

namespace frontend\controllers;

use common\models\Page;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Orders controller
 */
class PagesController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRequest(){
        $this->layout = 'page';
        return $this->render('request');
    }


    /**
     * @param $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPage($alias){

        $this->layout = 'page';

        $page = Page::findOne(['url' => $alias]);

        if($page == null)
            throw new NotFoundHttpException("страница не найдена");

        $this->view->params['image'] = '@web/img/types/10.jpg';
        $this->view->title =  $page->name;

        return $this->render('page', [ 'page' => $page ]);
    }

}