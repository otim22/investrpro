<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FinancialYear;
use App\Http\Requests\FinancialYearRequest;
use App\Http\Requests\FinancialYearUpdateRequest;

class FinancialYearController extends Controller
{
    public function index()
    {
        $financialYears = [];
        if(Auth::user()->company) {
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('financial_year.index', compact('financialYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('financial_year.create');
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
            'company_id' => Auth::user()->company->id,
        ]);

        return redirect()->route('financial-year.index')->with("success", $financialYear->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialYear $financialYear)
    {
        return view('financial_year.show', compact('financialYear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialYear $financialYear)
    {
        return view('financial_year.edit', compact('financialYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinancialYearUpdateRequest $request, FinancialYear $financialYear)
    {
        $request->validated();
        $financialYear->update($request->all());
        return redirect()->route('financial-year.index', $financialYear)->with('success', $financialYear->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(FinancialYear $financialYear)
    {
        $financialYear->delete();
        return redirect()->route('financial-year.index')->with('success', 'Financial year deleted successfully');
    }
}

