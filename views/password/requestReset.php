<?php
/**
 * @var View $this
 * @var ActiveForm $form
 * @var RequestPasswordResetForm $model
 */

use app\forms\RequestPasswordResetForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup-request">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to reset password:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php
            $form = ActiveForm::begin([
                'id' => 'signup-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Send reset password link', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php
            ActiveForm::end();
            ?>

        </div>
    </div>
</div>
