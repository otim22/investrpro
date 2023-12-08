<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FinancialMonth;
use App\Http\Requests\FinancialMonthRequest;
use App\Http\Requests\FinancialMonthUpdateRequest;

class FinancialMonthController extends Controller
{
    public function index()
    {
        $financialMonths = [];
        if(Auth::user()->company) {
            $financialMonths = FinancialMonth::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('economic_calendar.months.index', compact('financialMonths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('economic_calendar.months.create');
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
            'company_id' => Auth::user()->company->id,
        ]);

        return redirect()->route('financial-months.index')->with("success", $financialMonth->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialMonth $financialMonth)
    {
        return view('economic_calendar.months.show', compact('financialMonth'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialMonth $financialMonth)
    {
        return view('economic_calendar.months.edit', compact('financialMonth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinancialMonthUpdateRequest $request, FinancialMonth $financialMonth)
    {
        $request->validated();
        $financialMonth->update($request->all());
        return redirect()->route('financial-months.index', $financialMonth)->with('success', $financialMonth->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(FinancialMonth $financialMonth)
    {
        $financialMonth->delete();
        return redirect()->route('financial-months.index')->with('success', 'Financial Month deleted successfully');
    }
}
