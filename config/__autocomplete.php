<?php

use app\models\Identity;
use yii\console\Application as ConsoleApplication;
use yii\web\Application as WebApplication;
use yii\web\User as WebUser;

class Yii {
    public static ConsoleApplication|__Application|WebApplication $app;
}

/**
 * @property WebUser|__WebUser $user
 * 
 */
class __Application {
}

/**
 * @property Identity $identity
 */
class __WebUser {
}
