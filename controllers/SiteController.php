<?php

declare(strict_types=1);

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\ContactForm;
use Yii;
use yii\captcha\CaptchaAction;
use yii\mail\MailerInterface;
use yii\web\ErrorAction;
use yii\web\Response;

class SiteController extends WebController
{
    public function __construct(
        $id,
        $module,
        private readonly MailerInterface $mailer,
        $config = [],
    )
    {
        parent::__construct($id, $module, $config);
    }

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

    public function actionContact(): Response
    {
        $model = new ContactForm();

        $contact = $model->load($this->request->post()) && $model->contact(
                $this->mailer,
                Yii::$app->params['adminEmail'],
                Yii::$app->params['senderEmail'],
                Yii::$app->params['senderName'],
            );

        if ($contact) {
            Yii::$app->session->setFlash(
                'success',
                'Thank you for contacting us. We will respond to you as soon as possible.',
            );

            return $this->refresh();
        }

        return $this->render('contact', ['model' => $model]);
    }

    public function actionAbout(): Response
    {
        return $this->render('about');
    }
}
