<?php

namespace app\forms;

use app\models\Identity;
use Yii;
use yii\base\Model;

/**
 * @property-read Identity|null $user
 */
class LoginForm extends Model
{
    public ?string $username = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    private false|Identity|null $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword(string $attribute, ?array $params = []): void
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
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? Yii::$app->params['app.rememberMeTime'] : 0);
        }
        return false;
    }

    public function getUser(): ?Identity
    {
        if ($this->_user === false) {
            $this->_user = Identity::findByEmail($this->email);
        }

        return $this->_user;
    }
}
