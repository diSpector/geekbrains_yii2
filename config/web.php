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
    // добавили 'queue' для очередей
    'bootstrap' => ['log', 'queue'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'as lgo' => \app\behaviors\LogMyBehavior::class,
    // Dependency Injection - контейнер зависимостей
    'container' => [
        'singletons' => [
            'app\components\notification\NotificationInterface' =>
                ['class' => 'app\components\notification\NotificationService'],
            'app\components\activity\ActivityInterface'=> [
                'class' => 'app\components\activity\ActivityService'
            ],
            'app\components\activity\SearchInterface'=> [
                'class' => 'app\components\activity\ActivitySearchService'
            ],
        ],
        'definitions' => [
            'ActivityEntity' => ['class' => 'app\models\Activity'],
        ],
    ],


    'components' => [
        // очереди - redis
        'redis' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
            // ...

            // retry connecting after connection has timed out
            // yiisoft/yii2-redis >=2.0.7 is required for this.
            'retries' => 1,
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'redis' => 'redis', // Redis connection component or its config
            'channel' => 'notifications', // Queue channel key
        ],
        'formatter' => [
            'class' => '\yii\i18n\Formatter',
            'dateFormat' => 'php:d.m.Y'
        ],
        'request' => [
            'as logme' => \app\behaviors\LogMyBehavior::class,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'cwdFC8Xaaw1jp3e3H77Mrt1JdCBzbRqz',
            // добавили для rest-api
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        // добавили мультиязычность
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'admin' => [
            'class' => \app\components\AdminComponent::class,
        ],
//        'activity' => [
//            'class' => \app\components\ActivityComponent::class,
//            'activity_class' => '\app\models\Activity',
//        ],
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
//            'class' => 'yii\caching\FileCache',
            'class' => 'yii\caching\MemCache', // подключили MemCache
            'useMemcached' => true,
//            'useMemcached' => false,
            'servers' => [
                [
                    'host' => '127.0.0.1',
                    'port' => 11211,
                    'weight' => 100,
                ],
            ],
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
            'useFileTransport' => true, // если true, отправленные письма сохраняются в runtime/mail
            'messageConfig' => [
                'charset' => 'UTF-8',
            ],
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'localhost',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
//                'username' => 'username',
//                'password' => 'password',
//                'port' => '587', // Port 25 is a very common port too
//                'encryption' => 'tls', // It is often used, check your provider or mail server specs
//            ],
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
//            'enableStrictParsing' => true,
            // добавлено правило для разбора url
            'rules' => [
                // добавили для rest-api
                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => 'activity-rest',
                    'pluralize' => false,
                ],
                'activity/edit/<id:\d+>' => 'activity/edit',
                'activity/view/<id:\d+>' => 'activity/view',
                'activity/delete/<id:\d+>' => 'activity/delete',
                'admin/user-edit/<id:\d+>' => 'admin/user-edit',
                'admin/user-delete/<id:\d+>' => 'admin/user-delete',
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
