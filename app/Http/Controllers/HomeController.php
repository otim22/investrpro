<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Asset;
use App\Models\Member;
use App\Models\Expense;
use App\Models\Investment;
use App\Models\FinancialMonth;
use App\Models\ChargeSetting;
use App\Models\MemberSaving;
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
            $lateRemissions = Charge::where([
                'company_id'  => Auth::user()->company->id,
                'charge' => 'Late remission'
            ])->get();
            $missedMeetings = Charge::where([
                'company_id'  => Auth::user()->company->id,
                'charge' => 'Missed meeting'
            ])->get();
            $totalLiabilities = Expense::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item) {
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
                if ($memberSaving->month == "January") {
                    $janSavings += $memberSaving->premium;
                }if ($memberSaving->month == "Febuary") {
                    $febSavings += $memberSaving->premium;
                }if ($memberSaving->month == "March") {
                    $marSavings += $memberSaving->premium;
                }if ($memberSaving->month == "April") {
                    $aprSavings += $memberSaving->premium;
                }if ($memberSaving->month == "May") {
                    $maySavings += $memberSaving->premium;
                }if ($memberSaving->month == "June") {
                    $junSavings += $memberSaving->premium;
                }if ($memberSaving->month == "July") {
                    $julSavings += $memberSaving->premium;
                }if ($memberSaving->month == "August") {
                    $augSavings += $memberSaving->premium;
                }if ($memberSaving->month == "September") {
                    $septSavings += $memberSaving->premium;
                }if ($memberSaving->month == "October") {
                    $octSavings += $memberSaving->premium;
                }if ($memberSaving->month == "November") {
                    $novSavings += $memberSaving->premium;
                }if ($memberSaving->month == "December") {
                    $decSavings += $memberSaving->premium;
                }
            }
            
            // lateRemissions
            foreach($lateRemissions as $lateRemission) {
                // Get total for lateRemissions
                $totalLateRemission += $lateRemission->amount;

                // Get monthly late remissions for members
                if ($lateRemission->month == "January") {
                    $expJanLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $janLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "Febuary") {
                    $expFebLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $febLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "March") {
                    $expMarLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $marLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "April") {
                    $expAprLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $aprLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "May") {
                    $expMayLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $mayLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "June") {
                    $expJunLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $junLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "July") {
                    $expJulLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $julLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "August") {
                    $expAugLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $augLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "September") {
                    $expSeptLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $septLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "October") {
                    $expOctLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $octLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "November") {
                    $expNovLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $novLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->month == "December") {
                    $expDecLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $decLateRems += $lateRemission->amount;
                    }
                }
            }
            
            // missedMeetings
            foreach($missedMeetings as $missedMeeting) {
                // Get total for missedMeetings
                $totalMissedMeeting += $missedMeeting->amount;

                // Get monthly missedMeetings for members
                if ($missedMeeting->month == "January") {
                    $expJanMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $janMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "Febuary") {
                    $expFebMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $febMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "March") {
                    $expMarMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $marMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "April") {
                    $expAprMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $aprMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "May") {
                    $expMayMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $mayMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "June") {
                    $expJunMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $junMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "July") {
                    $expJulMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $julMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "August") {
                    $expAugMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $augMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "September") {
                    $expSeptMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $septMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "October") {
                    $expOctMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $octMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "November") {
                    $expNovMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $novMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->month == "December") {
                    $expDecMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $decMissMeetings += $missedMeeting->amount;
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
