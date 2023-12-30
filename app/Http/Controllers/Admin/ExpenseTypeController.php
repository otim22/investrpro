<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseTypeRequest;
use App\Http\Requests\ExpenseTypeUpdateRequest;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        $expenseTypes = [];
        if(Auth::user()) {
            $expenseTypes = ExpenseType::orderBy('id', 'desc')->get();
        }
        return view('admin.expense_types.index', compact('expenseTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.expense_types.create', compact('companies'));
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
            'company_id' => $request->company_id,
        ]); 
        return redirect()->route('expense-types.index')->with("success", $expenseType->expense_type . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseType $expenseType)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.expense_types.show', compact(['expenseType', 'companies']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseType $expenseType)
    {
        $companies = Company::orderBy('id', 'desc')->get();
        return view('admin.expense_types.edit', compact(['expenseType', 'companies']));
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
