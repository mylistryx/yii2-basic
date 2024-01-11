<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\ChangePasswordForm;
use app\forms\RequestPasswordResetForm;
use app\forms\ResetPassword;
use yii\filters\AccessControl;
use yii\web\Response;

final class PasswordController extends WebController
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['change'],
                'rules' => [
                    [
                        'actions' => ['change'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionRequestReset(): Response
    {
        $model = new RequestPasswordResetForm();
        if ($model->load($this->post()) && $model->sendRequest()) {
            return $this->info('Follow email instructions', 'app')->goHome();
        }

        return $this->render('requestReset', [
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