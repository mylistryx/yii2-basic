<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '127.0.0.1',
    'charset' => 'utf8mb4',
    'enableSchemaCache' => YII_ENV == YII_ENV_PROD,
    'schemaCacheDuration' => 360,
    'schemaCache' => 'cache',
];
