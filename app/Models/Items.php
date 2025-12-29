<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = ['title', 'content', 'image'];
}
