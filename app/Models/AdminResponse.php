<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminResponse extends Model
{
    public function respondable(){
        return $this->morphTo();
    }
}
