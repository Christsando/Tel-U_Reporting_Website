<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.image_carousel.index', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')->store('carousel', 'public');

        Carousel::create([
            'title'  => $request->title,
            'image'  => $path,
            'status' => $request->has('status'), // boolean aman
        ]);

        return redirect()->route('carousel.index')
            ->with('success', 'Carousel berhasil ditambahkan');
    }

    public function update(Request $request, Carousel $carousel)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image',
            'status' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('carousel', 'public');
        }

        $data['status'] = $request->has('status');

        $carousel->update($data);

        return back()->with('success', 'Carousel berhasil diupdate');
    }

    public function destroy(Carousel $carousel)
    {
        $carousel->delete();
        return back()->with('success', 'Carousel berhasil dihapus');
    }



    public function toggleStatus(Carousel $carousel)
    {
        $carousel->update([
            'status' => ! $carousel->status
        ]);

        return back();
    }
}
