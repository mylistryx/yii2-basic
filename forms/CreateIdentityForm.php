<?php

namespace app\forms;

use app\components\forms\Form;
use app\models\Identity;
use app\models\IdentityToken;

class CreateIdentityForm extends Form
{
    public ?string $email = null;
    public ?string $password = null;

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => Identity::class, 'targetAttribute' => 'email'],
            ['password', 'string', 'length' => [6, 32]],
        ];
    }

    public function sendConfirmationEmail(): false|Identity
    {
        if (!$this->validate()) {
            return false;
        }

        $identity = new Identity([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $identity->save(false);

        return $identity;
    }

    public function createWithoutConfirmation()
    {

    }
}