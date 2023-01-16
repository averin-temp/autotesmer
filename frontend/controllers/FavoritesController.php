<?php

namespace frontend\controllers;

use common\models\User;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

/**
 * Favorites controller
 */
class FavoritesController extends Controller
{

    /**
     * @throws Exception
     */
    public function actionSet($expert){

        if(\Yii::$app->user->isGuest)
            throw new BadRequestHttpException("неавторизованный пользователь");

        /** @var User $client */
        $client = \Yii::$app->user->identity;
        if(!$client->can('Клиент'))
            throw new BadRequestHttpException('Вы не являетесь клиентом');


        if(!$expert = User::findOne($expert))
            throw new BadRequestHttpException('Пользователь не найден');

        if(!$expert->can("Эксперт"))
            throw new BadRequestHttpException('Пользователь не является Экспертом');

        if($client->hasFavorite($expert->id))
            throw new BadRequestHttpException('Пользователь уже в избранных');

        \Yii::$app->db->createCommand()->insert('favorites', [
            'client_id' => $client->id,
            'expert_id' => $expert->id
        ])->execute();


        return $this->redirect(['/lk/experts']);
    }


    /**
     * @param $expert
     * @return Response
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     * @throws \yii\db\Exception
     */
    public function actionRemove($expert){

        if(\Yii::$app->user->isGuest)
            throw new BadRequestHttpException("неавторизованный пользователь");

        /** @var User $client */
        $client = \Yii::$app->user->identity;
        if(!$client->can('Клиент'))
            throw new BadRequestHttpException('Вы не являетесь клиентом');

        \Yii::$app->db->createCommand()->delete('favorites', [
            'client_id' => $client->id,
            'expert_id' => $expert
        ])->execute();

        return $this->redirect(['/lk/experts']);


    }

}