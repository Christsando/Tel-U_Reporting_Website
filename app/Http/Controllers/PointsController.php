<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Points;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PointsController extends Controller
{
    public function index()
    {
        $point_items_exchange = Points::where('status', true)->get();
        return view("frontend.point-shop.index", compact('point_items_exchange'));
    }

    public function exchange(Request $request, Points $point)
    {
        $user = auth()->user();

        if ($point->quantity <= 0) {
            return back()->with('error', 'Stok item habis');
        }

        if ($user->points < $point->points) {
            return back()->with('error', 'Point kamu tidak mencukupi');
        }

        DB::transaction(function () use ($user, $point) {
            $point->decrement('quantity', 1);
            $user->decrement('points', $point->points);
        });

        // Random voucher code
        $voucherCode = strtoupper(Str::random(10));

        return back()->with([
            'success' => 'Berhasil menukar item',
            'voucher' => $voucherCode
        ]);
    }
}
