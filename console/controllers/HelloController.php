<?php

declare(strict_types=1);

namespace app\console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

final class HelloController extends Controller
{
    public function actionIndex(string $message = 'Hello world'): int
    {
        Console::stdout($message . PHP_EOL);
        return ExitCode::OK;
    }
}
