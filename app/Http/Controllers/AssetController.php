<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\AssetType;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\FinancialYear;
use App\Models\ChargeSetting;
use App\Models\FinancialMonth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssetRequest;
use App\Http\Requests\AssetUpdateRequest;

class AssetController extends Controller
{
    public function index()
    { 
        $assets = [];
        if(Auth::user()->company) {
            $assets = Asset::where([
                'company_id' => Auth::user()->company->id,
            ])->orderBy('id', 'desc')->get();
        }
        return view('assets.index', compact(['assets']));
    }

    public function create()
    {
        $members = [];
        $months = [];
        $chargeSettings = [];
        $financialYears = [];
        $assetTypes = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $months = FinancialMonth::where('company_id', Auth::user()->company->id)->get();
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->get();
        }
        
        return view('assets.create', compact(['members', 'months', 'assetTypes', 'financialYears', 'chargeSettings']));
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(AssetRequest $request)
    {
        $request->validated();
        $memberSaving = Asset::create([
            'member_id' => $request->member_id,
            'asset' => $request->asset,
            'asset_type' => $request->asset_type,
            'financial_year' => $request->financial_year,
            'amount' => $request->amount,
            'date_paid' => $request->date_paid,
            'has_paid' => $request->has_paid,
            'comment' => $request->comment,
            'company_id' => Auth::user()->company->id,
        ]); 

        return redirect()->route('assets.index')->with("success", $memberSaving->asset . " saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        $members = [];
        $months = [];
        $assetTypes = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $months = FinancialMonth::where('company_id', Auth::user()->company->id)->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->get();
        }
        return view('assets.show', compact(['asset', 'members', 'months', 'assetTypes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        $members = [];
        $months = [];
        $chargeSettings = [];
        $assetTypes = [];
        $financialYears = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $months = FinancialMonth::where('company_id', Auth::user()->company->id)->get();
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }
        return view('assets.edit', compact(['asset', 'members', 'months', 'assetTypes', 'financialYears', 'chargeSettings']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssetUpdateRequest $request, Asset $asset)
    {
        $request->validated();
        $asset->update($request->all());
        return redirect()->route('assets.index', $asset)->with('success', $asset->asset . ' updated successfully.');
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
