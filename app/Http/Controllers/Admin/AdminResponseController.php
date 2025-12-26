<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminResponse;

class AdminResponseController extends Controller
{
    public function index()
    {
        $responses = AdminResponse::with('respondable', 'admin')
            ->latest()
            ->paginate(10);

        return view('admin.responses.index', compact('responses'));
    }
    
    public function create(Request $request)
    {
        return view('admin.responses.create', [
            'respondable_type' => $request->type,
            'respondable_id'   => $request->id,
        ]);
    }

    public function store(Request $request)
    {
        AdminResponse::create([
            'admin_id'         => auth()->id(),
            'respondable_type' => $request->respondable_type,
            'respondable_id'   => $request->respondable_id,
            'message'          => $request->message,
            'action_status'    => $request->action_status,
        ]);

        return redirect()->route('responses.index');
    }

    public function edit(AdminResponse $response)
    {
        return view('admin.responses.edit', compact('response'));
    }

    public function update(Request $request, AdminResponse $response)
    {
        $response->update($request->all());
        return redirect()->route('responses.index');
    }

    public function show(AdminResponse $response)
    {
        return view('admin.responses.show', compact('response'));
    }
}