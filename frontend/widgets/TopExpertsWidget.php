<?php
namespace frontend\widgets;

use common\classes\OrderCategory;
use common\models\User;
use yii\base\Widget;
use yii\helpers\Html;

class TopExpertsWidget extends Widget
{
    public $category;

    public function run()
    {
        $this->category = \Yii::$app->request->get('top-category', null);

        $expertsQuery = User::find()
            ->where(['id' => \Yii::$app->authManager->getUserIdsByRole('Эксперт') ])
            ->orderBy([ 'rating' => SORT_DESC ]);

        $categories = OrderCategory::categories();
        if(!isset($categories[$this->category])) {
            $category_field = null;
            $this->category = null;
        } else {
            $category_field = 'category_' . $categories[$this->category]['alias'];
        }


        if($category_field) {
            $expertsQuery->andFilterWhere([$category_field => 1]);
        }

        $experts = $expertsQuery->limit(10)->all();

        return $this->render('//widgets/top-experts', ['experts' => $experts, 'category' => $this->category, 'categories' => $categories ]);
    }

}