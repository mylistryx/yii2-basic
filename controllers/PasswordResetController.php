<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\RequestPasswordResetForm;
use app\forms\ResetPassword;
use yii\web\Response;

final class PasswordResetController extends WebController
{
    public function actionIndex(): Response
    {
        $model = new RequestPasswordResetForm();
        if ($model->load($this->post()) && $model->sendRequest()) {
            return $this->info('Follow email instructions', 'app')->redirect('reset');
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionReset(string $token): Response
    {
        $model = new ResetPassword($token);
        if ($model->load($this->post()) && $model->resetPassword()) {
            return $this->goHome();
        }

        return $this->render('reset', [
            'model' => $model,
            'token' => $token,
        ]);
    }
}