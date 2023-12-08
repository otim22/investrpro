<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Member;
use App\Models\Expense;
use App\Models\Investment;
use App\Models\ChargeSetting;
use App\Models\MemberSaving;
use App\Models\LateRemission;
use App\Models\MissedMeeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $memberSavings = [];
        $lateRemissions = [];
        $missedMeetings = [];
        $investments = [];
        $chargeSettings = [];
        $totalMemberSaving = 0;
        $totalLateRemission = 0;
        $totalMissedMeeting = 0;
        $totalInvestments = 0;
        $overallAssetTotal = 0;
        $overallTotalMembers = 0;

        if(Auth::user()->company) {
            $memberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->get();
            $lateRemissions = LateRemission::where('company_id', Auth::user()->company->id)->get();
            $missedMeetings = MissedMeeting::where('company_id', Auth::user()->company->id)->get();
            $overallLiabilityTotal = Expense::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $totalInvestments = Investment::where('company_id', Auth::user()->company->id)->count();
            $overallTotalMembers = Member::where('company_id', Auth::user()->company->id)->count();
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->get();

            foreach($memberSavings as $memberSaving) {
                $totalMemberSaving += $memberSaving->premium;
            }
            foreach($lateRemissions as $lateRemission) {
                $totalLateRemission += $lateRemission->charge_amount;
            }
            foreach($missedMeetings as $missedMeeting) {
                $totalMissedMeeting += $missedMeeting->charge_amount;
            }

            $overallAssetTotal = $totalMemberSaving + $totalLateRemission + $totalMissedMeeting;
        }
        
        return view('home', compact([
            'totalMemberSaving', 
            'totalLateRemission', 
            'totalMissedMeeting',
            'totalInvestments',
            'overallTotalMembers',
            'overallAssetTotal',
            'overallLiabilityTotal',
        ]));
    } 
}
