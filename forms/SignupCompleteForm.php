<?php

namespace app\forms;

use Yii;
use yii\base\Model;

class SignupCompleteForm extends Model
{
    public ?string $confirmationToken = null;

    public function rules(): array
    {
        return [
            ['confirmationToken', 'required'],
            ['confirmationToken', 'validateConfirmationToken'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'confirmationToken' => Yii::t('app', 'Confirmation token'),
        ];
    }

    public function validateConfirmationToken(string $attribute): void
    {

    }
}