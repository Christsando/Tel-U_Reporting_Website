<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminResponse extends Model
{
    protected $guarded = [];
    
    protected $fillable = [
        'admin_id',
        'respondable_type',
        'respondable_id',
        'message',
        'action_status',
    ];

    public function respondable()
    {
        return $this->morphTo();
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
