<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseTypeRequest;
use App\Http\Requests\ExpenseTypeUpdateRequest;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        $expenseTypes = [];
        if(Auth::user()->company) {
            $expenseTypes = ExpenseType::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('expense_types.index', compact('expenseTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseTypeRequest $request)
    {
        $request->validated();

        $expenseType = ExpenseType::create([
            'expense_type' => $request->expense_type,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        return redirect()->route('expense-types.index')->with("success", $expenseType->expense_type . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseType $expenseType)
    {
        return view('expense_types.show', compact('expenseType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseType $expenseType)
    {
        return view('expense_types.edit', compact('expenseType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseTypeUpdateRequest $request, ExpenseType $expenseType)
    {
        $request->validated();
        $expenseType->update($request->all());
        return redirect()->route('expense-types.index', $expenseType)->with('success', $expenseType->expense_type . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(ExpenseType $expenseType)
    {
        $expenseType->delete();
        return redirect()->route('expense-types.index')->with('success', 'Expense type deleted successfully');
    }
}
