<?php

namespace common\classes;

use common\models\Payment;
use common\models\Payout;
use common\models\User;
use yii\helpers\Url;

/**
 * Class PayU
 * @package common\classes
 *
 * @property $paymentMerchant string
 * @property $payoutMerchant string
 * @property $cardsMerchant string
 * @property $paymentSecretKey string
 * @property $payoutSecretKey string
 * @property $debug bool        Если TRUE - в поля форм для выплат будет добавляться поле DEBUG, которое говорит PayU записывать лог операции для отладки
 * @property $test bool         Если TRUE - в поля форм для выплат будет добавляться поле TESTORDER, которое сообщает PayU что операция тестовая.
 */
class PayU
{


    public $debug;
    public $test;
    public $emulation;
    public $payoutSecretKey;
    public $paymentSecretKey;
    public $payoutMerchant;
    public $paymentMerchant;
    public $cardsMerchant;


    public $url_card_registration = "https://secure.payu.ru/order/pwa/service.php/UTF/NewPayoutCard";
    public $url_payout = 'https://secure.payu.ru/order/prepaid/NewCardPayout';
    public $url_pwa_balance = 'https://secure.payu.ru/api/pwa/v1/balance';
    public $url_pwa_status_check = 'https://secure.payu.ru/api/pwa/v1/payout-status';
    public $url_lu = 'https://secure.payu.ru/order/lu.php';
    public $url_tokens = 'https://secure.payu.ru/order/tokens/';
    public $url_idn = 'https://secure.payu.ru/order/idn.php';
    public $url_irn = 'https://secure.payu.ru/order/irn.php';
    public $url_ios = 'https://secure.payu.ru/order/ios.php';

    /**
     * Базовые поля для запроса Live Update
     *
     * @param $data
     * @return array
     */
    public function liveUpdateBaseFields($data){
        $fields = [
            'MERCHANT',
            'ORDER_REF',
            'ORDER_DATE',
            'ORDER_PNAME[]',
            'ORDER_PCODE[]',
            'ORDER_PINFO[]',
            'ORDER_PRICE[]',
            'ORDER_QTY[]',
            'ORDER_VAT[]',
            'PRICES_CURRENCY',
            'PAY_METHOD',
            'ORDER_PGROUP[]',
            'ORDER_PRICE_TYPE[]',
            'TESTORDER',
        ];

        $baseFields = [];

        foreach($fields as $field){
            if(isset($data[$field])) {
                $baseFields[$field] = $data[$field];
            }
        }

        \Yii::debug($baseFields, __METHOD__);

        return $baseFields;

    }


    /**
     * Создает базовую строку для генерации хэша при запросах на оплату
     * @param $data
     * @return string
     */
    private function generateBaseString($data){
        $string = '';
        foreach($data as $value){
            if(is_array($value)){
                foreach($value as $_value){
                    $string .= strlen($_value) . $_value;
                }
            } else {
                $string .= strlen($value) . $value;
            }

        }
        \Yii::debug($string, __METHOD__);
        return $string;
    }


    /**
     * Проверяет хэш входящего ipn запроса
     *
     * @return bool
     */
    public function checkIpnQuery(){
        $data = \Yii::$app->request->post();

        $hash = $data['HASH'];
        unset($data['HASH']);

        $hash2 = $this->paymentHash($data);

        return $hash == $hash2;
    }


    /**
     * Отправляет запрос на выплату
     *
     * @param $data
     * @param $token
     * @return mixed
     * @throws \Exception
     */
    function sendPayoutRequest($data, $token)
    {
        \Yii::info('sendPayoutRequest_start', 'sendPayoutRequest');

        $data['merchantCode'] = $this->payoutMerchant;
        $data['token'] = $token;
        $data['signature'] = $this->payoutHash($data);

        \Yii::info($data, 'sendPayoutRequest');

        $result = $this->post($this->url_payout, $data);

        \Yii::info($result, 'sendPayoutRequest');

        $result = json_decode($result, true);

        if(json_last_error()){
            \Yii::info(json_last_error(), 'sendPayoutRequest   json_error');
            throw new \Exception(json_last_error_msg() . ': ' . $result);
        }

        return $result;
    }

    /**
     * Выполняет POST запрос и возвращает результат
     *
     * @param $url
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    protected function post($url, array $data)
    {
        $ch = curl_init($url);
        if(!$ch) throw new \Exception("curl_init FALSE");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) throw new \Exception($error);

        return $result;
    }



    /**
     *
     * @param $payout Payout
     * @return null|string
     * @throws \Exception
     */
    public function getPayoutStatus($payout){
        return $this->checkStatus($payout->id, $this->paymentMerchant, $this->paymentSecretKey);
    }



    /**
     *
     * Проверяет статус операции в системе PayU
     *
     * @param int           $operation_id     ID операции
     * @return bool|string
     * @throws \Exception
     */
    public function checkStatus($operation_id){

        $params = [
            'merchant' => $this->payoutMerchant,
            'timestamp' => time(),
        ];
        $params['signature'] = hash_hmac('sha256', implode($params), $this->payoutSecretKey );

        $response = $this->sendStatusRequest($params, $operation_id);

        if(isset($response->payout)){
            if(isset($response->payout->Status)){
                return $response->payout->Status;
            }
        }

        return null;
    }



    /**
     * Запрашивает и возвращает статус операции
     *
     * @param $params
     * @param $outerId
     * @return mixed
     * @throws \Exception
     */
    public function sendStatusRequest($params, $outerId){
        $url = $this->url_lu . '/' . $outerId . '?' . http_build_query($params) ;

        $result =  $this->get($url, $params );
        $result = json_decode($result, true);

        if(json_last_error()){
            throw new \Exception(json_last_error_msg() . ': ' . $result);
        }

        return $result;
    }



    /**
     * @param $url
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    protected function get($url, array $params = [])
    {
        $url .= '?' . http_build_query($params);

        $ch = curl_init($url);
        if(!$ch) throw new \Exception("curl_init FALSE");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) throw new \Exception($error);

        return $result;
    }



    /**
     * Создает хэш для выплат из полей запроса
     *
     * @param $fields
     * @return string
     */
    private function payoutHash($fields){
        ksort($fields);
        $hash = implode($fields) . $this->payoutSecretKey;
        $hash = md5($hash);
        return $hash;
    }

    /**
     * Создает хэш из полей запроса на оплату.
     *
     * @param $fields
     * @return string
     */
    public function paymentHash($fields){
        $base_string = $this->generateBaseString($fields);
        return hash_hmac('md5', $base_string, $this->paymentSecretKey);
    }

    /**
     * Возвращает поля формы оплаты в HTML
     *
     * @param $payment Payment
     * @param $backref string
     * @return array
     * @deprecated
     */
    public function paymentFormFields($payment, $backref){

        $fields = [];

        $fields['MERCHANT'] = $this->paymentMerchant;
        $fields['BACK_REF'] = $backref;
        $fields['ORDER_REF'] = $payment->id;
        $fields['ORDER_DATE'] = $payment->created;
        $fields['ORDER_PNAME[]'] = $payment->name;
        $fields['ORDER_PCODE[]'] = $payment->id;
        $fields['ORDER_PINFO[]'] = $payment->info;
        $fields['ORDER_QTY[]'] = 1;
        $fields['ORDER_VAT[]'] = 0;
        $fields['ORDER_PRICE[]'] = $payment->sum;
        $fields['PRICES_CURRENCY'] = 'RUB';
        $fields['ORDER_PRICE_TYPE[]'] = 'NET';
        $fields['LANGUAGE'] = 'RU';

        if($this->debug) $fields['DEBUG'] = 'TRUE';
        if($this->test)  $fields['TESTORDER'] = 'TRUE';

        /** @var  $user \common\models\User */
        $user = $payment->user;
        $fields['BILL_FNAME'] = $user->firstname;
        $fields['BILL_LNAME'] = $user->family;
        $fields['BILL_EMAIL'] = $user->email;

        $baseFields = $this->liveUpdateBaseFields($fields);
        $fields['ORDER_HASH'] = $this->paymentHash($baseFields);

        return $fields;
    }

    public function paymentRequestData($params)
    {
        $fields = [];

        $fields['MERCHANT'] = $params['MERCHANT'];
        $fields['BACK_REF'] = $params['BACK_REF'];
        $fields['ORDER_REF'] = $params['ORDER_REF'];
        $fields['ORDER_DATE'] = $params['ORDER_DATE'];
        $fields['ORDER_PNAME[]'] = $params['ORDER_PNAME'];
        $fields['ORDER_PCODE[]'] = $params['ORDER_PCODE'];
        $fields['ORDER_PINFO[]'] = $params['ORDER_PINFO'];
        $fields['ORDER_QTY[]'] = 1;
        $fields['ORDER_VAT[]'] = 0;
        $fields['ORDER_PRICE[]'] = $params['ORDER_PRICE'];
        $fields['PRICES_CURRENCY'] = 'RUB';
        $fields['ORDER_PRICE_TYPE[]'] = 'NET';
        $fields['LANGUAGE'] = 'RU';

        if($this->debug) $fields['DEBUG'] = 'TRUE';
        if($this->test)  $fields['TESTORDER'] = 'TRUE';

        $fields['BILL_FNAME'] = $params['BILL_FNAME'];
        $fields['BILL_LNAME'] = $params['BILL_LNAME'];
        $fields['BILL_EMAIL'] = $params['BILL_EMAIL'];

        $baseFields = $this->liveUpdateBaseFields($fields);
        $fields['ORDER_HASH'] = $this->paymentHash($baseFields);

        return $fields;

    }



    /**
     * Возвращает описание кодов ошибок
     *
     * @param $error
     * @return mixed
     */
    public function describeError($error){

        $errors = [
            'Access denied' => 'Доступ к интерфейсу PayU запрещен. Пожалуйста, свяжитесь с командой поддержки PayU',
            'Invalid account' => 'В поле MERCHANT указано неверное значение или значение не указано',
            'Access not permitted' => 'Доступ к функции LiveUpdate ограничен. Свяжитесь с аккаунт-менеджером PayU',
            'Invalid Data' => 'Данные введены некорректно. Проверьте массивы данных',
            'Invalid product code' => 'Массив данных ORDER_PCODE[] сформирован неправильно',
            'Invalid product name' => 'Массив данных ORDER_PNAME[] сформирован неправильно',
            'Invalid product group' => 'Массив данных ORDER_PGROUP[] сформирован неправильно',
            'Invalid price' => 'Массив данных ORDER_PRICE[] сформирован неправильно',
            'Invalid VAT' => 'Массив данных ORDER_VAT[] сформирован неправильно',
            'Invalid Price' => 'Расчет общей суммы неверен. Выполните проверку полей DISCOUNT и ORDER_SHIPPING',
            'Invalid Signature' => 'Подпись HMAC_MD5 для отправленных данных рассчитана неверно',
        ];

        return isset($errors[$error]) ? $errors[$error] : '' ;
    }

    /**
     * Формирует ответ на ipn запрос.
     *
     * @return string
     */
    public function handleIPNResponse(){

        $request  = \Yii::$app->request;

        $ipnPid = $request->post('IPN_PID');
        $ipnName = $request->post('IPN_PNAME');
        $ipnDate = $request->post('IPN_DATE');
        $date = date('YmdHis');

        $hash =
            strlen($ipnPid[0]) . $ipnPid[0] .
            strlen($ipnName[0]) . $ipnName[0] .
            strlen($ipnDate) . $ipnDate .
            strlen($date) . $date;
        $hash = hash_hmac('md5', $hash, $this->paymentSecretKey);
        $result = '<EPAYMENT>' . $date . '|' . $hash . '</EPAYMENT>';
        return $result;
    }


    public function ipnFields(){
        return [
            'SALEDATE',
            'COMPLETE_DATE',
            'REFNO',
            'REFNOEXT',
            'ORDERNO',
            'ORDERSTATUS',
            'PAYMETHOD',
            'FIRSTNAME',
            'LASTNAME',
            'PHONE',
            'CUSTOMEREMAIL',
            'CURRENCY',
            'IPN_PID',
            'IPN_PNAME',
            'IPN_PCODE',
            'IPN_INFO',
            'IPN_QTY',
            'IPN_PRICE',
            'IPN_VAT',
            'IPN_DISCOUNT',
            'IPN_TOTAL',
            'IPN_TOTALGENERAL',
            'IPN_COMMISSION',
            'IPN_DATE'
        ];
    }



    private function payoutResponsesInfo(){
        return [
            '1' => 'Успешно завершено',
            '9' => 'PENDING (нужно запрашивать статус транзакции, пока он не изменится на COMPLETE или CANCELLED)',
            '-1' => 'ОШИБКА',
            '-100' => 'Ошибка при отправке выплаты в банк',
            '-101' => 'Поле MerchantCode не заполнено',
            '-102' => 'Неверное значение поля MerchantCode: информация о Продавце в системе отсутствует',
            '-103' => 'Неверное значение поля MerchantCode: информация о Продавце существует, но пакет выплат не активирован',
            '-104' => 'Ошибка поля Amount',
            '-105' => 'Ошибка поля OuterId',
            '-106' => 'Ошибка поля SenderEmail',
            '-107' => 'Сумма сделки меньше суммы комиссии',
            '-108' => 'Ошибка поля ClientCountry',
            '-109' => 'Ошибка поля CCnumber',
            '-110' => 'Ошибка в описании',
            '-111' => 'Ошибка подписи',
            '-112' => 'Информация по остатку отсутствует',
            '-113' => 'Ошибка поля SenderPhone',
            '-114' => 'Ошибка поля ClientEmail',
            '-115' => 'Ошибка поля ClientPhone',
            '-116' => 'Ошибка поля SenderFirstName',
            '-117' => 'Ошибка поля SenderLastName',
            '-118' => 'Ошибка поля ClientFirstName',
            '-119' => 'Ошибка поля ClientLastName',
            '-120' => 'Ошибка поля Currency',
            '-121' => 'Ошибка поля Timestamp',
            '-122' => 'Следует направить только один идентификатор получателя (токен или карту)',
            '-123' => 'Следует направить хотя бы один идентификатор получателя (токен или карту)',
            '-124' => 'Ошибка токена',
            '-125' => 'Ошибка поля ClientCountryCode',
        ];
    }


    /**
     * Создает поля для формы привязки карты
     *
     * @param User $user
     * @param $backref string
     * @param $request_id int
     * @return array
     */
    public function cardRegistrationFormFields($fields){
        $fields['MerchID'] = $this->cardsMerchant;
        $fields['Timestamp'] = time();
        $fields['Signature'] = $this->payoutHash($fields);
        return $fields;
    }
    
}

