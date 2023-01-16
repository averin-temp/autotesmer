<?php

namespace emulator\controllers;

use common\helpers\CurlHelper;
use emulator\models\Payment;
use yii\db\Query;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;

/**
 * Main emulator controller
 */
class PaymentController extends Controller
{
    public function actionSend(){

        $data = \Yii::$app->request->post();
        $orderID = $data['ORDER_REF'];
        $backRef = $data['BACK_REF'];
        $description = $data['ORDER_PINFO'][0];

        $encodedOrderData = json_encode($data);

        $newPayment = new Payment([
            'order_id' => $orderID,
            'data' => $encodedOrderData,
            'description' => $description,
        ]);
        $newPayment->save();

        $ctrl = hash_hmac('md5', $backRef , \Yii::$app->PayU->paymentSecretKey);
        $urlSuccess =  $backRef . '?' . http_build_query([ 'result' => 0, 'ctrl' => $ctrl ]);
        $urlError =  $backRef . '?' . http_build_query([ 'result' => 1, 'ctrl' => $ctrl ]);

        return $this->render('result', ['urlSuccess' => $urlSuccess, 'urlError' => $urlError ]);
    }


    public function actionReply()
    {
        $payment_id = \Yii::$app->request->post('payment_id');
        $status = \Yii::$app->request->post('status');

        $payment = Payment::findOne($payment_id);
        $orderData = json_decode($payment->data, true);

        $fields = [
            'SALEDATE' => date('Y-m-d H:i:s'),
            'COMPLETE_DATE' => date('Y-m-d H:i:s'),
            'REFNO' => $payment->order_id,
            'REFNOEXT' => $orderData['ORDER_REF'],
            'ORDERNO' =>  $payment->order_id,
            'ORDERSTATUS' => $status,
            'PAYMETHOD' => 'Visa/MasterCard/Eurocard',
            'IPN_PID' => '24003952',
            'IPN_PNAME' => $orderData['ORDER_PNAME'],
            'IPN_PCODE' => $orderData['ORDER_PCODE'],
            'IPN_INFO' => $orderData['ORDER_PINFO'],
            'IPN_QTY' => 1,
            'IPN_PRICE' => $orderData['ORDER_PRICE'],
            'IPN_DATE' => date('YmdHis'),
        ];

        $payU = \Yii::$app->PayU;
        $ipnFields = $payU->ipnFields();

        $data = [];

        foreach($ipnFields as $field) {
            if(isset($fields[$field])) {
                $data[$field] = $fields[$field];
            }
        }

        $data['HASH'] = $payU->paymentHash($data);

        $result = CurlHelper::post('http://autotesmer-test.local/ipn', $data);

        $payment->status = $status;
        $payment->last_result = $result;
        $payment->save();

        return $this->redirect(['/panel']);
    }



}