<?php

namespace app\enum;

use app\traits\EnumToArray;

enum IdentityStatus: int
{
    use EnumToArray;

    case Unconfirmed = 10;
    case Active = 100;
    case Banned = -1;
}