<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostFoundItem extends Model {
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'image',
        'location',
        'type',
        'status',
        'date_event',  
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

?>