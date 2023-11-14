<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;
use App\Http\Requests\ExpenseUpdateRequest;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $expenses = [];
        if(Auth::user()->company) {
            $expenses = Expense::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(ExpenseRequest $request)
    {
        $request->validated();
        $expense = new Expense;
        $expense->date_of_expense = $request->date_of_expense;
        $expense->details = $request->details;
        $expense->rate = $request->rate;
        $expense->amount = $request->amount;
        $expense->designate = $request->designate;
        $expense->company_id = Auth::user()->company->id;
        $expense->save();

        return redirect()->route('expenses.index')->with("success", "Expense saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
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
