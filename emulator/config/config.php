<?php

use yii\helpers\Url;

$config = [
    'id' => 'emulator',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'panel',
    'controllerNamespace' => 'emulator\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'request' => [
            'enableCsrfValidation' => false,
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=autotesmer_emulator',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'payout/status/<outerId:\d+>' => 'payout/status',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
        'PayU' => [
            'class' => 'common\classes\PayU',
            'merchantName' => 'Эксель ООО',
            // включить логирование на стороне PayU
            'debug' => true,
            // все платежи - тестовые
            'test' => true,
            // данные аккаунта для приема платежей
            'paymentMerchant' => 'trhtrjju',
            'paymentSecretKey' => 'z0@gC2+@0w?c8z0u#426',
            // данные аккаунта для выплат
            'payoutMerchant' => 'rthrrttr',
            'payoutSecretKey' => '7[2n2[5@N)N7!q[9_)Rx',
            // Отдельный merchant id для регистрации карт
            'cardsMerchant' => '12785',
            'url_card_registration' => Url::to('@web-emulator/card/register'),
            'url_payout' => Url::to('@web-emulator/payout/send'),
            'url_lu' => Url::to('@web-emulator/payment/send'),
            'url_pwa_status_check' => Url::to('@web-emulator/payout/check'),
        ],
    ],
];

return $config;