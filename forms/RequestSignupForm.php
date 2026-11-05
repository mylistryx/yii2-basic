<?php

namespace app\models;

use app\components\forms\Form;

class RequestSignupForm extends Form
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [];
    }
}
