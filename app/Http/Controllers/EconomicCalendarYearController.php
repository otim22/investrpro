<?php

namespace App\Http\Controllers;

use App\Models\EconomicCalendarYear;
use Illuminate\Http\Request;

class EconomicCalendarYearController extends Controller
{
    public function index()
    {
        $cconomicCalendarYear = EconomicCalendarYear::all();
        return view('cconomic_calendar_year.index', compact(['cconomicCalendarYear']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cconomic_calendar_year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EconomicCalendarYearRequest $request)
    {
        $request->validated();
        $economicCalendarYear = EconomicCalendarYear::create($request->all());
 
        return redirect()->route('cconomic_calendar_year.index')->with("success", $economicCalendarYear->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(EconomicCalendarYear $economicCalendarYear)
    {
        return view('cconomic_calendar_year.show', compact(['economicCalendarYear']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EconomicCalendarYear $economicCalendarYear)
    {
        return view('cconomic_calendar_year.edit', compact(['economicCalendarYear']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EconomicCalendarYear $economicCalendarYear)
    {
        $data = $this->validateData($request);
        $economicCalendarYear->update($data);
        return redirect()->route('cconomic_calendar_year.show', [$economicCalendarYear])->with('success', $economicCalendarYear->title . ' updated successfully.');
    }

    public function validateData($request) 
    {
        return $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'director_register' => 'nullable|array',
            'shareholder_register' => 'nullable|array',
        ]);
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(EconomicCalendarYear $economicCalendarYear)
    {
        $economicCalendarYear->delete();
        return redirect()->route('cconomic_calendar_year.index')->with('success', 'EconomicCalendarYear deleted successfully');
    }
}
