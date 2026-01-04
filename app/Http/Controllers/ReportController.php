<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();
        return view('report-facilities.index', compact('reports'));
    }

    public function create()
    {
        return view('report-facilities.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'location'    => 'required',
            'date_time'   => 'required|date',
            'image'       => 'image|file|max:10240',
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['status'] = 'PENDING';

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('report-images');
        }

        Report::create($validatedData);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dikirim!');
    }

    public function edit(Report $report)
    {
        return view('report-facilities.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $rules = [
            'title'       => 'required|max:255',
            'description' => 'required',
            'location'    => 'required',
            'date_time'   => 'required|date',
            'image'       => 'image|file|max:10240',
            'status'      => 'required|in:PENDING,PROCESSED,COMPLETED,REJECTED',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($report->image) {
                Storage::delete($report->image);
            }
            $validatedData['image'] = $request->file('image')->store('report-images');
        }

        $report->update($validatedData);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Report $report)
    {
        if ($report->image) {
            Storage::delete($report->image);
        }

        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus!');
    }
}