<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\LateRemission;
use App\Models\ChargeSetting;
use Illuminate\Http\Request;
use App\Models\EconomicCalendarYear;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LateRemissionRequest;
use App\Http\Requests\LateRemissionUpdateRequest;

class LateRemissionController extends Controller
{
    public function index()
    {   
        $lateRemissions = LateRemission::all();
        return view('charges.late_remissions.index', compact('lateRemissions'));
    }

    public function create()
    {
        $members = [];
        $chargeSettings = [];
        $months = [];

        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $months = EconomicCalendarYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }

        return view('charges.late_remissions.create', compact(['members', 'chargeSettings', 'months']));
    }

    public function store(LateRemissionRequest $request)
    {
        $request->validated();

        $lateRemission = LateRemission::create([
            'charge_paid_for' => $request->charge_paid_for,
            'charge_amount' => $request->charge_amount,
            'month_paid_for' => $request->month_paid_for,
            'date_of_payment' => $request->date_of_payment,
            'comment' => $request->comment,
            'member_id' => $request->member_id,
            'company_id' => Auth::user()->company->id,
        ]);
 
        return redirect()->route('late-remissions.index')->with("success", "Late remission saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(LateRemission $lateRemission)
    {
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('charges.late_remissions.show', compact(['lateRemission', 'members']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LateRemission $lateRemission)
    {
        $members = [];
        $chargeSettings = [];
        $months = [];

        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $months = EconomicCalendarYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        
        return view('charges.late_remissions.edit', compact(['lateRemission', 'members', 'chargeSettings', 'months']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LateRemissionUpdateRequest $request, LateRemission $lateRemission)
    {
        $request->validated();
        $lateRemission->update($request->all());
        return redirect()->route('late-remissions.index', $lateRemission)->with('success', 'Late Remission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(LateRemission $lateRemission)
    {
        $lateRemission->delete();
        return redirect()->route('late-remissions.index')->with('success', 'Late Remission deleted successfully');
    }
}
