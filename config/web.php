<?php

$date_format = require __DIR__ . '/date_format.php'; // конфиг с форматом даты
$params = require __DIR__ . '/params.php';
//$db = require __DIR__ . '/db.php';
$db = file_exists(__DIR__ . '/db.php')
    ? (require __DIR__ . '/db_local.php')
    : (__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'language' => 'ru_RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'cwdFC8Xaaw1jp3e3H77Mrt1JdCBzbRqz',
        ],
        'activity' => [
            'class' => \app\components\ActivityComponent::class,
            'activity_class' => '\app\models\Activity',
        ],
        'day' => [
            'class' => \app\components\DayComponent::class,
            'day_class' => '\app\models\Day'
        ],
        'calendar' => [
            'class' => \app\components\CalendarComponent::class,
            'calendar_class' => '\app\models\Calendar'
        ],
        'dao' => [
            'class' => \app\components\DaoComponent::class,
        ],
        'auth' => [
            'class' => \app\components\UsersAuthComponent::class,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'rbac' => [
            'class' => \app\components\RbacComponent::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // добавлено правило для разбора url
            'rules' => [
                'activity/edit/<id:\d+>' => 'activity/edit',
            ],
        ],

    ],
//    'params' => $params,
    'params' => array_merge($params, $date_format),
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
}

return $config;
