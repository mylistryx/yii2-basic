<?php

namespace app\forms;

use Yii;
use yii\base\Model;

class ResetPassword extends Model
{
    public ?string $password = null;
    public ?string $passwordRepeat = null;

    public function rules(): array
    {
        return [
            [['password', 'passwordRepeat'], 'required'],
            [
                'password',
                'string',
                'length' => [
                    Yii::$app->params['identity.password.MinLength'],
                    Yii::$app->params['identity.password.MaxLength'],
                ],
            ],
            ['password', 'compare', 'compareAttribute' => 'passwordRepeat'],
        ];
    }

    public function resetPassword(): bool
    {
        if ($this->validate()) {
            $identity = Yii::$app->user->identity;
            $identity->password = $this->password;
            return $identity->save();
        }

        return false;
    }
}