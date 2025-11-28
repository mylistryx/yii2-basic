<?php

namespace app\commands;

use app\enums\IdentityStatus;
use app\enums\IdentityTokenType;
use app\models\Identity;
use app\models\IdentityToken;
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

        $identity->current_status = match (Console::prompt('Status: (A)ctive, (I)nactive, (D)eleted: ', ['default' => 'I'])) {
            'A', 'a' => IdentityStatus::Active->value,
            'I', 'i' => IdentityStatus::Inactive->value,
            'D', 'd' => IdentityStatus::Deleted->value,
        };

        $transaction = Yii::$app->db->beginTransaction();

        if (!$identity->save()) {
            $this->stderr(PHP_EOL . 'Validation error!' . PHP_EOL);
            $this->stderr(Console::errorSummary($identity), BaseConsole::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $identityToken = new IdentityToken();
        $identityToken->setIdentity($identity);
        $identityToken->setType(IdentityTokenType::Auth);
        $identityToken->setValue(Yii::$app->security->generateRandomString());

        if (!$identityToken->save()) {
            $this->stderr(PHP_EOL . 'Validation error!' . PHP_EOL);
            $this->stderr(Console::errorSummary($identityToken), BaseConsole::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $transaction->commit();
        $this->stdout(PHP_EOL . 'User created! ID: ' . $identity->id . PHP_EOL);
        return ExitCode::OK;
    }
}
