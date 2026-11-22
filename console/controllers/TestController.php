<?php
declare(strict_types=1);

namespace app\console\controllers;

use app\models\Identity;
use yii\console\Controller;

final class TestController extends Controller
{
    public function actionIndex()
    {
        $model = Identity::findIdentity(101);
        dd($model);
        return $model;
    }
}
