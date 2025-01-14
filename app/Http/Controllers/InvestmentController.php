<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;
use App\Models\FinancialYear;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InvestmentRequest;
use App\Http\Requests\InvestmentUpdateRequest;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = [];
        if(Auth::user()->company) {
            $investments = Investment::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('investments.index', compact('investments'));
    }

    public function create()
    {
        $financialYears = [];
        if(Auth::user()->company) {
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }
        return view('investments.create', compact('financialYears'));
    }

    public function store(InvestmentRequest $request)
    {
        $request->validated();

        $investment = Investment::create([
            'investment_type' => $request->investment_type,
            'date_of_investment' => $request->date_of_investment,
            'duration' => $request->duration,
            'interest_rate' => $request->interest_rate,
            'amount_invested' => $request->amount_invested,
            'financial_year' => $request->financial_year,
            'date_of_maturity' => $request->date_of_maturity,
            'expected_tax' => $request->expected_tax,
            'expected_return_after_tax' => $request->expected_return_after_tax,
            'interest_recieved' => $request->interest_recieved,
            'company_id' => Auth::user()->company->id,
        ]);
 
        return redirect()->route('investments.index')->with("success", "Investment saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Investment $investment)
    {
        return view('investments.show', compact('investment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Investment $investment)
    {
        return view('investments.edit', compact('investment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvestmentUpdateRequest $request, Investment $investment)
    {
        $request->validated();
        $investment->update($request->all());
        return redirect()->route('investments.index', $investment)->with('success', 'Investment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Investment $investment)
    {
        $investment->delete();
        return redirect()->route('investments.index')->with('success', 'Investment deleted successfully');
    }
}
