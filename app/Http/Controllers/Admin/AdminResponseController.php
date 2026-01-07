<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminResponse;
use App\Models\Aspiration;
use App\Models\Report;

class AdminResponseController extends Controller
{
    public function index()
    {
        $reports = Report::select(
            'id',
            'title',
            'description as message',
            'status',
            'created_at'
        )->get()->map(function ($item) {
            $item->source = 'report';
            return $item;
        });

        $aspirations = Aspiration::select(
            'id',
            'title',
            'content as message',
            'status',
            'created_at'
        )->get()->map(function ($item) {
            $item->source = 'aspiration';
            return $item;
        });

        $items = collect()
            ->concat($reports)
            ->concat($aspirations);

        return view('admin.responses.index', compact('items'));
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
        $request->validate([
            'type'   => 'required|in:report,aspiration',
            'id'     => 'required|integer',
            'status' => 'required|in:PENDING,ACCEPTED,ONPROGRESS,DONE,REJECTED',
            'message' => 'required|string',
        ]);

        // tentukan data mana yang direspon
        if ($request->type === 'report') {
            $item = Report::findOrFail($request->id);
        } else {
            $item = Aspiration::findOrFail($request->id);
        }

        // update status di tabel ASLI (penting)
        $item->update([
            'status' => $request->status
        ]);

        AdminResponse::updateOrCreate(
            [
                'respondable_type' => get_class($item),
                'respondable_id'   => $item->id,
            ],
            [
                'admin_id'      => auth()->id(),
                'message'       => $request->message,
                'action_status' => $request->status,
            ]
        );


        return redirect()
            ->route('responses.index')
            ->with('success', 'Respon admin berhasil disimpan');
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

    public function show($recognize)
    {
        [$type, $id] = explode('-', $recognize);

        if ($type === 'report') {
            $item = Report::findOrFail($id);
        } else {
            $item = Aspiration::findOrFail($id);
        }

        return view('admin.responses.show', compact('item', 'type'));
    }
}
