<?php

namespace App\Http\Controllers;

use App\Models\AuditReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuditReportRequest;
use App\Http\Requests\AuditReportUpdateRequest;

class AuditReportController extends Controller
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
        $auditReports = [];
        if(Auth::user()->company) {
            $auditReports = AuditReport::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('reports.audit.index', compact('auditReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.audit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuditReportRequest $request)
    {
        $request->validated();

        $auditReport = AuditReport::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('report_attachement')) {
            $auditReport->addMedia($request->report_attachement)->toMediaCollection('report_attachement');
        } 

        return redirect()->route('audit-reports.index')->with("success", $auditReport->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(AuditReport $auditReport)
    {
        $auditReportUrl = $auditReport->getFirstMediaUrl('report_attachement');
        return view('reports.audit.show', compact(['auditReport', 'auditReportUrl']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuditReport $auditReport)
    {
        return view('reports.audit.edit', compact('auditReport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuditReportUpdateRequest $request, AuditReport $auditReport)
    {
        $request->validated();
        $auditReport->update($request->except('report_attachement'));
        if($request->hasFile('report_attachement')) {
            $auditReport->clearMediaCollection('report_attachement');
            $auditReport->addMedia($request->report_attachement)->toMediaCollection('report_attachement');
        }
        return redirect()->route('audit-reports.index', $auditReport)->with('success', $auditReport->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(AuditReport $auditReport)
    {
        $auditReport->delete();
        return redirect()->route('audit-reports.index')->with('success', 'Audit report deleted successfully');
    }

    public function download($id)
    {
        $auditReport = AuditReport::findOrFail($id);
        $path = $auditReport->getFirstMedia('report_attachement')->getPath();
        $file_name = $auditReport->getFirstMedia('report_attachement')->file_name;
        return response()->download($path, $file_name);
    }
}
