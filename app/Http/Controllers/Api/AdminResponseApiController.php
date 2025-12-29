<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminResponseApiController extends Controller
{
    public function index(){
        return AdminResponse::with('respondable')->latest()->get();
    }

    public function show($id){
        return AdminResponse::with('respondable')->findOrFail($id);
    }
}
