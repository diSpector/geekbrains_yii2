<?php

return [
    'class' => 'yii\db\Connection',
//    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'dsn' => 'mysql:host=localhost;dbname=dispector',
    'username' => 'root',
//    'password' => '',
    'password' => 'vagrant',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 500,
    'schemaCache' => 'cache',
];
