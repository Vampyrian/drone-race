<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = ['name', 'slug', 'start_at', 'end_at'];

    protected function casts(): array
    {
        return [
            'start_at' => 'timestamp',
            'end_at' => 'timestamp',
        ];
    }
}
