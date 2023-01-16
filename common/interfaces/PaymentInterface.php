<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 05.12.2019
 * Time: 17:40
 */

namespace common\interfaces;

use common\models\Payment;
use common\models\Payout;

interface PaymentInterface
{
    public function onSuccessPayment(Payment $payment);
    public function onCancelPayment(Payment $payment);
    public function onSuccessPayout(Payout $payout);
    public function onCancelPayout(Payout $payout);
}