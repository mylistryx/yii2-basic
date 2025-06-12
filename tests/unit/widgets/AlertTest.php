<?php

namespace tests\unit\widgets;

use app\widgets\Alert;
use Codeception\Test\Unit;
use Yii;

class AlertTest extends Unit
{
    public function testSingleErrorMessage()
    {
        $message = 'This is an error message';

        Yii::$app->session->setFlash('error', $message);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($message);
        verify($renderingResult)->stringContainsString('alert-danger');

        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-warning');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testMultipleErrorMessages()
    {
        $firstMessage = 'This is the first error message';
        $secondMessage = 'This is the second error message';

        Yii::$app->session->setFlash('error', [$firstMessage, $secondMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstMessage);
        verify($renderingResult)->stringContainsString($secondMessage);
        verify($renderingResult)->stringContainsString('alert-danger');

        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-warning');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testSingleDangerMessage()
    {
        $message = 'This is a danger message';

        Yii::$app->session->setFlash('danger', $message);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($message);
        verify($renderingResult)->stringContainsString('alert-danger');

        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-warning');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testMultipleDangerMessages()
    {
        $firstMessage = 'This is the first danger message';
        $secondMessage = 'This is the second danger message';

        Yii::$app->session->setFlash('danger', [$firstMessage, $secondMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstMessage);
        verify($renderingResult)->stringContainsString($secondMessage);
        verify($renderingResult)->stringContainsString('alert-danger');

        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-warning');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testSingleSuccessMessage()
    {
        $message = 'This is a success message';

        Yii::$app->session->setFlash('success', $message);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($message);
        verify($renderingResult)->stringContainsString('alert-success');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-warning');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testMultipleSuccessMessages()
    {
        $firstMessage = 'This is the first danger message';
        $secondMessage = 'This is the second danger message';

        Yii::$app->session->setFlash('success', [$firstMessage, $secondMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstMessage);
        verify($renderingResult)->stringContainsString($secondMessage);
        verify($renderingResult)->stringContainsString('alert-success');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-warning');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testSingleInfoMessage()
    {
        $message = 'This is an info message';

        Yii::$app->session->setFlash('info', $message);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($message);
        verify($renderingResult)->stringContainsString('alert-info');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-warning');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testMultipleInfoMessages()
    {
        $firstMessage = 'This is the first info message';
        $secondMessage = 'This is the second info message';

        Yii::$app->session->setFlash('info', [$firstMessage, $secondMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstMessage);
        verify($renderingResult)->stringContainsString($secondMessage);
        verify($renderingResult)->stringContainsString('alert-info');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-warning');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testSingleWarningMessage()
    {
        $message = 'This is a warning message';

        Yii::$app->session->setFlash('warning', $message);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($message);
        verify($renderingResult)->stringContainsString('alert-warning');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testMultipleWarningMessages()
    {
        $firstMessage = 'This is the first warning message';
        $secondMessage = 'This is the second warning message';

        Yii::$app->session->setFlash('warning', [$firstMessage, $secondMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstMessage);
        verify($renderingResult)->stringContainsString($secondMessage);
        verify($renderingResult)->stringContainsString('alert-warning');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }
    public function testSinglePrimaryMessage()
    {
        $message = 'This is a primary message';

        Yii::$app->session->setFlash('primary', $message);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($message);
        verify($renderingResult)->stringContainsString('alert-primary');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testMultiplePrimaryMessages()
    {
        $firstMessage = 'This is the first primary message';
        $secondMessage = 'This is the second primary message';

        Yii::$app->session->setFlash('primary', [$firstMessage, $secondMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstMessage);
        verify($renderingResult)->stringContainsString($secondMessage);
        verify($renderingResult)->stringContainsString('alert-primary');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }
    public function testSingleSecondaryMessage()
    {
        $message = 'This is a secondary message';

        Yii::$app->session->setFlash('secondary', $message);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($message);
        verify($renderingResult)->stringContainsString('alert-secondary');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testMultipleSecondaryMessages()
    {
        $firstMessage = 'This is the first secondary message';
        $secondMessage = 'This is the second secondary message';

        Yii::$app->session->setFlash('secondary', [$firstMessage, $secondMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstMessage);
        verify($renderingResult)->stringContainsString($secondMessage);
        verify($renderingResult)->stringContainsString('alert-secondary');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-light');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }


    public function testSingleLightMessage()
    {
        $message = 'This is a light message';

        Yii::$app->session->setFlash('light', $message);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($message);
        verify($renderingResult)->stringContainsString('alert-light');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }

    public function testMultipleLightMessages()
    {
        $firstMessage = 'This is the first light message';
        $secondMessage = 'This is the second light message';

        Yii::$app->session->setFlash('light', [$firstMessage, $secondMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstMessage);
        verify($renderingResult)->stringContainsString($secondMessage);
        verify($renderingResult)->stringContainsString('alert-light');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-dark');
    }


    public function testSingleDarkMessage()
    {
        $message = 'This is a dark message';

        Yii::$app->session->setFlash('dark', $message);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($message);
        verify($renderingResult)->stringContainsString('alert-dark');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
    }

    public function testMultipleDarkMessages()
    {
        $firstMessage = 'This is the first dark message';
        $secondMessage = 'This is the second dark message';

        Yii::$app->session->setFlash('dark', [$firstMessage, $secondMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstMessage);
        verify($renderingResult)->stringContainsString($secondMessage);
        verify($renderingResult)->stringContainsString('alert-dark');

        verify($renderingResult)->stringNotContainsString('alert-danger');
        verify($renderingResult)->stringNotContainsString('alert-success');
        verify($renderingResult)->stringNotContainsString('alert-info');
        verify($renderingResult)->stringNotContainsString('alert-primary');
        verify($renderingResult)->stringNotContainsString('alert-secondary');
        verify($renderingResult)->stringNotContainsString('alert-light');
    }

    public function testSingleMixedMessages() {
        $errorMessage = 'This is an error message';
        $dangerMessage = 'This is a danger message';
        $successMessage = 'This is a success message';
        $infoMessage = 'This is a info message';
        $warningMessage = 'This is a warning message';
        $primaryMessage = 'This is a primary message';
        $secondaryMessage = 'This is a secondary message';
        $lightMessage = 'This is a light message';
        $darkMessage = 'This is a dark message';


        Yii::$app->session->setFlash('error', $errorMessage);
        Yii::$app->session->setFlash('danger', $dangerMessage);
        Yii::$app->session->setFlash('success', $successMessage);
        Yii::$app->session->setFlash('info', $infoMessage);
        Yii::$app->session->setFlash('warning', $warningMessage);
        Yii::$app->session->setFlash('primary', $primaryMessage);
        Yii::$app->session->setFlash('secondary', $secondaryMessage);
        Yii::$app->session->setFlash('light', $lightMessage);
        Yii::$app->session->setFlash('dark', $darkMessage);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($errorMessage);
        verify($renderingResult)->stringContainsString($dangerMessage);
        verify($renderingResult)->stringContainsString($successMessage);
        verify($renderingResult)->stringContainsString($infoMessage);
        verify($renderingResult)->stringContainsString($warningMessage);
        verify($renderingResult)->stringContainsString($primaryMessage);
        verify($renderingResult)->stringContainsString($secondaryMessage);
        verify($renderingResult)->stringContainsString($lightMessage);
        verify($renderingResult)->stringContainsString($darkMessage);

        verify($renderingResult)->stringContainsString('alert-danger');
        verify($renderingResult)->stringContainsString('alert-success');
        verify($renderingResult)->stringContainsString('alert-info');
        verify($renderingResult)->stringContainsString('alert-warning');
        verify($renderingResult)->stringContainsString('alert-primary');
        verify($renderingResult)->stringContainsString('alert-secondary');
        verify($renderingResult)->stringContainsString('alert-light');
        verify($renderingResult)->stringContainsString('alert-dark');
    }

    public function testMultipleMixedMessages() {
        $firstErrorMessage = 'This is the first error message';
        $secondErrorMessage = 'This is the second error message';
        $firstDangerMessage = 'This is the first danger message';
        $secondDangerMessage = 'This is the second';
        $firstSuccessMessage = 'This is the first success message';
        $secondSuccessMessage = 'This is the second success message';
        $firstInfoMessage = 'This is the first info message';
        $secondInfoMessage = 'This is the second info message';
        $firstWarningMessage = 'This is the first warning message';
        $secondWarningMessage = 'This is the second warning message';
        $firstPrimaryMessage = 'This is the first primary message';
        $secondPrimaryMessage = 'This is the second primary message';
        $firstSecondaryMessage = 'This is the first secondary message';
        $secondSecondaryMessage = 'This is the second secondary message';
        $firstLightMessage = 'This is the first light message';
        $secondLightMessage = 'This is the second light message';
        $firstDarkMessage = 'This is the first dark message';
        $secondDarkMessage = 'This is the second dark message';

        Yii::$app->session->setFlash('error', [$firstErrorMessage, $secondErrorMessage]);
        Yii::$app->session->setFlash('danger', [$firstDangerMessage, $secondDangerMessage]);
        Yii::$app->session->setFlash('success', [$firstSuccessMessage, $secondSuccessMessage]);
        Yii::$app->session->setFlash('info', [$firstInfoMessage, $secondInfoMessage]);
        Yii::$app->session->setFlash('warning', [$firstWarningMessage, $secondWarningMessage]);
        Yii::$app->session->setFlash('primary', [$firstPrimaryMessage, $secondPrimaryMessage]);
        Yii::$app->session->setFlash('secondary', [$firstSecondaryMessage, $secondSecondaryMessage]);
        Yii::$app->session->setFlash('light', [$firstLightMessage, $secondLightMessage]);
        Yii::$app->session->setFlash('dark', [$firstDarkMessage, $secondDarkMessage]);

        $renderingResult = Alert::widget();

        verify($renderingResult)->stringContainsString($firstErrorMessage);
        verify($renderingResult)->stringContainsString($secondErrorMessage);
        verify($renderingResult)->stringContainsString($firstDangerMessage);
        verify($renderingResult)->stringContainsString($secondDangerMessage);
        verify($renderingResult)->stringContainsString($firstSuccessMessage);
        verify($renderingResult)->stringContainsString($secondSuccessMessage);
        verify($renderingResult)->stringContainsString($firstInfoMessage);
        verify($renderingResult)->stringContainsString($secondInfoMessage);
        verify($renderingResult)->stringContainsString($firstWarningMessage);
        verify($renderingResult)->stringContainsString($secondWarningMessage);
        verify($renderingResult)->stringContainsString($firstPrimaryMessage);
        verify($renderingResult)->stringContainsString($secondPrimaryMessage);
        verify($renderingResult)->stringContainsString($firstSecondaryMessage);
        verify($renderingResult)->stringContainsString($secondSecondaryMessage);
        verify($renderingResult)->stringContainsString($firstLightMessage);
        verify($renderingResult)->stringContainsString($secondLightMessage);
        verify($renderingResult)->stringContainsString($firstDarkMessage);
        verify($renderingResult)->stringContainsString($secondDarkMessage);

        verify($renderingResult)->stringContainsString('alert-danger');
        verify($renderingResult)->stringContainsString('alert-success');
        verify($renderingResult)->stringContainsString('alert-info');
        verify($renderingResult)->stringContainsString('alert-warning');
        verify($renderingResult)->stringContainsString('alert-primary');
        verify($renderingResult)->stringContainsString('alert-secondary');
        verify($renderingResult)->stringContainsString('alert-light');
        verify($renderingResult)->stringContainsString('alert-dark');
    }

    public function testFlashIntegrity()
    {
        $errorMessage = 'This is an error message';
        $unrelatedMessage = 'This is a message that is not related to the alert widget';

        Yii::$app->session->setFlash('error', $errorMessage);
        Yii::$app->session->setFlash('unrelated', $unrelatedMessage);

        Alert::widget();

        // Simulate redirect
        Yii::$app->session->close();
        Yii::$app->session->open();

        verify(Yii::$app->session->getFlash('error'))->empty();
        verify(Yii::$app->session->getFlash('unrelated'))->equals($unrelatedMessage);
    }
}
