<?php
namespace emulator\helpers;

class PayUHelper
{

    public static function paymentStatuses(){
        $statuses = [
            'COMPLETE' => 'платёж завершён, деньги списаны со счёта клиента',
            'PAYMENT_AUTHORIZED' => 'платеж авторизирован',
            'REVERSED' => 'платеж отменен',
            'REFUND' => 'сумма платежа возвращена',
            'TEST' => 'тестовый заказ',
        ];

        return $statuses;
    }

}