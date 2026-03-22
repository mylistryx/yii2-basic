<?php

use yii\faker\FixtureController;

return [
    'id'                  => 'app-console',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'app\console',
    'controllerMap'       => [
        'fixture' => [
            'class' => FixtureController::class,
        ],
    ],
];