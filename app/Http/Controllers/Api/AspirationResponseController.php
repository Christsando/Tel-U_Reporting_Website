<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AspirationResponseController extends Controller
{
    public function index($id){
        $aspiration = Aspiration::findOrFail($id);
        return $aspiration->responses;
    }
}
