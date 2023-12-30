<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\FinancialMonth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinancialMonthRequest;
use App\Http\Requests\FinancialMonthUpdateRequest;

class FinancialMonthController extends Controller
{
    public function index()
    {
        $financialMonths = [];
        if(Auth::user()) {
            $financialMonths = FinancialMonth::get();
        }
        return view('admin.months.index', compact('financialMonths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.months.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinancialMonthRequest $request)
    {
        $request->validated();
        $financialMonth = FinancialMonth::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('admin.financial-months.index')->with("success", $financialMonth->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialMonth $financialMonth)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.months.show', compact(['financialMonth', 'companies']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialMonth $financialMonth)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.months.edit', compact(['financialMonth', 'companies']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinancialMonthUpdateRequest $request, FinancialMonth $financialMonth)
    {
        $request->validated();
        $financialMonth->update($request->all());
        return redirect()->route('admin.financial-months.index', $financialMonth)->with('success', $financialMonth->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(FinancialMonth $financialMonth)
    {
        $financialMonth->delete();
        return redirect()->route('admin.financial-months.index')->with('success', 'Financial Month deleted successfully');
    }
}
