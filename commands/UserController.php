<?php

namespace app\commands;

use app\enums\IdentityStatus;
use app\models\Identity;
use Yii;
use yii\base\Exception;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\BaseConsole;
use yii\helpers\Console;

class UserController extends Controller
{
    /**
     * @throws Exception
     */
    public function actionCreate(): int
    {
        $identity = new Identity([
            'email' => Console::input('Email: '),
            'password' => Console::input('Password: '),
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);

        $status = Console::input('Status (A)ctive, (I)nactive, (D)eleted: ');
        $identity->current_status = match ($status) {
            'A', 'a' => IdentityStatus::Active->value,
            'I', 'i' => IdentityStatus::Inactive->value,
            'D', 'd' => IdentityStatus::Deleted->value,
        };

        if (!$identity->save()) {
            $this->stderr(PHP_EOL . 'Validation error!' . PHP_EOL);
            $this->stderr(Console::errorSummary($identity), BaseConsole::BG_RED);
        } else {
            $this->stdout(PHP_EOL . 'User created! ID: ' . $identity->id . PHP_EOL);
        }

        return ExitCode::OK;
    }
}
