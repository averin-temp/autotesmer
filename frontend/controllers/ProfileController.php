<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\base\InvalidArgumentException;
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
 * Orders controller
 */
class ProfileController extends Controller
{
    public $defaultAction = 'info';
    /**
     *
     *
     * @return mixed
     */
    public function actionInfo($id)
    {
        $expert = User::findOne($id);
        return $this->render('info', ['expert' => $expert]);
    }

    public function actionWorks($id)
    {
        $expert = User::findOne($id);
        return $this->render('works', ['expert' => $expert]);

    }

    public function actionReviews($id)
    {

        $expert = User::findOne($id);
        $param = \Yii::$app->request->get('param');
        if($param == 'pos'){
            $reviews = $expert->positiveReviews;
        } elseif($param == 'neg'){
            $reviews = $expert->negativeReviews;
        } else {
            $reviews = $expert->reviews;
        }
        return $this->render('reviews', [
            'expert' => $expert,
            'reviews' => $reviews,
            'param' => $param
        ]);
    }
}