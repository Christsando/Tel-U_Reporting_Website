<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'topic',
        'is_anonymous',
        'status',
        'admin_response',
    ];

    // relasi ke admin response 
    public function responses()
    {
        return $this->morphMany(AdminResponse::class, 'respondable');
    }

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
