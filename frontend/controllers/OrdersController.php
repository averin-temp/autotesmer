<?php

namespace frontend\controllers;

use common\classes\DataHelper;
use common\classes\OrderCategory;
use common\components\OrderService;
use common\models\City;
use common\models\Currency;
use common\models\Dial;
use common\models\VehicleBrand;
use common\notifications\Notification;
use common\models\Order;
use common\models\Request;
use common\models\Review;
use common\models\User;
use common\notifications\NotificationHelper;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\VehicleModel;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

/**
* Orders controller
*/
class OrdersController extends Controller
{

    /**
     * @return string
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */
    public function actionIndex()
    {
        $categories = OrderCategory::categories();
        $currentCategory = DataHelper::getParam('category',  array_merge(array_keys($categories),['all']), 'all');
        $currentRegion = \Yii::$app->session->get('city', City::defaultCity()->id);

        $query = Order::find()->where([
            'status' => Order::STATUS_FREE
        ]);

        if($currentRegion){
            $query->andWhere(['client_city' => $currentRegion]);
        }

        if($currentCategory != 'all'){
            $query->andWhere(['category' => $currentCategory]);
        }

        $orders = $query->all();

        /** @var \common\models\User $user */

        $user = null;
        $user_is_expert = false;
        $editableRequest = null;

        if(!\Yii::$app->user->isGuest){
            $user = \Yii::$app->user->identity;
            if($user->can('Эксперт')){
                $user_is_expert = true;
            }
        }

        if($user_is_expert){

            if($id = \Yii::$app->request->post('id')){
                $editableRequest = Request::findOne($id);
                if($editableRequest == null)
                    throw new BadRequestHttpException("неверный идентификатор");
            } else {
                $editableRequest = new Request(['expert_id' => $user->id]);
            }

            if($editableRequest->status == Request::STATUS_REFUSED){
                throw new BadRequestHttpException("Заявка отклонена");
            }

            if($editableRequest->load( \Yii::$app->request->post(),'request')){
                if($editableRequest->validate()) {

                    if($editableRequest->isNewRecord) {
                        $request = \Yii::$app->orderService->addRequest($editableRequest);
                        $request->order->client->sendNotification('new_request', ['expert' => $user->id ]);
                    } else {
                        $editableRequest->save(false);
                    }

                    $editableRequest = null;
                }
            }
        }

        $currencies = Currency::find()->all();

        return $this->render('index', [
            'orders' => $orders,
            'currentCategory' => $currentCategory,
            'currencies' => $currencies,
            'user_is_expert' => $user_is_expert,
            'user' => $user,
            'editableRequest' => $editableRequest
        ]);
    }


    public function actionCreate($category = 1, $type = 1){


        if(!\Yii::$app->user->isGuest){
            /** @var User $user */
            $user = \Yii::$app->user->identity;
            if($user->can('Эксперт')){
                return $this->render('//create_order/you_are_expert');
            }
        }



        $this->layout = 'page';
        \Yii::$app->session->remove('order');

        $currencies = Currency::find()->all();
        $categories = OrderCategory::categories();
        $categoryInfo = $categories[$category];

        $this->view->params['image'] = $categoryInfo['image'];
        $this->view->title = "Создать заявку на подбор";

        $order = new Order([ 'category' => $category, 'type' => $type]);
        $order->scenario = $order->getScenarioFor($category);

        $marks = VehicleBrand::find()->orderBy('name')->all();

        return $this->render($categoryInfo['view'], [
            'model' => $order ,
            'currencies' => $currencies,
            'marks' => $marks
        ]);
    }


    /**
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionSave(){

        $post = \Yii::$app->request->post();

        $category = ArrayHelper::getValue($post, 'category');

        $order = new Order();
        $order->scenario = $order->getScenarioFor($category);
        $order->load($post,'');

        if($order->validate()) {
            if(\Yii::$app->user->isGuest){
                \Yii::$app->session->set('order', $order);
                \Yii::$app->session->setFlash('order_saved', "Ваша заказ сохранен! Для его публикации войдите или зарегистрируйтесь.");
                return $this->redirect('/login');
            }

            if(!\Yii::$app->user->can('Клиент')){
                throw  new ForbiddenHttpException("Вы не являетесь клиентом");
            }

            /** @var User $user */
            $user = \Yii::$app->user->identity;
            $order->client_id = $user->id;
            $order->client_city = $user->city_id;

            \Yii::$app->orderService->addOrder($order);

            return $this->redirect('/lk/search');
        }

        $currencies = Currency::find()->all();
        $categories = OrderCategory::categories();
        $categoryInfo = $categories[$category];

        $marks = VehicleModel::find()->all();

        return $this->render($categoryInfo['view'], [
            'model' => $order ,
            'currencies' => $currencies,
            'marks' => $marks
        ]);
    }


    /**
     * @return \yii\web\Response
     */
    public function actionOffer(){
        return $this->goBack();
    }


    public function actionCancel(){

        $order_id = \Yii::$app->request->post('id', null);

        if($order = Order::findOne($order_id)){

            /** @var User $user */
            $user = \Yii::$app->user->identity;
            if($user->id == $order->client_id)
                \Yii::$app->orderService->cancelOrder($order);
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }


}