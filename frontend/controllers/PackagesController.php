<?php

namespace frontend\controllers;


use common\models\PackageVariant;
use common\models\Payment;
use common\models\User;
use common\models\UserPackage;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\base\Exception;
use yii\web\ForbiddenHttpException;

class PackagesController extends Controller
{


    /**
     * Заказать пакет
     *
     * @param $id
     * @return mixed
     * @throws Exception
     * @throws ForbiddenHttpException
     */
    public function actionOrder($id){


        $variant = PackageVariant::findOne($id);

        if($variant == null){
            throw new Exception("Пакет не найден");
        }

        /** @var User $user */
        $user = \Yii::$app->user->identity;

        if($user == null){
            throw new Exception("Пользователь не авторизован");
        }

        if(!$user->can("Эксперт")){
            throw new ForbiddenHttpException("Вы не являетесь экспертом");
        }

        $service = \Yii::$app->packageService;
        $userPackage = $service->createUserPackage($variant, $user);

        if($userPackage == null){
            throw new Exception("пакет не создан");
        }

        $payment = $service->createPackagePayment($userPackage, Payment::TYPE_PACKAGE_PAYMENT);

        return $this->redirect(['/payment' , 'id' => $payment->id ]);
    }


    /**
     * Заказать продление пакета
     *
     * @param $id
     * @return \yii\web\Response
     * @throws Exception
     */
    public function actionExtend($id){

        $userPackage = UserPackage::findOne($id);

        $service = \Yii::$app->packageService;

        $payment = $service->createPackagePayment($userPackage, Payment::TYPE_PACKAGE_EXTENSION);

        return $this->redirect(['/payment', 'id' => $payment->id ]);
    }


    /**
     * @param $id
     * @return \yii\web\Response
     * @throws Exception
     */
    public function actionPayment($id){

        /** @var UserPackage $userPackage */
        $userPackage = UserPackage::findOne($id);


        $service = \Yii::$app->packageService;
        $payment = $service->createPackagePayment($userPackage, Payment::TYPE_PACKAGE_PAYMENT);

        return $this->redirect(['/payment', 'id' => $payment->id ]);
    }

    /**
     * @param int $id  ID пакета
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionCancel($id){

        if(!$userPackage = UserPackage::findOne($id)){
            throw new BadRequestHttpException("не найден пакет");
        }

        \Yii::$app->packageService->cancelOrder($userPackage);

        return $this->redirect(['/lk/packages_added']);

    }
}

