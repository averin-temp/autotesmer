<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'aliases' => [
        '@web-uploads' => '/uploads',
    ],
    'components' => [
        'request' => [
            'enableCsrfValidation' => false,
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        'js/jQuery-2.1.4.min.js',
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [
                        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'
                    ],
                    'js' => [
                        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
                    ]
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'scriptUrl'=>'/index.php',
            'rules' => [
                'help/search' => 'help/search',
                'help/<alias:.+>' => 'help/page',
                'profile/<id:\d+>' => '/profile',
                'profile/<id:\d+>/<action:\w+>' => 'profile/<action>',
                'about' => 'site/about',
                'experts' => 'site/experts',
                'advertising' => 'advertising/index',
                'politic' => 'site/politic',
                'safety' => 'site/safety',
                'contacts' => 'site/contacts',
                'logout' => 'login/logout',
                'orders' => 'orders/index',
                'payment/ipn' => 'ipn',
                'page/<alias:.*>' => 'pages/page',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
    'on beforeRequest' => function($event){

        /** @var \common\models\User $user */
        $user = Yii::$app->user->identity;
        if($user === null)
            return;

        if($user->can('Эксперт')){
            \Yii::$app->controllerMap['lk'] = 'frontend\controllers\ExpertController';
        }

        if($user->can('Клиент')){
            \Yii::$app->controllerMap['lk'] = 'frontend\controllers\ClientController';
        }
    },
];
