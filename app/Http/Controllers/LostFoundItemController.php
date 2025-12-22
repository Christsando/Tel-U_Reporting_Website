<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LostFoundItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LostFoundItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = LostFoundItem::with('user')->latest()->paginate(5);
        return view('frontend.lost-found.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.lost-found.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'description' => 'required|string|min:10',
            'location'    => 'required|string|max:150',
            'type'        => 'required|in:LOST,FOUND',
            'status'      => 'required|in:OPEN,CLAIMED,RESOLVED',
            'date_event'  => 'required|date',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request -> file('image')-> store('lost-found-images', 'public');
            $validated['image'] = $path ;

            //$iagePath = $request->file('image')->store('items', 'public');
            //$itemsData['image'] = $imagePath;
        }

        $validated['user_id']=Auth::id();
        LostFoundItem::create($validated);
        return redirect()->route('lost-found.index') -> with('success', 'Laporan berhasil dibuat !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = LostFoundItem::findOrFail($id);
        return view('frontend.lost-found.show', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lostFoundItem = LostFoundItem::findOrFail($id);
        if ($lostFoundItem->user_id !== Auth::id()){
            
        }
        return view('frontend.lost-found.edit', compact('lostFoundItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        /*if ($lostFoundItem->user_id !== Auth::id()&& Auth::user()->role !== 'admin') {
            abort(403);
        }*/
        $lostFoundItem = LostFoundItem::findOrFail($id);
        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'description' => 'required|string|min:10',
            'location'    => 'required|string|max:150',
            'type'        => 'required|in:LOST,FOUND',
            'status'      => 'required|in:OPEN,CLAIMED,RESOLVED',
            'date_event'  => 'required|date',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($lostFoundItem-> image){
                Storage::disk('public')-> delete($lostFoundItem-> image);
            }
            $path = $request -> file('image')-> store('lost-found-images', 'public');
            $validated['image'] = $path ;
        }

        //$lostFoundItem->update($validated);
        $lostFoundItem->title       = $validated['title'];
        $lostFoundItem->description = $validated['description'];
        $lostFoundItem->location    = $validated['location'];
        $lostFoundItem->type        = $validated['type'];
        $lostFoundItem->status      = $validated['status'];
        $lostFoundItem->date_event  = $validated['date_event'];

        if (isset($validated['image'])) {
            $lostFoundItem->image = $validated['image'];
        }

        $lostFoundItem->save();

        return redirect()->route('lost-found.index')
            ->with('success', 'Data Lost & Found berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LostFoundItem $lostFoundItem)
    {

        /* if ($lostFoundItem->user_id !== Auth::id()&& Auth::user()->role !== 'admin') {
            abort(403);
        }*/
        if ($lostFoundItem-> image){
            Storage::disk('public')-> delete($lostFoundItem-> image);
        }
        $lostFoundItem-> delete();
        return redirect()->route('lost-found.index')
            ->with('success', 'Data Lost & Found berhasil dihapus');
    }
    

    public function apiIndex(){
        $items = LostFoundItem::with('user:id, name')->get();
        return response()-> json([
            'status' => 'success',
            'message'=> 'data berhasil didapatkan',
            'data'   => $items 
        ],200);
    }
}
