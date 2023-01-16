<?php
return [
    'id' => 'app-backend-tests',
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
        'urlManager' => [
            'scriptUrl'=>'/admin/index-test.php',
        ],
    ],
];
