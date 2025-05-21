<?php

namespace App\Enums;

enum ApprovingEnum: string
{
    case Accept = 'ACCEPT';
    case Reject = 'REJECT';
    case Pending = 'PENDING';
}
