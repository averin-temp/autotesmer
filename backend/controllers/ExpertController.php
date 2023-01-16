<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 19.06.2019
 * Time: 21:46
 */

namespace backend\controllers;

use common\models\Review;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use yii\base\Exception;
use yii\web\NotFoundHttpException;

class ExpertController extends Controller
{
    public $defaultAction = 'settings';

    /**
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
                        'actions' => [],
                        'roles' => ['editUsers'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $id
     * @return string
     */
    public function actionOrders($id){
        $expert = User::findOne($id);
        return $this->render('orders', [
            'expert' => $expert,
            'orders' => $expert->orders
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionSettings($id){
        $user = User::findOne($id);
        if(!$user) throw new NotFoundHttpException("Не найден пользователь");
        $user->scenario = User::SCENARIO_EXPERT_SETTINGS;
        if($user->load(\Yii::$app->request->post(),'')){
            if($user->save()){
                if($user->can('Клиент')) {
                    $controller = 'client';
                    $flashKey = 'client-settings';
                }
                if($user->can('Эксперт')) {
                    $controller = 'expert';
                    $flashKey = 'client-settings';
                }
                if($user->can('Администратор')) {
                    $controller = 'users/edit';
                    $flashKey = 'saving-report';
                }

                $this->setFlash($flashKey, 'success', 'Успешно сохранено');
                return $this->redirect([ "/$controller" , 'id' => $user->id]);



            }
        }

        $roles = \Yii::$app->authManager->getRoles();
        $socials = \Yii::$app->oauth->socials;
        return $this->render('settings', [
            'expert' => $user,
            'roles' => $roles,
            'socials' => $socials
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPackages($id){
        $expert = User::findOne($id);
        if(!$expert) throw new NotFoundHttpException("Не найден пользователь");
        return $this->render('packages', ['expert' => $expert]);
    }


    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionRequests($id){
        $expert = User::findOne($id);
        if(!$expert) throw new NotFoundHttpException("Не найден пользователь");
        return $this->render('requests', ['expert' => $expert ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionVideo($id){
        $expert = User::findOne($id);
        if(!$expert) throw new NotFoundHttpException("Не найден пользователь");
        return $this->render('video', ['expert' => $expert, 'videos' => $expert->videos ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionInfo($id){
        $expert = User::findOne($id);
        if(!$expert) throw new NotFoundHttpException("Не найден пользователь");
        $expert->scenario = User::SCENARIO_EXPERT_INFO;
        if($expert->load(\Yii::$app->request->post(),'')){
            $expert->save(false);
            $this->setFlash('expert-info', 'success', 'Успешно сохранено');
            return $this->refresh();
        }

        return $this->render('info', ['expert' => $expert]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionReviews($id){

        $expert = User::findOne($id);

        if(!$expert)
            throw new NotFoundHttpException("Не найден пользователь");

        $reviews = Review::findAll(['to' => $expert->id ]);

        return $this->render('reviews', [
            'expert' => $expert,
            'reviews' => $reviews
        ]);
    }

    /**
     * @param $key
     * @param $status
     * @param $message
     */
    private function setFlash($key, $status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }



}