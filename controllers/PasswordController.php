<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\RequestPasswordResetForm;
use app\forms\ResetPassword;
use app\models\ChangePasswordForm;
use yii\web\Response;

final class PasswordController extends WebController
{
    public function actionRequest(): Response
    {
        $model = new RequestPasswordResetForm();
        if ($model->load($this->post()) && $model->sendRequest()) {
            return $this->info('Follow email instructions', 'app')->goHome();
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

    public function actionChange(): Response
    {
        $model = new ChangePasswordForm();
        if ($model->load($this->post()) && $model->changePassword()) {
            return $this->info('Password changed', 'app')->goHome();
        }

        return $this->render('change', [
            'model' => $model,
        ]);
    }
}