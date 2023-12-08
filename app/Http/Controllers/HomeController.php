<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Member;
use App\Models\Liability;
use App\Models\Investment;
use App\Models\MemberSaving;
use App\Models\LateRemission;
use App\Models\MissedMeeting;
use Illuminate\Http\Request;
use App\DataTables\AssetsDataTable;
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
    public function index(AssetsDataTable $dataTable)
    {
        $memberSavings = [];
        $lateRemissions = [];
        $missedMeetings = [];
        $investments = [];
        $totalMemberSaving = 0;
        $totalLateRemission = 0;
        $totalMissedMeeting = 0;
        $totalInvestments = 0;
        $overallAssetTotal = 0;
        $overallTotalMembers = 0;

        if(Auth::user()->company) {
            $memberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $lateRemissions = LateRemission::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $missedMeetings = MissedMeeting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $overallLiabilityTotal = Liability::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item){
                return $carry += $item->amount;
            }, 0);
            $totalInvestments = Investment::where('company_id', Auth::user()->company->id)->count();
            $overallTotalMembers = Member::where('company_id', Auth::user()->company->id)->count();
            
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
        
        return $dataTable->render('home', compact([
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
