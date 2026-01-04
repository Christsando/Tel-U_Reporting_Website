<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use Illuminate\Support\Facades\Auth;

class AspirationController extends Controller
{
    /**
     * Display a listing of aspirations with optional filters.
     */
    public function index(Request $request)
    {
        $query = Aspiration::with('user')->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by topic
        if ($request->filled('topic')) {
            $query->where('topic', $request->topic);
        }

        $aspirations = $query->paginate(10);
        
        return view('frontend.aspirations.index', compact('aspirations'));
    }

    /**
     * Show the form for creating a new aspiration.
     */
    public function create()
    {
        return view('frontend.aspirations.create');
    }

    /**
     * Store a newly created aspiration in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:120',
            'content'      => 'required|string|min:20',
            'topic'        => 'required|string',
            'is_anonymous' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'submitted';
        $validated['is_anonymous'] = $request->has('is_anonymous');

        Aspiration::create($validated);

        return redirect()->route('aspirations.index')->with('success', 'Aspirasi berhasil dikirim!');
    }

    /**
     * Display the specified aspiration.
     */
    public function show($id)
    {
        $aspiration = Aspiration::with('user')->findOrFail($id);
        return view('frontend.aspirations.show', compact('aspiration'));
    }

    /**
     * Show the form for editing the specified aspiration.
     */
    public function edit($id)
    {
        $aspiration = Aspiration::findOrFail($id);

        // Only allow editing if status is 'submitted' and user owns it
        if ($aspiration->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit aspirasi ini.');
        }

        if ($aspiration->status !== 'submitted') {
            return redirect()->route('aspirations.index')
                ->with('error', 'Aspirasi yang sudah direview tidak dapat diedit.');
        }

        return view('frontend.aspirations.edit', compact('aspiration'));
    }

    /**
     * Update the specified aspiration in storage.
     */
    public function update(Request $request, $id)
    {
        $aspiration = Aspiration::findOrFail($id);

        // Only allow updating if status is 'submitted' and user owns it
        if ($aspiration->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit aspirasi ini.');
        }

        if ($aspiration->status !== 'submitted') {
            return redirect()->route('aspirations.index')
                ->with('error', 'Aspirasi yang sudah direview tidak dapat diedit.');
        }

        $validated = $request->validate([
            'title'        => 'required|string|max:120',
            'content'      => 'required|string|min:20',
            'topic'        => 'required|string',
            'is_anonymous' => 'boolean',
        ]);

        $validated['is_anonymous'] = $request->has('is_anonymous');

        $aspiration->update($validated);

        return redirect()->route('aspirations.index')->with('success', 'Aspirasi berhasil diperbarui!');
    }

    /**
     * Remove the specified aspiration from storage.
     */
    public function destroy($id)
    {
        $aspiration = Aspiration::findOrFail($id);

        // Only allow deletion if user owns it
        if ($aspiration->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus aspirasi ini.');
        }

        $aspiration->delete();

        return redirect()->route('aspirations.index')->with('success', 'Aspirasi berhasil dihapus!');
    }

    /**
     * API: Get all aspirations
     */
    public function apiIndex()
    {
        $aspirations = Aspiration::with('user:id,name')->get()->map(function ($aspiration) {
            if ($aspiration->is_anonymous) {
                $aspiration->user = null;
            }
            return $aspiration;
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Data aspirasi berhasil didapatkan',
            'data'    => $aspirations
        ], 200);
    }

    /**
     * API: Get single aspiration
     */
    public function apiShow($id)
    {
        $aspiration = Aspiration::with('user:id,name')->find($id);

        if (!$aspiration) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Aspirasi tidak ditemukan',
            ], 404);
        }

        if ($aspiration->is_anonymous) {
            $aspiration->user = null;
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Data aspirasi berhasil didapatkan',
            'data'    => $aspiration
        ], 200);
    }
}
