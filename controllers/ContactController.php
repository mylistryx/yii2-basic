<?php

namespace app\controllers;

use app\forms\ContactForm;
use Yii;
use yii\mail\MailerInterface;
use yii\web\Controller;
use yii\web\Response;

class ContactController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly MailerInterface $mailer,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): string|Response
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

        return $this->render('index', [
            'model' => $model
        ]);
    }
}
