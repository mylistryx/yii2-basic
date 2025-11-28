<?php

namespace app\enums;

enum IdentityTokenType: int
{
    case EmailConfirmation = 1;
    case PasswordReset = 2;
    case Auth = 100;
}