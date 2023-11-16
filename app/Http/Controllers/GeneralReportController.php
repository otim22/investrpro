<?php

namespace App\Http\Controllers;

use App\Models\GeneralReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GeneralReportRequest;
use App\Http\Requests\GeneralReportUpdateRequest;

class GeneralReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $generalReports = [];
        if(Auth::user()->company) {
            $generalReports = GeneralReport::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('reports.general.index', compact('generalReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.general.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GeneralReportRequest $request)
    {
        $request->validated();

        $generalReport = GeneralReport::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('report_attachement')) {
            $generalReport->addMedia($request->report_attachement)->toMediaCollection('report_attachement');
        } 

        return redirect()->route('general-reports.index')->with("success", $generalReport->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralReport $generalReport)
    {
        return view('reports.general.show', compact('generalReport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralReport $generalReport)
    {
        return view('reports.general.edit', compact('generalReport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GeneralReportUpdateRequest $request, GeneralReport $generalReport)
    {
        $request->validated();
        $generalReport->update($request->except('report_attachement'));
        if($request->hasFile('report_attachement')) {
            foreach ($generalReport->media as $media) {
                $media->delete();
            }
            $generalReport->addMedia($request->report_attachement)->toMediaCollection('report_attachement');
        }
        return redirect()->route('general-reports.index', $generalReport)->with('success', $generalReport->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(GeneralReport $generalReport)
    {
        $generalReport->delete();
        return redirect()->route('general-reports.index')->with('success', 'General report deleted successfully');
    }
}
