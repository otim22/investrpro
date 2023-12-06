<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\MemberSaving;
use App\Models\LateRemission;
use App\Models\MissedMeeting;
use App\Models\EconomicCalendarYear;
use App\Models\AssetSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssetRequest;
use App\Http\Requests\AssetUpdateRequest;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $assets = [];
        $MemberSavings = [];
        $totalMemberSaving = 0;
        $lateRemissions = [];
        $totalLateRemission = 0;
        $missedMeetings = [];
        $economicCalenders = [];
        $MemberSavingData = [];
        $totalMissedMeeting = 0;

        if(Auth::user()->company) {
            $MemberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $lateRemissions = LateRemission::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $missedMeetings = MissedMeeting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $economicCalenders = EconomicCalendarYear::where('company_id', Auth::user()->company->id)->get()->pluck('title');
            // dd($MemberSavings);
            
            foreach($MemberSavings as $MemberSaving) {
                $totalMemberSaving += $MemberSaving->premium;

                foreach($economicCalenders as $economicCalender) {
                    if($MemberSaving->month == $economicCalender) {
                        // array_push($MemberSavingData, $MemberSaving->premium);
                    }
                }
            }
            foreach($lateRemissions as $lateRemission) {
                $totalLateRemission += $lateRemission->charge_amount;
            }
            foreach($missedMeetings as $missedMeeting) {
                $totalMissedMeeting += $missedMeeting->charge_amount;
            }

            $assets = Asset::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $totalByTypes = Asset::where('company_id', Auth::user()->company->id)->get()->groupBy('asset_type')
                ->map(function ($option) {
                    return $option
                            ->reduce(function($carry, $item) {
                                return $carry += $item->amount;
                            });
                });
        }

        $overrallTotal = $totalMemberSaving + $totalLateRemission + $totalMissedMeeting;

        // dd($totalLateRemission, $totalMissedMeeting);

        return view('assets.asset.index', compact([
            'assets', 
            'totalMemberSaving', 
            'totalLateRemission', 
            'totalMissedMeeting',
            'overrallTotal',
            'totalByTypes',
        ]));
    }

    public function create()
    {
        $assetTypes = [];
        if(Auth::user()->company) {
            $assetTypes = AssetSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('assets.asset.create', compact('assetTypes'));
    }

    public function store(AssetRequest $request)
    {
        $request->validated();

        $asset = Asset::create([
            'asset_name' => $request->asset_name,
            'asset_type' => $request->asset_type,
            'amount' => $request->amount,
            'financial_year' => $request->financial_year,
            'date_acquired' => $request->date_acquired,
            'company_id' => Auth::user()->company->id,
        ]);
 
        return redirect()->route('assets.index')->with("success", $asset->asset_type . " saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        $assetTypes = [];
        if(Auth::user()->company) {
            $assetTypes = AssetSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('assets.asset.show', compact(['asset', 'assetTypes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        $assetTypes = [];
        if(Auth::user()->company) {
            $assetTypes = AssetSetting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('assets.asset.edit', compact(['asset', 'assetTypes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssetUpdateRequest $request, Asset $asset)
    {
        $request->validated();
        $asset->update($request->all());
        return redirect()->route('assets.index', $asset)->with('success', $asset->asset_type . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully');
    }
}
