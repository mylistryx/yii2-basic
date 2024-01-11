<?php

namespace app\forms;

use app\enum\IdentityTokenType;
use app\models\IdentityToken;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;

class ResetPassword extends Model
{
    private ?IdentityToken $identityToken;

    public ?string $password = null;
    public ?string $passwordRepeat = null;

    public function __construct(string $token, array $config = [])
    {
        $this->identityToken = IdentityToken::findByToken($token, IdentityTokenType::PasswordReset);
        if (!$this->identityToken || $this->identityToken->isExpired) {
            throw new InvalidArgumentException('Wrong password reset token');
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['password', 'passwordRepeat'], 'required'],
            [
                'password',
                'string',
                'length' => [
                    Yii::$app->params['identity.passwordMinLength'],
                    Yii::$app->params['identity.passwordMaxLength'],
                ],
            ],
            ['password', 'compare', 'compareAttribute' => 'passwordRepeat'],
        ];
    }

    public function resetPassword(): bool
    {
        if ($this->validate()) {
            $identity = $this->identityToken->identity;
            $identity->password = $this->password;
            return $identity->save();
        }

        return false;
    }
}