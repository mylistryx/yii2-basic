<?php

use app\components\user\WebUser;
use yii\caching\FileCache;
use yii\log\FileTarget;

return [
    'language'   => 'ru',
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap'  => ['log'],
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'user'  => [
            'class' => WebUser::class,
        ],
        'log'   => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'vendorPath' => dirname(__DIR__) . '/vendor',
];
