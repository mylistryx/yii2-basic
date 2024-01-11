<?php

namespace app\forms;

use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    public ?string $password = null;
    public ?string $newPassword = null;
    public ?string $newPasswordRepeat = null;

    public function rules(): array
    {
        return [
            [['password', 'newPassword', 'newPasswordRepeat'], 'required'],
            ['password', 'validatePassword'],
            [
                'newPassword',
                'string',
                'length' => [
                    Yii::$app->params['identity.passwordMinLength'],
                    Yii::$app->params['identity.passwordMaxLength'],
                ],
            ],
            ['newPassword', 'compare', 'compareAttribute' => 'newPasswordRepeat'],
        ];
    }

    public function validatePassword(string $attribute): void
    {
        if (!$this->hasErrors()) {
            $identity = Yii::$app->user->identity;

            if (!$identity || !$identity->validatePassword($this->$attribute)) {
                $this->addError($attribute, Yii::t('app', 'Invalid current password'));
            }
        }
    }

    public function attributeLabels(): array
    {
        return [
            'password' => Yii::t('app', 'Password'),
            'newPassword' => Yii::t('app', 'New password'),
            'newPasswordRepeat' => Yii::t('app', 'New password repeat'),
        ];
    }

    public function changePassword(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $identity = Yii::$app->user->identity;
        $identity->password = $this->newPassword;
        return $identity->save();
    }
}