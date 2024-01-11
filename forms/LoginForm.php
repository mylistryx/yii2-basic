<?php

namespace app\forms;

use app\models\Identity;
use Yii;
use yii\base\Model;

/**
 * @property-read null|Identity $user
 */
class LoginForm extends Model
{
    public ?string $email = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? Yii::$app->params['identity.rememberMe'] : 0);
        }
        return false;
    }

    public function getUser(): ?Identity
    {
        static $user = false;
        if ($user === false) {
            $user = Identity::findOne(['email' => $this->email]);
        }

        return $user;
    }
}
