<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\SignupRequestForm;
use yii\web\Response;

final class SignupController extends WebController
{
    public function behaviors(): array
    {
        return [];
    }

    public function actionIndex(): Response
    {
        $model = new SignupRequestForm();

        if ($model->load($this->post()) && $model->sendRequest()) {
            return $this->success('Follow email instructions', 'app')->redirect('confirm');
        }

        return $this->render('signupRequest', [
            'model' => $model,
        ]);
    }

    public function actionConfirm(): Response
    {

    }
}