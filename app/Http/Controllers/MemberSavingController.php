<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\AssetType;
use Illuminate\Http\Request;
use App\Models\MemberSaving;
use App\Models\FinancialYear;
use App\Models\ChargeSetting;
use App\Models\FinancialMonth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberSavingsRequest;
use App\Http\Requests\MemberSavingsUpdateRequest;

class MemberSavingController extends Controller
{
    public function index()
    {
        $memberSavings = [];
        if(Auth::user()->company) {
            $memberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('member_savings.index', compact(['memberSavings']));
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
        // dd($financialYears);
        return view('member_savings.create', compact(['members', 'months', 'assetTypes', 'financialYears', 'chargeSettings']));
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberSavingsRequest $request)
    {
        $request->validated();

        $memberSaving = MemberSaving::create([
            'asset_name' => $request->asset_name,
            'asset_type' => $request->asset_type,
            'financial_year' => $request->financial_year,
            'premium' => $request->premium,
            'month' => $request->month,
            'date_paid' => $request->date_paid,
            'member_id' => $request->member_id,
            'comment' => $request->comment,
            'company_id' => Auth::user()->company->id,
        ]); 

        return redirect()->route('member-savings.index')->with("success", "Premium saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberSaving $memberSaving)
    {
        $members = [];
        $months = [];
        $assetTypes = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $months = FinancialMonth::where('company_id', Auth::user()->company->id)->get();
            $assetTypes = AssetType::where('company_id', Auth::user()->company->id)->get();
        }
        return view('member_savings.show', compact(['memberSaving', 'members', 'months', 'assetTypes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberSaving $memberSaving)
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
        return view('member_savings.edit', compact(['memberSaving', 'members', 'months', 'assetTypes', 'financialYears', 'chargeSettings']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberSavingsUpdateRequest $request, MemberSaving $memberSaving)
    {
        $request->validated();
        $memberSaving->update($request->all());
        return redirect()->route('member-savings.index', $memberSaving)->with('success', 'Premium updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(MemberSaving $memberSaving)
    {
        $memberSaving->delete();
        return redirect()->route('member-savings.index')->with('success', 'Member Savings deleted successfully');
    }
}
