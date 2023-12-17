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
        $janMissMeetings = $febMissMeetings = $marMissMeetings = $aprMissMeetings = $mayMissMeetings = $junMissMeetings = 0;
        $julMissMeetings = $augMissMeetings = $septMissMeetings = $octMissMeetings = $novMissMeetings = $decMissMeetings = $expMissedMeetings = 0;
        $expJanMissMeetings = $expFebMissMeetings = $expMarMissMeetings = $expAprMissMeetings = $expMayMissMeetings = $expJunMissMeetings = 0 ;
        $expJulMissMeetings = $expAugMissMeetings = $expSeptMissMeetings = $expOctMissMeetings = $expNovMissMeetings = $expDecMissMeetings = 0;

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
            
            // lateRemissions
            foreach($lateRemissions as $lateRemission) {
                // Get total for lateRemissions
                $totalLateRemission += $lateRemission->charge_amount;

                // Get monthly late remissions for members
                if ($lateRemission->month_paid_for == "Jan") {
                    $expJanLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $janLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Feb") {
                    $expFebLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $febLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Mar") {
                    $expMarLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $marLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Apr") {
                    $expAprLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $aprLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "May") {
                    $expMayLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $mayLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Jun") {
                    $expJunLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $junLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Jul") {
                    $expJulLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $julLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Aug") {
                    $expAugLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $augLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Sept") {
                    $expSeptLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $septLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Oct") {
                    $expOctLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $octLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Nov") {
                    $expNovLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $novLateRems += $lateRemission->charge_amount;
                    }
                }if ($lateRemission->month_paid_for == "Dec") {
                    $expDecLateRems += $lateRemission->charge_amount;
                    if ($lateRemission->has_paid == true) {
                        $decLateRems += $lateRemission->charge_amount;
                    }
                }
            }
            
            // missedMeetings
            foreach($missedMeetings as $missedMeeting) {
                // Get total for missedMeetings
                $totalMissedMeeting += $missedMeeting->charge_amount;

                // Get monthly missedMeetings for members
                if ($missedMeeting->month_paid_for == "Jan") {
                    $expJanMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $janMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Feb") {
                    $expFebMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $febMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Mar") {
                    $expMarMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $marMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Apr") {
                    $expAprMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $aprMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "May") {
                    $expMayMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $mayMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Jun") {
                    $expJunMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $junMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Jul") {
                    $expJulMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $julMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Aug") {
                    $expAugMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $augMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Sept") {
                    $expSeptMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $septMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Oct") {
                    $expOctMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $octMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Nov") {
                    $expNovMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $novMissMeetings += $missedMeeting->charge_amount;
                    }
                }if ($missedMeeting->month_paid_for == "Dec") {
                    $expDecMissMeetings += $missedMeeting->charge_amount;
                    if ($missedMeeting->has_paid == true) {
                        $decMissMeetings += $missedMeeting->charge_amount;
                    }
                }
            }

            $totalAssets = $totalMemberSaving + $totalLateRemission + $totalMissedMeeting;
            $expMonthSavings = $totalMembers * $monthlyAmount;
        }
        
        return view('home', compact([
            'totalMemberSaving', 'totalLateRemission', 'totalMissedMeeting', 'totalInvestments', 'totalMembers', 'totalAssets', 'totalLiabilities', 'expMonthSavings', 'financialMonths', 
            'janSavings', 'febSavings', 'marSavings', 'aprSavings', 'maySavings', 'junSavings', 'julSavings', 'augSavings', 'septSavings', 'octSavings', 'novSavings', 'decSavings', 
            'expJanLateRems', 'expFebLateRems', 'expMarLateRems', 'expAprLateRems', 'expMayLateRems', 'expJunLateRems', 'expJulLateRems', 'expAugLateRems', 'expSeptLateRems', 'expOctLateRems', 
            'expNovLateRems', 'expDecLateRems', 
            'janLateRems', 'febLateRems', 'marLateRems', 'aprLateRems', 'mayLateRems', 'junLateRems', 'julLateRems', 'augLateRems', 'septLateRems', 
            'octLateRems', 'novLateRems', 'decLateRems', 
            'expJanMissMeetings', 'expFebMissMeetings', 'expMarMissMeetings', 'expAprMissMeetings', 'expMayMissMeetings', 'expJunMissMeetings', 'expJulMissMeetings', 'expAugMissMeetings', 'expSeptMissMeetings', 'expOctMissMeetings', 
            'expNovMissMeetings', 'expDecMissMeetings', 
            'janMissMeetings', 'febMissMeetings', 'marMissMeetings', 'aprMissMeetings', 'mayMissMeetings', 'junMissMeetings', 'julMissMeetings', 'augMissMeetings', 'septMissMeetings', 
            'octMissMeetings', 'novMissMeetings', 'decMissMeetings', 
        ]));
    } 
}
