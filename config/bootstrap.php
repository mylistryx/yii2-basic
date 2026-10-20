<?php

use yii\mail\MailerInterface;
use yii\symfonymailer\Mailer;

$container = Yii::$container;

$container->setSingleton(MailerInterface::class, [
    'class' => Mailer::class,
    'useFileTransport' => true,
    'viewPath' => '@app/mail',
]);
