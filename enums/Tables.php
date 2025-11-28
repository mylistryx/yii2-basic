<?php

namespace app\enums;

use app\traits\EnumToArrayTrait;

enum Tables: string
{
    use EnumToArrayTrait;

    case Identity = 'identity';
    case IdentityToken = 'identity_token';
    case Region = 'region';
}