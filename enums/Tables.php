<?php

namespace app\enums;

use app\components\traits\EnumToArrayTrait;

enum Tables: string
{
    use EnumToArrayTrait;

    case Region = 'region';

    case Identity = 'identity';
    case IdentityToken = 'identity_token';
    case AuthLog = 'auth_log';
    case ActionLog = 'action_log';
    case Tracker = 'tracker';
    case TrackerCategory = 'tracker_category';
    case TrackerPage = 'tracker_page';
}
