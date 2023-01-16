<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\Page;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class HelpController extends Controller{


    /**
     * @return string
     */
    public function actionIndex(){
        $this->view->title =  "Помощь";
        $helpCategory = Category::getCategoryByName("Помощь");
        $categories = Category::findAll(['parent_id' => $helpCategory->id ]);
        return $this->render('index', ['categories' => $categories]);
    }


    /**
     * @param $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPage($alias){



        $helpCategory = Category::getCategoryByName("Помощь");
        $page = Page::findOne(['url' => $alias]);
        if($page == null) throw new NotFoundHttpException("страница не найдена");
        $categories = Category::findAll(['parent_id' => $helpCategory->id  ]);
        $this->view->title =  $page->name;
        return $this->render('page', ['page' => $page, 'categories' => $categories]);
    }

    /**
     * @param $search
     * @return string
     */
    public function actionSearch($search){
        $pages = Page::find()->filterWhere(['like', 'content', $search])->all();
        $results = [];
        foreach($pages as $page){
            $content = $page->content;
            $matches = '';
            if(preg_match("/$search/", $content, $matches, PREG_OFFSET_CAPTURE)){
                $pos = $matches[0][1];

                $length = strlen($content);
                $start = $pos - 100;
                $end = $pos + 100;
                if($start <= 0) $start = 0;
                if($end > $length) $end = $length;
                $text = substr($content, $start, $end - $start);
                $text = strip_tags($text);
                $text = str_replace($search, "<b>$search</b>", $text);
                $results[] = [
                    'page' => $page,
                    'text' => $text
                ];
            }
        }
        return $this->render('search', ['search' => $search,'results' => $results]);
    }

}