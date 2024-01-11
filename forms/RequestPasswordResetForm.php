<?php

namespace app\forms;

use app\models\Identity;
use Yii;
use yii\base\Model;

class RequestPasswordResetForm extends Model
{
    public ?string $email = null;

    public function rules(): array
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'exist',
                'targetClass' => Identity::class,
                'targetAttribute' => 'email',
                'message' => Yii::t('app', 'Identity with same email not found'),
            ],
        ];
    }

    public function sendRequest(): bool
    {
    }
}