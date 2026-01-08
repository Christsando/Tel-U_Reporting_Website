<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;

class DashboardController extends Controller
{
    public function index()
    {
        $carousels = Carousel::where('status', true)->get();

        return view('dashboard', compact('carousels'));
    }
}
