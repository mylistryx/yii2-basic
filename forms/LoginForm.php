<?php

declare(strict_types=1);

namespace app\forms;

use app\components\forms\Form;
use app\models\Identity;
use Yii;
use yii\base\Security;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read Identity|null $user
 */
class LoginForm extends Form
{
    public string $email = '';
    public string $password = '';
    public bool $rememberMe = true;
    private Identity|null $_identity = null;
    private bool $_identityLoaded = false;

    public function __construct(
        private readonly Security $security, $config = [])
    {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword(string $attribute, array|null $params): void
    {
        if (!$this->hasErrors()) {
            $identity = $this->getIdentity();

            if (!$identity || !$this->security->validatePassword($this->password, $identity->passwordHash)) {
                $this->addError($attribute, 'Incorrect credentials');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getIdentity(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Identity|null
     */
    public function getIdentity(): Identity|null
    {
        if (!$this->_identityLoaded) {
            $this->_identity = Identity::findByUsername($this->username);
            $this->_identityLoaded = true;
        }

        return $this->_identity;
    }
}
