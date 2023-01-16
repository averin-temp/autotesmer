<?php

namespace frontend\controllers;

use common\models\File;
use common\models\Order;
use common\models\Report;
use common\models\Review;
use common\notifications\Notification;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Reviews controller
 */
class ReviewsController extends Controller
{
    /**
     * Лэндинг.
     *
     * @return mixed
     */
    public function actionIndex()
    {


        $show = \Yii::$app->request->get('show', 'all');
        $limit = \Yii::$app->request->get('limit', '10');

        if(!in_array($show,['all', 'clients', 'experts'])){
            $show = 'all';
        }
        if(!in_array($limit,['1','10', '50', '100'])){
            $limit = '10';
        }


        $reviews = Review::find();

        if($show == 'clients'){
            $ids = \Yii::$app->authManager->getUserIdsByRole('Клиент');
            $reviews->where(['from' => $ids]);
        }

        if($show == 'experts'){
            $ids = \Yii::$app->authManager->getUserIdsByRole('Эксперт');
            $reviews->where(['from' => $ids]);
        }

        $countQuery = clone $reviews;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => $limit,
        ]);
        $reviews->offset($pages->offset);

        $reviews = $reviews->limit($limit)->all();

        return $this->render('index', [
            'reviews' => $reviews,
            'show' => $show,
            'limit' => $limit,
            'pages' => $pages,
        ]);
    }


    public function actionSend(){

        $content = \Yii::$app->request->post('review');
        $order_id = \Yii::$app->request->post('order_id', null);
        $evaluation = \Yii::$app->request->post('evaluation', null);
        $from = \Yii::$app->request->post('from');
        $to = \Yii::$app->request->post('to', null);

        $review = new Review();
        $review->content = $content;
        $review->to = $to;
        $review->from = $from;
        $review->order_id = $order_id;
        $review->evaluation = $evaluation;
        $review->save(false);

        if($to) Notification::send('review_added', ['target_user' => $to]);

        return $this->redirect(Yii::$app->request->referrer);
    }








}