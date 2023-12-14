<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\MemberSaving;
use App\Models\LateRemission;
use App\Models\MissedMeeting;
use App\Models\FinancialMonth;
use App\Models\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $memberSavings = [];
        $lateRemissions = [];
        $missedMeetings = [];
        $months = [];
        $years = [];
        $totalMemberSaving = 0;
        $totalLateRemission = 0;
        $totalMissedMeeting = 0;
        $overallTotal = 0;
        $expLateRems = 0;
        $availLateRems = 0;

        if(Auth::user()->company) {
            $memberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $lateRemissions = LateRemission::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $missedMeetings = MissedMeeting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();

            $months = FinancialMonth::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            
            foreach($lateRemissions as $lateRemission) {
                $totalLateRemission += $lateRemission->charge_amount;
            }

            foreach($memberSavings as $memberSaving) {
                $totalMemberSaving += $memberSaving->premium;
            }
         
            foreach($missedMeetings as $missedMeeting) {
                $totalMissedMeeting += $missedMeeting->charge_amount;
            }
        }

        $overallTotal = $totalMemberSaving + $totalLateRemission + $totalMissedMeeting;

        return view('assets.asset.index', compact([
            'totalMemberSaving', 
            'totalLateRemission', 
            'totalMissedMeeting',
            'overallTotal',
            'months',
            'expLateRems',
            'availLateRems',
        ]));
    }

    public function filterData(Request $request)
    {
        $testSample = "";
        $testSample = $request->filter;
        return response()->json($testSample);
    }
}
