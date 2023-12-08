<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\AssetType;
use App\Models\MissedMeeting;
use App\Models\ChargeSetting;
use App\Models\FinancialYear;
use Illuminate\Http\Request;
use App\Models\EconomicCalendarYear;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MissedMeetingRequest;
use App\Http\Requests\MissedMeetingUpdateRequest;

class MissedMeetingController extends Controller
{
    public function index()
    {   
        $missedMeetings = [];
        if(Auth::user()->company) {
            $missedMeetings = MissedMeeting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('missed_meetings.index', compact('missedMeetings'));
    }

    public function create()
    {
        $members = [];
        $chargeSettings = [];
        $months = [];
        $assetTypes = [];
        $financialYears = [];

        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->get();
            $months = EconomicCalendarYear::where('company_id', Auth::user()->company->id)->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }

        return view('missed_meetings.create', compact(['members', 'chargeSettings', 'months', 'assetTypes', 'financialYears']));
    }

    public function store(MissedMeetingRequest $request)
    {
        $request->validated();

        $missedMeeting = MissedMeeting::create([ 
            'asset_type' => $request->asset_type,
            'financial_year' => $request->financial_year,
            'charge_paid_for' => $request->charge_paid_for,
            'charge_amount' => $request->charge_amount,
            'month_paid_for' => $request->month_paid_for,
            'date_of_payment' => $request->date_of_payment,
            'comment' => $request->comment,
            'member_id' => $request->member_id,
            'company_id' => Auth::user()->company->id,
        ]);
 
        return redirect()->route('missed-meetings.index')->with("success", "Missed meeting saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(MissedMeeting $missedMeeting)
    {
        $members = [];
        $assetTypes = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('missed_meetings.show', compact(['missedMeeting', 'members', 'assetTypes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MissedMeeting $missedMeeting)
    {
        $members = [];
        $chargeSettings = [];
        $months = [];
        $assetTypes = [];
        $financialYears = [];

        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->get();
            $months = EconomicCalendarYear::where('company_id', Auth::user()->company->id)->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }
        
        return view('missed_meetings.edit', compact(['missedMeeting', 'members', 'chargeSettings', 'months', 'assetTypes', 'financialYears']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MissedMeetingUpdateRequest $request, MissedMeeting $missedMeeting)
    {
        $request->validated();
        $missedMeeting->update($request->all());
        return redirect()->route('missed-meetings.index', $missedMeeting)->with('success', 'Missed meeting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(MissedMeeting $missedMeeting)
    {
        $missedMeeting->delete();
        return redirect()->route('missed-meetings.index')->with('success', 'Missed meeting deleted successfully');
    }
}
