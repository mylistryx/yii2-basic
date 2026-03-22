<?php

use app\models\Identity;
use yii\helpers\ArrayHelper;
use yii\symfonymailer\Mailer;
use yii\symfonymailer\Message;

$params = ArrayHelper::merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
);

return [
    'id'         => 'app-test',
    'basePath'   => dirname(__DIR__),
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language'   => 'en-US',
    'components' => [
        'mailer'       => [
            'class'            => Mailer::class,
            'viewPath'         => '@app/mail',
            'useFileTransport' => true,
            'messageClass'     => Message::class,
        ],
        'assetManager' => [
            'basePath' => dirname(__DIR__) . '/web/assets',
        ],
        'urlManager'   => [
            'showScriptName' => true,
        ],
        'user'         => [
            'identityClass' => Identity::class,
        ],
        'request'      => [
            'cookieValidationKey'  => 'test',
            'enableCsrfValidation' => false,
        ],
    ],
    'params'     => $params,
];
