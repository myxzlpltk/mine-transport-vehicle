<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    public static array $types = ['truck', 'tractor', 'trailer', 'other'];

    public function travels(): HasMany {
        return $this->hasMany(Travel::class);
    }
}
