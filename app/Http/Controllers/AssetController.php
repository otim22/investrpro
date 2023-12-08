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
        $memberSavings = [];
        $lateRemissions = [];
        $missedMeetings = [];
        $totalMemberSaving = 0;
        $totalLateRemission = 0;
        $totalMissedMeeting = 0;
        $overallTotal = 0;

        if(Auth::user()->company) {
            $memberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $lateRemissions = LateRemission::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $missedMeetings = MissedMeeting::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();

            foreach($memberSavings as $memberSaving) {
                $totalMemberSaving += $memberSaving->premium;
            }

            foreach($lateRemissions as $lateRemission) {
                $totalLateRemission += $lateRemission->charge_amount;
            }

            foreach($missedMeetings as $missedMeeting) {
                $totalMissedMeeting += $missedMeeting->charge_amount;
            }

            // $totalByTypes = Asset::where('company_id', Auth::user()->company->id)->get()->groupBy('asset_type')
            //     ->map(function ($option) {
            //         return $option
            //                 ->reduce(function($carry, $item) {
            //                     return $carry += $item->amount;
            //                 });
            //     });
        }

        $overallTotal = $totalMemberSaving + $totalLateRemission + $totalMissedMeeting;

        return view('assets.asset.index', compact([
            'totalMemberSaving', 
            'totalLateRemission', 
            'totalMissedMeeting',
            'overallTotal',
        ]));
    }
}
