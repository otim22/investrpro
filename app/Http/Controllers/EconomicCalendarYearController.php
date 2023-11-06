<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EconomicCalendarYear;
use App\Http\Requests\EconomicCalendarYearRequest;
use App\Http\Requests\EconomicCalendarYearUpdateRequest;

class EconomicCalendarYearController extends Controller
{
    public function index()
    {
        $economicCalendarMonths = EconomicCalendarYear::all();
        return view('economic_calendar_year.index', compact('economicCalendarMonths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('economic_calendar_year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EconomicCalendarYearRequest $request)
    {
        $request->validated();
        $economicCalendarYear = new EconomicCalendarYear();
        $economicCalendarYear->title = $request->title;
        $economicCalendarYear->description = $request->description;
        $economicCalendarYear->company_id = Auth::user()->company->id;
        $economicCalendarYear->save();

        return redirect()->route('economic-calendar-year.index')->with("success", $economicCalendarYear->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(EconomicCalendarYear $economicCalendarYear)
    {
        return view('economic_calendar_year.show', compact('economicCalendarYear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EconomicCalendarYear $economicCalendarYear)
    {
        return view('economic_calendar_year.edit', compact('economicCalendarYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EconomicCalendarYearUpdateRequest $request, EconomicCalendarYear $economicCalendarYear)
    {
        $request->validated();
        $economicCalendarYear->update($request->all());
        return redirect()->route('economic-calendar-year.index', $economicCalendarYear)->with('success', $economicCalendarYear->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(EconomicCalendarYear $economicCalendarYear)
    {
        $economicCalendarYear->delete();
        return redirect()->route('economic-calendar-year.index')->with('success', 'EconomicCalendarYear deleted successfully');
    }
}
