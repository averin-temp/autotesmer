<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 19.06.2019
 * Time: 21:43
 */

namespace backend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use yii\base\Exception;
use yii\web\NotFoundHttpException;

class ClientController extends Controller
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
                        'roles' => ['editUsers'],
                    ],
                ],
            ],
        ];
    }


    public function actionOrders($id){
        $client = User::findOne($id);
        return $this->render('orders', [
            'client' => $client,
            'orders' => $client->orders
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionSettings($id){

        $user = User::findOne($id);
        if(!$user)
            throw new NotFoundHttpException("Не найден пользователь");

        if(!$user->can('Клиент'))
            throw new NotFoundHttpException("Неверный тип пользователя");

        $user->scenario = User::SCENARIO_CLIENT_SETTINGS;
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
            'client' => $user,
            'roles' => $roles,
            'socials' => $socials
        ]);
    }

    private function setFlash($key,$status, $message){
        \Yii::$app->session->setFlash($key, [ 'status' => $status, 'message' => $message ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionInfo($id){
        $client = User::findOne($id);
        if(!$client) throw new NotFoundHttpException("Не найден пользователь");
        $client->scenario = User::SCENARIO_CLIENT_INFO;
        if($client->load(\Yii::$app->request->post(),'')){
            $client->save(false);
            $this->setFlash('info', 'success', 'Успешно сохранено');
            return $this->refresh();
        }

        return $this->render('info', ['client' => $client]);
    }




}