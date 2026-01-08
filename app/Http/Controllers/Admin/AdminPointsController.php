<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Points;
use App\Http\Controllers\Controller;

class AdminPointsController extends Controller
{
    public function index()
    {
        $point_items_exchange = Points::all();
        return view("admin.point-shop.index", compact('point_items_exchange'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'points' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        Points::create([
            'item_name' => $request->item_name,
            'points' => $request->points,
            'quantity' => $request->quantity,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('points.index')
            ->with('success', 'Item berhasil ditambahkan');
    }

    public function update(Request $request, Points $point)
    {
        $data = $request->validate([
            'item_name' => 'required|string|max:255',
            'points' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');
        $point->update($data);

        return back()->with('success', 'Item Point berhasil diupdate');
    }

    public function destroy(Points $point)
    {
        $point->delete();
        return back()->with('success', 'Item Point berhasil dihapus');
    }

    public function toggleStatus(Points $points)
    {
        $points->update(['status' => ! $points->status]);
        return back();
    }

    public function apiIndex()
    {
        $items = Points::select(
            'id',
            'item_name',
            'points',
            'quantity',
            'status',
            'created_at'
        )->get();

        return response()->json([
            'success' => true,
            'data' => $items
        ]);
    }
}
