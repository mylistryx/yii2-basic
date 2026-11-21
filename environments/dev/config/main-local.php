<?php

use yii\db\Connection as DbConnection;
use yii\mail\MailerInterface;
use yii\queue\file\Queue;

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
        'queue'  => [
            'class'   => Queue::class,
            'channel' => 'default',
        ],
    ],
];
