<?php

/**
 * @var View $this
 * @var ChangePasswordForm $model
 */

use app\forms\ChangePasswordForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Password change');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="password-change col-4">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <?php
    $form = ActiveForm::begin();
    ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'newPassword')->passwordInput() ?>
    <?= $form->field($model, 'newPasswordRepeat')->passwordInput() ?>
    <?= Html::submitButton(Yii::t('app', 'Change password'), ['class' => ['btn', 'btn-success']]) ?>
    <?php
    ActiveForm::end();
    ?>
</div>
