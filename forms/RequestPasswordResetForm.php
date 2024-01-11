<?php

namespace app\forms;

use app\enum\IdentityTokenType;
use app\models\Identity;
use app\models\IdentityToken;
use Yii;
use yii\base\Exception;
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

    /**
     * @throws Exception
     */
    public function sendRequest(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $identity = Identity::findByEmail($this->email);
        $identityToken = IdentityToken::create($identity, IdentityTokenType::PasswordReset);

        return Yii::$app->mailer->compose('passwordResetRequest', ['identityToken' => $identityToken])
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject(Yii::t('app', 'Password reset request'))
            ->send();
    }
}