<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Charge;
use App\Models\AssetType;
use Illuminate\Http\Request;
use App\Models\FinancialYear;
use App\Models\ChargeSetting;
use App\Models\FinancialMonth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChargeRequest;
use App\Http\Requests\ChargeUpdateRequest;

class ChargeController extends Controller
{
    public function index()
    {   
        $charges = [];
        if(Auth::user()->company) {
            $charges = Charge::where([
                'company_id' => Auth::user()->company->id
            ])->orderBy('id', 'desc')->get();
        }
        return view('charges.index', compact('charges'));
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
            $months = FinancialMonth::where('company_id', Auth::user()->company->id)->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }

        return view('charges.create', compact(['members', 'chargeSettings', 'months', 'assetTypes', 'financialYears']));
    }

    public function store(ChargeRequest $request)
    {
        $request->validated();
        // dd($request);
        $charge = Charge::create([
            'asset_type' => $request->asset_type,
            'financial_year' => $request->financial_year,
            'charge' => $request->charge,
            'amount' => $request->amount,
            'month' => $request->month,
            'has_paid' => $request->has_paid,
            'date_paid' => $request->date_paid,
            'comment' => $request->comment,
            'member_id' => $request->member_id,
            'company_id' => Auth::user()->company->id,
        ]);
 
        return redirect()->route('charges.index')->with("success", $charge->charge . " saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Charge $charge)
    {
        $members = [];
        $assetTypes = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->get();
        }
        return view('charges.show', compact(['charge', 'members', 'assetTypes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Charge $charge)
    {
        $members = [];
        $chargeSettings = [];
        $months = [];
        $assetTypes = [];
        $financialYears = [];

        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->get();
            $months = FinancialMonth::where('company_id', Auth::user()->company->id)->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }
        
        return view('charges.edit', compact(['charge', 'members', 'chargeSettings', 'months', 'assetTypes', 'financialYears']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChargeUpdateRequest $request, Charge $charge)
    {
        $request->validated();
        $charge->update($request->all());
        return redirect()->route('charges.index', $charge)->with('success', $charge->charge . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Charge $charge)
    {
        $charge->delete();
        return redirect()->route('charges.index')->with('success', 'Charge deleted successfully');
    }
}
