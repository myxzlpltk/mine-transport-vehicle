<?php

namespace App\Enums;

enum TravelStatus: string {
    case Pending = 'pending';
    case Validated = 'validated';
    case Rejected = 'rejected';

    /**
     * @return string
     */
    public function getValue(): string {
        return $this->value;
    }
}
