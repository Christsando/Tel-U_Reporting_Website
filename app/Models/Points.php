<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    protected $table = 'points_exchange';

    protected $fillable = [
        'item_name',
        'points',
        'quantity',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}
