<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\SignupCompleteForm;
use app\forms\SignupRequestForm;
use Throwable;
use Yii;
use yii\base\Exception;
use yii\db\StaleObjectException;
use yii\web\Response;

final class SignupController extends WebController
{
    /**
     * @throws Exception
     */
    public function actionRequest(): Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupRequestForm();

        if ($model->load($this->post()) && $model->sendRequest()) {
            return $this->success('Follow email instructions', 'app')->goHome();
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }

    /**
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionConfirm(string $token): Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupCompleteForm($token);
        if ($model->verifyEmail()) {
            $this->success('Email confirmed', 'app');
        }
        return $this->goHome();
    }
}