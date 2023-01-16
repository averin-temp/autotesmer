<?php

namespace frontend\controllers;

use common\notifications\Notification;
use common\models\User;
use Yii;
use yii\web\Controller;
use frontend\models\LoginForm;

/**
 * Orders controller
 */
class LoginController extends Controller
{
    /**
     * Страница входа.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $post = Yii::$app->request->post();
        $loginForm = new LoginForm();
        if($loginForm->load( $post,'')){
            if($loginForm->login()){

                /** @var User $user */
                $user = \Yii::$app->user->identity;
                if($user->can('Клиент') && \Yii::$app->session->has('order')){
                    $order = \Yii::$app->session->get('order');
                    \Yii::$app->session->remove('order');
                    /** @var User $user */

                    $order->client_id = $user->id;
                    $order->publication_date = date_create()->format("Y-m-d H:i:s");
                    $order->published = 1;
                    $order->period_from = 15;
                    $order->period_to = 20;
                    $order->client_city = $user->city;
                    $order->save(false);
                    Notification::send('you_ordered_a_selection', ['target_user' => $user]);
                }

                return $this->goHome();
            }
        }

        $socials = \Yii::$app->oauth->socials;

        return $this->render('index', [
            'loginForm' => $loginForm,
            'socials' => $socials
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}