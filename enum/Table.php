<?php

namespace app\enum;

use app\traits\EnumToArray;

enum Table: string
{
    use EnumToArray;

    case Identity = '{{%identity}}';
    case IdentityToken = '{{%identity_token}}';

}