<?php

declare(strict_types=1);

namespace app\controllers;

use app\components\controllers\WebController;
use yii\captcha\CaptchaAction;
use yii\web\ErrorAction;
use yii\web\Response;

final class SiteController extends WebController
{
    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'transparent' => true,
            ],
        ];
    }

    public function actionIndex(): Response
    {
        return $this->render('index');
    }

    public function actionAbout(): Response
    {
        return $this->render('about');
    }
}
