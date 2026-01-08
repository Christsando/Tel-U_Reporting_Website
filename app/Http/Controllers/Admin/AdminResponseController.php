<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Report;
use App\Models\Aspiration;
use App\Models\LostFoundItem;
use App\Models\AdminResponse;

class AdminResponseController extends Controller
{
    public function index(Request $request)
    {
        $reports = Report::with('user')->latest()->get()->map(function ($item) {
            $item->source_type = 'report';
            $item->display_title = 'Laporan Fasilitas';
            $item->display_content = $item->description ?? $item->content;
            $item->display_user = $item->user->name ?? 'User Hapus';
            $item->display_email = $item->user->email ?? '-';
            return $item;
        });

        $aspirations = Aspiration::with('user')->latest()->get()->map(function ($item) {
            $item->source_type = 'aspiration';
            $item->display_title = '[' . $item->topic . '] ' . $item->title;
            $item->display_content = $item->content;
            
            if ($item->is_anonymous) {
                $item->display_user = 'Disembunyikan (Anonim)';
                $item->display_email = '-';
            } else {
                $item->display_user = $item->user->name ?? 'User Hapus';
                $item->display_email = $item->user->email ?? '-';
            }
            return $item;
        });

        $lostFounds = LostFoundItem::with('user')->latest()->get()->map(function ($item) {
            $item->source_type = 'lost_found';
            $typeLabel = ucfirst($item->type);
            $item->display_title = "[$typeLabel] " . $item->title;
            $item->display_content = $item->description;
            $item->display_user = $item->user->name ?? 'User Hapus';
            $item->display_email = $item->user->email ?? '-';
            return $item;
        });

        $mergedData = $reports->concat($aspirations)->concat($lostFounds)->sortByDesc('created_at');

        $page = $request->input('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $paginatedItems = new LengthAwarePaginator(
            $mergedData->slice($offset, $perPage)->values(),
            $mergedData->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.responses.index', ['data' => $paginatedItems]);
    }

    public function show(Request $request, $id)
    {
        $type = $request->query('type', 'report');

        if ($type == 'aspiration') {
            $data = Aspiration::with('user')->findOrFail($id);
            $data->source_type = 'aspiration';
        } elseif ($type == 'lost_found') {
            $data = LostFoundItem::with('user')->findOrFail($id);
            $data->source_type = 'lost_found';
        } else {
            $data = Report::with('user')->findOrFail($id);
            $data->source_type = 'report';
        }

        return view('admin.responses.show', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $type = $request->query('type', 'report');

        $request->validate([
            'status' => 'required',
            'response' => 'nullable|string',
        ]);

        if ($type == 'aspiration') {
            $item = Aspiration::findOrFail($id);
            if ($request->filled('response')) {
                $item->admin_response = $request->response;
            }
        } elseif ($type == 'lost_found') {
            $item = LostFoundItem::findOrFail($id);
        } else {
            $item = Report::findOrFail($id);
        }

        $item->status = $request->status;
        $item->save();

        if ($type != 'aspiration' && $request->filled('response')) {
             if (class_exists(AdminResponse::class)) {
                 AdminResponse::create([
                     'respondable_id' => $item->id,
                     'respondable_type' => get_class($item),
                     'message' => $request->response,
                     'action_status' => $request->status,
                 ]);
             }
        }

        return redirect()->route('responses.index')->with('success', 'Status berhasil diperbarui!');
    }
}
