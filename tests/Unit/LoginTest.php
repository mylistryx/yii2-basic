<?php

declare(strict_types=1);

namespace app\tests\Unit;

use app\controllers\AuthController;
use app\models\Identity;
use Codeception\Test\Unit;
use Yii;
use yii\base\Security;
use yii\web\View;

final class LoginTest extends Unit
{
    public function testRenderLoginWrongUsername(): void
    {
        $controller = new AuthController(
            'auth',
            Yii::$app,
            new Security(),
        );

        $view = new View(['context' => $controller]);

        Yii::$app->user->login(new Identity());

        $controller->actionLogin();

        self::assertStringNotContainsString(
            'Logout (admin)',
            $view->render('//layouts/main.php', ['content' => 'Hello World°']),
            'Failed asserting that the logout link is not rendered for a wrong username.',
        );
    }
}
