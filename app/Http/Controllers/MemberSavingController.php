<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberSaving;
use Illuminate\Http\Request;
use App\Models\EconomicCalendarYear;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberSavingsRequest;
use App\Http\Requests\MemberSavingsUpdateRequest;

class MemberSavingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $memberSavings = [];
        if(Auth::user()->company) {
            $memberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('member_savings.index', compact('memberSavings'));
    }

    public function create()
    {
        $members = [];
        $months = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $months = EconomicCalendarYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('member_savings.create', compact(['members', 'months']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberSavingsRequest $request)
    {
        $request->validated();
        $memberSaving = new MemberSaving();
        $memberSaving->premium = $request->premium;
        $memberSaving->month = $request->month;
        $memberSaving->date_paid = $request->date_paid;
        $memberSaving->member_id = $request->member_id;
        $memberSaving->comment = $request->comment;
        $memberSaving->company_id = Auth::user()->company->id;
        $memberSaving->save();

        return redirect()->route('member-savings.index')->with("success", "Premium saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberSaving $memberSaving)
    {
        $members = [];
        $months = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $months = EconomicCalendarYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('member_savings.show', compact(['memberSaving', 'members', 'months']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberSaving $memberSaving)
    {
        $members = [];
        $months = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $months = EconomicCalendarYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('member_savings.edit', compact(['memberSaving', 'members', 'months']));
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
