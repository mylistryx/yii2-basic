<?php

namespace app\enums;

use app\components\traits\EnumToArrayTrait;

enum Tables: string
{
    use EnumToArrayTrait;

    case Region = 'region';

    case Identity = 'identity';
    case IdentityToken = 'identity_token';
}
