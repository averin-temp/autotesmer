<?php
namespace common\helpers;


use common\models\Order;
use common\models\User;

class UserHelper {

    public static function clientOrdersInWork($user){
        return Order::find()->where(['client_id' => $user->id , 'status' => Order::STATUS_WORK ])->all();
    }


    /**
     * Создает эксперта с любыми параметрами
     *
     * @param array $properties
     * @return User
     * @throws \Exception
     */
    public static function createExpert($properties = [])
    {

        $properties['category_auto'] = 1;
        $user = new User($properties);
        $user->save(false);

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole('Эксперт');
        $auth->assign($role, $user->id);

        return $user;
    }


    /**
     * Создает клиента с любыми параметрами
     *
     * @param $email
     * @param $password
     * @param array $properties    остальные параметры , помимо обязательных email и password,
     * если указан activation_key то пользователь будет неактивным, если нет - активным
     * @return User
     * @throws \Exception
     */
    public static function createClient($properties = [])
    {
        $user = new User();
        $user->family = isset($properties['family']) ? $properties['family'] : '';
        $user->firstname = isset($properties['firstname']) ? $properties['firstname'] : '';
        $user->lastname = isset($properties['lastname']) ? $properties['lastname'] : '';
        $user->phone = isset($properties['phone']) ? $properties['phone'] : '';
        $user->email = isset($properties['email']) ? $properties['email'] : '';
        $user->password = isset($properties['password']) ? $properties['password'] : '';
        $user->activation_key = isset($properties['activation_key']) ? $properties['activation_key'] : '';
        $user->active = isset($properties['active']) ? $properties['active'] : 0;
        $user->city_id = isset($properties['city_id']) ? $properties['city_id'] : '';
        $user->save(false);

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole('Клиент');
        $auth->assign($role, $user->id);

        return $user;
    }



}