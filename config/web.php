<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Аптечная сеть',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'cVu8yIubVdzZBJt7qpnZdsGvA9Rjv8lu',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => 'buisness-online', 'httpOnly' => true],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info', 'trace'],
                    'logFile' => '@runtime/logs/app.log',
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'signup' => 'user/signup',
                'register' => 'user/register',
                'search' => 'search/search',
                'about' => 'site/about',
                'create' => 'opros/create',
                'profile' => 'profile/view',
                'update' => 'profile/update',
                'contact' => 'contact/contact',
                'admin' => 'admin/view',
                'export' => 'export-opros',
                'cart/add' => 'cart/add',
                'cart/remove' => 'cart/remove',
                'cart/update' => 'cart/update',
                'cart/view' => 'cart/view',
                'cart/count' => 'cart/count',
            ],
        ],
        'session' => [
            'class' => 'yii\web\Session',
            // 'cookieParams' => ['domain' => '.example.com'], // Если используете поддомены
            'useCookies' => true, // Использовать куки для хранения ID сессии
            'name' => 'PHPSESSID', // Имя куки
            'cookieParams' => [
                'httpOnly' => true, // Запретить доступ к куки из JavaScript
            ],
            'timeout' => 86400, // Срок жизни сессии в секундах (24 часа)
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
