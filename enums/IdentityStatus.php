<?php

namespace app\enums;

use app\traits\EnumToArrayTrait;

enum IdentityStatus: int
{
    use EnumToArrayTrait;

    case Deleted = -1;
    case Inactive = 0;
    case Active = 1;
}