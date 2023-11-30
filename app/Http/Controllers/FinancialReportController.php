<?php

namespace App\Http\Controllers;

use App\Models\FinancialReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FinancialReportRequest;
use App\Http\Requests\FinancialReportUpdateRequest;

class FinancialReportController extends Controller
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
        $financialReports = [];
        if(Auth::user()->company) {
            $financialReports = FinancialReport::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('reports.financial.index', compact('financialReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.financial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinancialReportRequest $request)
    {
        $request->validated();

        $financialReport = FinancialReport::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('report_attachement')) {
            $financialReport->addMedia($request->report_attachement)->toMediaCollection('report_attachement');
        } 

        return redirect()->route('financial-reports.index')->with("success", $financialReport->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialReport $financialReport)
    {
        $financialReportUrl = $financialReport->getFirstMediaUrl('report_attachement');
        return view('reports.financial.show', compact(['financialReport', 'financialReportUrl']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialReport $financialReport)
    {
        return view('reports.financial.edit', compact('financialReport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinancialReportUpdateRequest $request, FinancialReport $financialReport)
    {
        $request->validated();
        $financialReport->update($request->except('report_attachement'));
        if($request->hasFile('report_attachement')) {
            $financialReport->clearMediaCollection('report_attachement');
            $financialReport->addMedia($request->report_attachement)->toMediaCollection('report_attachement');
        }
        return redirect()->route('financial-reports.index', $financialReport)->with('success', $financialReport->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(FinancialReport $financialReport)
    {
        $financialReport->delete();
        return redirect()->route('financial-reports.index')->with('success', 'Financial report deleted successfully');
    }

    public function download($id)
    {
        $financialReport = FinancialReport::findOrFail($id);
        $path = $financialReport->getFirstMedia('report_attachement')->getPath();
        $file_name = $financialReport->getFirstMedia('report_attachement')->file_name;
        return response()->download($path, $file_name);
    }
}
