<?php

$config = [
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            'login' => '/user/default/login',
            'logout' => '/user/default/logout',
            'register' => '/user/default/register',
        ],
    ],
    'errorHandler' => [
        'errorAction' => '/site/error',
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
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'user' => [
        'enableAutoLogin' => true,
        'identityClass' => 'app\models\User',
        'loginUrl' => ['/login'],
    ],
    'authManager' => [
        'class' => 'yii\rbac\DbManager',
        'defaultRoles' => ['guest'],
    ],
    'formatter' => [
        'dateFormat' => 'php:Y-m-d',
        'datetimeFormat' => 'php:Y-m-d H:i:s',
    ],
    'assetManager' => [
        'bundles' => [
            'app\assets\HighlightAsset' => [
                'css' => ['styles/solarized-light.css'],
            ],
        ]
    ],
    'i18n' => [
        'translations' => [
            'rbac-admin' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@mdm/admin/messages',
                'sourceLanguage' => 'en-US',
            ],
        ],
    ],
];

return $config;
