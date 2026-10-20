<?php

use yii\db\Connection as DbConnection;
use yii\mail\MailerInterface;
use yii\queue\redis\Queue;
use yii\redis\Connection as RedisConnection;

return [
    'components' => [
        'db'     => [
            'class'    => DbConnection::class,
            'dsn'      => 'mysql:host=127.0.0.1;dbname=yii2db',
            'username' => 'root',
            'password' => '',
            'charset'  => 'utf8mb4',
        ],
        'mailer' => [
            'class'            => MailerInterface::class,
            'viewPath'         => '@app/mail',
            'useFileTransport' => true,
        ],
        'redis'  => [
            'class'    => RedisConnection::class,
            'port'     => 6379,
            'database' => 0,
        ],
        'queue'  => [
            'class'   => Queue::class,
            'channel' => 'default',
        ],
    ],
];
