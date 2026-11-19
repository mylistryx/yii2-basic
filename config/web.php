<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
);

return [
    'id'         => 'app-web',
    'basePath'   => dirname(__DIR__),
    'components' => [
        'user'         => [
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => require __DIR__ . '/routes.php',
        ],
    ],
    'params'     => $params,
];
