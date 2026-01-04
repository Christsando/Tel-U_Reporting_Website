<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table = 'cms_image_carousel';

    protected $fillable = [
        'title',
        'image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
