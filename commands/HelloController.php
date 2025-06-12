<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

class HelloController extends Controller
{

    public function actionIndex(string $message = 'hello world'): int
    {
        $this->stdOut($message . PHP_EOL);

        return ExitCode::OK;
    }
}
