<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityReport extends Model
{
    public function responses(){
        return $this->morphMany(AdminResponse::class, 'respondable');
    }
}