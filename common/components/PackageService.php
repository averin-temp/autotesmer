<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 30.11.2019
 * Time: 15:39
 */

namespace common\components;


use common\interfaces\PaymentInterface;
use common\models\Package;
use common\models\PackageVariant;
use common\models\Payment;
use common\models\Payout;
use common\models\Service;
use common\models\User;
use common\models\UserPackage;
use yii\base\Component;
use yii\base\Exception;

class PackageService extends Component implements PaymentInterface
{

    /**
     * @param UserPackage $userPackage
     */
    public function onPackageExtensionPaid($userPackage){
        $this->extendPackage($userPackage);
    }

    /**
     * Расширяет пакет
     *
     * @param UserPackage $userPackage
     */
    public function extendPackage($userPackage){
        foreach($userPackage->packageVariant->servicesSettings as $serviceOptions){
            $service = Service::findOne(['user_package_id' => $userPackage->id, 'service_type' => $serviceOptions->service_type ]);
            $service->extend($serviceOptions);
            $service->save(false);
        }
    }

    public function onSuccessPayment(Payment $payment){


        if($payment->type == Payment::TYPE_PACKAGE_PAYMENT){

            /** @var UserPackage $userPackage */
            $userPackage = UserPackage::findOne($payment->target);
            $this->onPackagePaid($userPackage);
        }

        if($payment->type == Payment::TYPE_PACKAGE_EXTENSION){

            /** @var UserPackage $userPackage */
            $userPackage = UserPackage::findOne($payment->target);
            $this->onPackageExtensionPaid($userPackage);
        }

    }

    public function onCancelPayment(Payment $payment){ }

    public function onSuccessPayout(Payout $payout){   }

    public function onCancelPayout(Payout $payout){ }

    /**
     * @param UserPackage $userPackage
     */
    public function onPackagePaid($userPackage){
        $userPackage->paid = 1;
        $userPackage->save(false);
        $this->activatePackage($userPackage);
        $userPackage->user->sendNotification('package_obtained');
    }


    public function activatePackage($package){
        foreach($package->packageVariant->servicesSettings as $serviceOptions){
            if(!Service::create($package->user_id, $package->id, $serviceOptions, true))
                \Yii::warning("Сервис не создан. " . __METHOD__ );
        }
    }

    /**
     * Создает пакет
     *
     * @param PackageVariant $packageVariant
     * @param User $expert
     * @return UserPackage
     */
    public function createUserPackage($packageVariant, $expert){

        $userPackage = new UserPackage([
            'package_variant_id' => $packageVariant->id,
            'package_id' => $packageVariant->base_id,
            'paid' => 0,
            'user_id' => $expert->id,
        ]);

        $userPackage->save(false);

        return $userPackage;
    }

    /**
     * @param UserPackage $userPackage
     * @param int $type
     *
     * @return Payment
     * @throws Exception
     */
    public function createPackagePayment($userPackage, $type){

        $service = \Yii::$app->paymentService;

        $payment = $service->createPayment(
            $userPackage->user_id,
            $type,
            $userPackage->id,
            $userPackage->packageVariant->price,
            "Оплата пакета"
        );

        $userPackage->payment_id = $payment->id;
        $userPackage->save(false);

        return $payment;
    }

    /**
     * @param UserPackage $userPackage
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function cancelOrder($userPackage){

        if($userPackage->paid){
            throw new Exception("Услуга уже активна");
        }

        $this->deleteUserPackage($userPackage);
    }


    /**
     * Удаляет пользовательский пакет
     *
     * @param $userPackage
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    private function deleteUserPackage($userPackage){
        /** @var Payment|null $payment */
        $payment = $this->getPackageActivePayment($userPackage);
        if($payment) \Yii::$app->paymentService->cancelPayment($payment);
        $userPackage->delete();
    }


    /**
     * @param UserPackage $userPackage
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getPackageActivePayment(UserPackage $userPackage){
        return Payment::find()->where( [ 'target' => $userPackage->id, 'type' => [ Payment::TYPE_PACKAGE_PAYMENT, Payment::TYPE_PACKAGE_EXTENSION]])
            ->andWhere([ 'not in', 'status', [Payment::STATUS_CANCELLED, Payment::STATUS_CONFIRMED] ])->one();
    }

}