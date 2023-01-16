<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'statistics' => [
            'class' => 'common\classes\Statistics'
        ],
        'paymentService' => [
            'class' => 'common\components\PaymentService'
        ],
        'packageService' => [
            'class' => 'common\components\PackageService'
        ],
        'notifications' => [
            'class' => 'common\components\Notifications'
        ],
        'orderService' => [
            'class' => 'common\components\OrderService'
        ],
        'support' => [
            'class' => 'common\classes\Support'
        ],
        'oauth' => [
            'class' => 'common\classes\Oauth',
            'socialNetworks' => []
        ],
    ],
];
