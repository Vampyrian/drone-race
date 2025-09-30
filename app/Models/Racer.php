<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Racer extends Model
{
    protected $fillable = ['name', 'nickname', 'email', 'age', 'flight_license', 'license_plate', 'race_id',];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }
}
