<?php

namespace app\forms;

use app\enum\IdentityTokenType;
use app\models\Identity;
use app\models\IdentityToken;
use Yii;
use yii\base\Exception;
use yii\base\Model;

class SignupRequestForm extends Model
{
    public ?string $email = null;
    public ?string $password = null;

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'length' => [Yii::$app->params['identity.password.minLength']]],
            [
                'email',
                'unique',
                'targetClass' => Identity::class,
                'targetAttribute' => 'email',
                'message' => Yii::t('app', 'Email is already takken'),
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
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

        $identity = Identity::create(
            $this->email,
            $this->password
        );

        $identityToken = IdentityToken::create(
            $identity,
            IdentityTokenType::Confirmation,
        );

        return Yii::$app->mailer->compose('signupRequest', ['identityToken' => $identityToken])
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject(Yii::t('app', 'Signup request'))
            ->send();
    }
}