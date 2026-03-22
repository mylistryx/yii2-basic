<?php

use yii\caching\FileCache;
use yii\db\Connection;
use yii\symfonymailer\Mailer;

return [
    'components' => [
        'db' => [
            'class' => Connection::class,
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii2db',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
        ],
        'mailer' => [
            'class' => Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
    ],
];
