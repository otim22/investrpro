<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipFee;
use Illuminate\Http\Request;
use App\Models\EconomicCalendarYear;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MembershipFeeRequest;
use App\Http\Requests\MembershipFeeUpdateRequest;

class MembershipFeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $membershipFees = [];
        if(Auth::user()->company) {
            $membershipFees = MembershipFee::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('membership_fee.index', compact('membershipFees'));
    }

    public function create()
    {
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('membership_fee.create', compact(['members']));
    }

    public function store(MembershipFeeRequest $request)
    {
        $request->validated();

        $membershipFee = MemberSaving::create([
            'fee_amount' => $request->fee_amount,
            'year_paid_for' => $request->year_paid_for,
            'date_of_payment' => $request->date_of_payment,
            'comment' => $request->comment,
            'member_id' => $request->member_id,
            'company_id' => Auth::user()->company->id,
        ]);
 
        return redirect()->route('membership-fees.index')->with("success", "Membership fee saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(MembershipFee $membershipFee)
    {
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('membership_fee.show', compact(['membershipFee', 'members']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembershipFee $membershipFee)
    {
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('membership_fee.edit', compact(['membershipFee', 'members']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MembershipFeeUpdateRequest $request, MembershipFee $membershipFee)
    {
        $request->validated();
        $membershipFee->update($request->all());
        return redirect()->route('membership-fees.index', $membershipFee)->with('success', 'Membership fee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(MembershipFee $membershipFee)
    {
        $membershipFee->delete();
        return redirect()->route('membership-fees.index')->with('success', 'Membership fee deleted successfully');
    }
}
