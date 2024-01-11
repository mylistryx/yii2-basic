<?php

namespace app\enum;

use app\traits\EnumToArray;

enum IdentityTokenType: int
{
    use EnumToArray;

    case Confirmation = 100;
    case PasswordReset = 200;
    case Auth = 1000;
}