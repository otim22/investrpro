<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\FinancialYear;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinancialYearRequest;
use App\Http\Requests\FinancialYearUpdateRequest;

class FinancialYearController extends Controller
{
    public function index()
    {
        $financialYears = [];
        if(Auth::user()) {
            $financialYears = FinancialYear::orderBy('id', 'desc')->get();
        }
        return view('admin.years.index', compact('financialYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.years.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinancialYearRequest $request)
    {
        $request->validated();
        $financialYear = FinancialYear::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => $request->company_id,
        ]);
        return redirect()->route('admin.financial-years.index')->with("success", $financialYear->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialYear $financialYear)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.years.show', compact(['financialYear', 'companies']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialYear $financialYear)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.years.edit', compact(['financialYear', 'companies']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinancialYearUpdateRequest $request, FinancialYear $financialYear)
    {
        $request->validated();
        $financialYear->update($request->all());
        return redirect()->route('admin.financial-years.index', $financialYear)->with('success', $financialYear->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(FinancialYear $financialYear)
    {
        $financialYear->delete();
        return redirect()->route('admin.financial-years.index')->with('success', 'Financial year deleted successfully');
    }
}

