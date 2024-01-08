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
    public ?string $username = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
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
            $user = Identity::findByUsername($this->username);
        }

        return $user;
    }
}
