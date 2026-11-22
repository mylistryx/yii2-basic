<?php

use yii\helpers\ArrayHelper;

require __DIR__ . '/bootstrap.php';

return ArrayHelper::merge(
    require __DIR__ . '/main.php',
    require __DIR__ . '/main-local.php',
    require __DIR__ . '/test.php',
    require __DIR__ . '/test-local.php',
    [
        'components' => [
            'request' => [
                'cookieValidationKey'  => 'test',
                'enableCsrfValidation' => false,
            ],
        ],
    ],
);
