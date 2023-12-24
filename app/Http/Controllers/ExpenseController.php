<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\FinancialYear;
use Illuminate\Http\Request;
use App\Models\LiabilityType;
use App\Models\FinancialMonth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;
use App\DataTables\ExpensesDataTable;
use App\Http\Requests\ExpenseUpdateRequest;

class ExpenseController extends Controller
{
    public function index(ExpensesDataTable $dataTable)
    {
        $expenses = [];
        if(Auth::user()->company) {
            $expenses = Expense::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return $dataTable->render('expenses.index', compact([
            'expenses' 
        ]));
    }

    public function create()
    {
        $liabilityTypes = [];
        $financialYears = [];
        $months = [];
        if(Auth::user()->company) {
            $liabilityTypes = LiabilityType::where('company_id', Auth::user()->company->id)->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
            $months = FinancialMonth::where('company_id', Auth::user()->company->id)->get();
        }
        return view('expenses.create', compact(['liabilityTypes', 'financialYears', 'months']));
    }

    public function store(ExpenseRequest $request)
    {
        $request->validated();
        $expense = Expense::create([
            'expense_name' => $request->expense_name,
            'expense_type' => $request->expense_type,
            'financial_year' => $request->financial_year,
            'date_of_expense' => $request->date_of_expense,
            'details' => $request->details,
            'rate' => $request->rate,
            'amount' => $request->amount,
            'company_id' => Auth::user()->company->id,
        ]);
        
        return redirect()->route('expenses.index')->with("success", "Expense saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        $liabilityTypes = [];
        if(Auth::user()->company) {
            $liabilityTypes = LiabilityType::where('company_id', Auth::user()->company->id)->get();
        }
        return view('expenses.show', compact(['expense', 'liabilityTypes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $liabilityTypes = [];
        $financialYears = [];
        $months = [];
        if(Auth::user()->company) {
            $liabilityTypes = LiabilityType::where('company_id', Auth::user()->company->id)->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
            $months = FinancialMonth::where('company_id', Auth::user()->company->id)->get();
        }
        return view('expenses.edit', compact(['expense', 'liabilityTypes', 'financialYears', 'months']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseUpdateRequest $request, Expense $expense)
    {
        $request->validated();
        $expense->update($request->all());
        return redirect()->route('expenses.index', $expense)->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully');
    }
}
