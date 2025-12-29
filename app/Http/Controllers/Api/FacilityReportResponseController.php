<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FacilityReport;

class FacilityReportResponseController extends Controller
{
    public function index($id){
        $report = FacilityReport::findOrFail($id);
        return $report->responses;
    }
}
