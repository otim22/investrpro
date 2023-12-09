<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Member;
use App\Models\Expense;
use App\Models\Investment;
use App\Models\FinancialMonth;
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
        $memberSavings = $lateRemissions = $missedMeetings = $investments = $chargeSettings = $financialMonths = [];
        $totalMemberSaving = $totalLateRemission = $totalMissedMeeting = $totalInvestments = $totalAssets = 0;
        $totalMembers = $monthlyAmount = $lateRemissionAmount = $missedMeetingAmount = $expMonthSavings = 0;
        
        // Savings months
        $janSavings = $febSavings = $marSavings = $aprSavings = $maySavings = $junSavings = 0;
        $julSavings = $augSavings = $septSavings = $octSavings = $novSavings = $decSavings = 0;
        
        // lateRems months
        $janLateRems = $febLateRems = $marLateRems = $aprLateRems = $mayLateRems = $junLateRems = 0;
        $julLateRems = $augLateRems = $septLateRems = $octLateRems = $novLateRems = $decLateRems = 0;
        $expJanLateRems = $expFebLateRems = $expMarLateRems = $expAprLateRems = $expMayLateRems = $expJunLateRems = 0 ;
        $expJulLateRems = $expAugLateRems = $expSeptLateRems = $expOctLateRems = $expNovLateRems = $expDecLateRems = 0;
        
        // missMeeting months
        $janMissMeetingTotal = $febMissMeetingTotal = $marMissMeetingTotal = $aprMissMeetingTotal = $mayMissMeetingTotal = $junMissMeetingTotal = 0;
        $julMissMeetingTotal = $augMissMeetingTotal = $septMissMeetingTotal = $octMissMeetingTotal = $novMissMeetingTotal = $decMissMeetingTotal = 0;
        $expMissedMeetings = 0;
        
        if(Auth::user()->company) {
            $memberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->get();
            $lateRemissions = LateRemission::where('company_id', Auth::user()->company->id)->get();
            $missedMeetings = MissedMeeting::where('company_id', Auth::user()->company->id)->get();
            $totalLiabilities = Expense::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $totalInvestments = Investment::where('company_id', Auth::user()->company->id)->count();
            $totalMembers = Member::where('company_id', Auth::user()->company->id)->count();
            
            $totalLateRemissions = $lateRemissions->count();

            $totalMissedMeetings = $missedMeetings->count();
            $financialMonths = FinancialMonth::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            $chargeSettings = ChargeSetting::where('company_id', Auth::user()->company->id)->get();
            
            // Standard Charges
            foreach($chargeSettings as $chargeSetting) {
                if($chargeSetting->title == 'Monthly savings') {
                    $monthlyAmount = $chargeSetting->amount;
                }
                if($chargeSetting->title == 'Late remission') {
                    $lateRemissionAmount = $chargeSetting->amount;
                }
                if($chargeSetting->title == 'Missed meeting') {
                    $missedMeetingAmount = $chargeSetting->amount;
                }
            }
            
            // memberSavings
            foreach($memberSavings as $memberSaving) {
                // Get total for memberSavings
                $totalMemberSaving += $memberSaving->premium;
                
                // Get monthly total for members
                if ($memberSaving->month == "Jan") {
                    $janSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Feb") {
                    $febSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Mar") {
                    $marSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Apr") {
                    $aprSavings += $memberSaving->premium;
                }if ($memberSaving->month == "May") {
                    $maySavings += $memberSaving->premium;
                }if ($memberSaving->month == "Jun") {
                    $junSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Jul") {
                    $julSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Aug") {
                    $augSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Sept") {
                    $septSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Oct") {
                    $octSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Nov") {
                    $novSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Dec") {
                    $decSavings += $memberSaving->premium;
                }
            }
            
            foreach($lateRemissions as $lateRemission) {
                // Get total for lateRemissions
                $totalLateRemission += $lateRemission->charge_amount;

                // Get monthly late remissions for members
                if ($lateRemission->month_paid_for == "Jan") {
                    $janLateRems += $lateRemission->charge_amount;
                    $expJanLateRems += $janLateRems;
                }if ($lateRemission->month_paid_for == "Feb") {
                    $febLateRems += $lateRemission->charge_amount;
                    $expFebLateRems += $febLateRems;
                }if ($lateRemission->month_paid_for == "Mar") {
                    $marLateRems += $lateRemission->charge_amount;
                    $expMarLateRems += $marLateRems;
                }if ($lateRemission->month_paid_for == "Apr") {
                    $aprLateRems += $lateRemission->charge_amount;
                    $expAprLateRems += $aprLateRems;
                }if ($lateRemission->month_paid_for == "May") {
                    $mayLateRems += $lateRemission->charge_amount;
                    $expMayLateRems += $mayLateRems;
                }if ($lateRemission->month_paid_for == "Jun") {
                    $junLateRems += $lateRemission->charge_amount;
                    $expJunLateRems += $junLateRems;
                }if ($lateRemission->month_paid_for == "Jul") {
                    $julLateRems += $lateRemission->charge_amount;
                    $expJulLateRems += $julLateRems;
                }if ($lateRemission->month_paid_for == "Aug") {
                    $augLateRems += $lateRemission->charge_amount;
                    $expAugLateRems += $augLateRems;
                }if ($lateRemission->month_paid_for == "Sept") {
                    $septLateRems += $lateRemission->charge_amount;
                    $expSeptLateRems += $septLateRems;
                }if ($lateRemission->month_paid_for == "Oct") {
                    $octLateRems += $lateRemission->charge_amount;
                    $expOctLateRems += $octLateRems;
                }if ($lateRemission->month_paid_for == "Nov") {
                    $novLateRems += $lateRemission->charge_amount;
                    $expNovLateRems += $novLateRems;
                }if ($lateRemission->month_paid_for == "Dec") {
                    $decLateRems += $lateRemission->charge_amount;
                    $expDecLateRems += $decLateRems;
                }
            }
            // dd($expOctLateRems);
            // Get total for missedMeetings
            foreach($missedMeetings as $missedMeeting) {
                $totalMissedMeeting += $missedMeeting->charge_amount;
            }

            $totalAssets = $totalMemberSaving + $totalLateRemission + $totalMissedMeeting;
            $expMonthSavings = $totalMembers * $monthlyAmount;
            $expMissedMeetings = $totalMissedMeetings * $missedMeetingAmount;
        }
        
        return view('home', compact([
            'totalMemberSaving', 'totalLateRemission', 'totalMissedMeeting', 'totalInvestments', 'totalMembers', 'totalAssets', 
            'totalLiabilities', 'expMonthSavings', 'financialMonths', 'janSavings', 'febSavings', 'marSavings', 'aprSavings', 
            'maySavings', 'junSavings', 'julSavings', 'augSavings', 'septSavings', 'octSavings', 'novSavings', 'decSavings', 
            'expJanLateRems', 'expFebLateRems', 'expMarLateRems', 'expAprLateRems', 'expMayLateRems', 'expJunLateRems', 'expJulLateRems',
            'expAugLateRems', 'expSeptLateRems', 'expOctLateRems', 'expNovLateRems', 'expDecLateRems', 'expMissedMeetings', 'janLateRems', 
            'febLateRems', 'marLateRems', 'aprLateRems', 'mayLateRems', 'junLateRems', 'julLateRems', 'augLateRems', 'septLateRems', 
            'octLateRems', 'novLateRems', 'decLateRems',
        ]));
    } 
}
