<?php

$params = require __DIR__ . '/params.php';
//$db = require __DIR__ . '/db.php';
$db = file_exists(__DIR__ . '/db.php')
    ? (require __DIR__ . '/db_local.php')
    : (__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    // добавили 'queue' для очередей
    'bootstrap' => ['log', \app\config\PreConfig::class, 'queue'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'container' => [
        'singletons' => [
            'app\components\notification\NotificationInterface' =>
                ['class' => 'app\components\notification\NotificationService'],
            'app\components\activity\ActivityInterface' => [
                'class' => 'app\components\activity\ActivityService'
            ],
        ],
        'definitions' => [
            'ActivityEntity' => [
                'class' => 'app\models\Activity',
            ],
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
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'auth' => [
            'class' => \app\components\UsersAuthComponent::class,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
//        'activity' => [
//            'class' => \app\components\ActivityComponent::class,
//            'activity_class' => '\app\models\Activity',
//        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false, // если true, отправленные письма сохраняются в runtime/mail
            'enableSwiftMailerLogging' => true,
//            'viewPath' => // можно переопределить папку с вьюхами
            'messageConfig' => [
                'charset' => 'UTF-8',
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.ru',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'dmitry_mailer@mail.ru',
                'password' => '789qwe456asd',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
        ],
        'formatter' => [
            'class' => '\yii\i18n\Formatter',
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:d.m.Y H:i',
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
