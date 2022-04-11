<?php

namespace App\Enums;

enum TravelStatus: string {
    case Pending = 'pending';
    case Validated = 'validated';
    case Rejected = 'rejected';
}
