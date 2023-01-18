<?php

use yii\web\MultipartFormDataParser;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'restapi\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'seller' => [
            'class' => 'restapi\modules\seller\Seller',
        ]
    ],
    'defaultRoute' => 'user',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-restapi',
            'baseUrl' => '/api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'multipart/form-data' => 'yii\web\MultipartFormDataParser'
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
            'loginUrl' => null,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'auth/' => 'user/login',
                '/seller/auth' => 'seller/',
                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => ['user', 'product', 'category', 'worker', 'other-spent'],
                    'pluralize' => false
                ],
            ],
        ],

    ],
    'params' => $params,
];
