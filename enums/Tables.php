<?php

namespace app\enums;

use app\traits\Enum2Array;

enum Tables: string
{
    use Enum2Array;

    case Identity = 'identity';
    case IdentityToken = 'identity_token';
    case Region = 'region';
}