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
        $totalMemberSaving = $totalLateRemission = $totalMissedMeeting = $totalInvestments = $totalAssets = $totalExpenses = 0;
        $totalMembers = $monthlyAmount = $lateRemissionAmount = $missedMeetingAmount = $expMonthSavings = 0;
        
        // Savings months
        $janSavings = $febSavings = $marSavings = $aprSavings = $maySavings = $junSavings = 0;
        $julSavings = $augSavings = $septSavings = $octSavings = $novSavings = $decSavings = 0;
        $expJanSavings = $expFebSavings = $expMarSavings = $expAprSavings = $expMaySavings = $expJunSavings = 0;
        $expJulSavings = $expAugSavings = $expSeptSavings = $expOctSavings = $expNovSavings = $expDecSavings = 0;
        
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

        $customSavings = "Savings";
        $customLateRemission = "Late remission";
        $customMissedMeeting = "Missed meeting";

        if(Auth::user()->company) {
            $memberSavings = Asset::where([
                'company_id' => Auth::user()->company->id,
                'asset' => $customSavings,
            ])->get();
            $lateRemissions = Asset::where([
                'company_id'  => Auth::user()->company->id,
                'asset' => $customLateRemission,
            ])->get();
            $missedMeetings = Asset::where([
                'company_id'  => Auth::user()->company->id,
                'asset' => $customMissedMeeting,
            ])->get();
            $totalExpenses = Expense::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item) {
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
                $totalMemberSaving += $memberSaving->amount;
                // Get monthly total for members
                if ($memberSaving->date_paid->format('M') == "Jan") {
                    $expJanSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $janSavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "Feb") {
                    $expFebSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $febSavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "Mar") {
                    $expMarSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $marSavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "Apr") {
                    $expAprSavings += $memberSaving->amount; 
                    if ($memberSaving->has_paid == true) {
                        $aprSavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "May") {
                    $expMaySavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $maySavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "Jun") {
                    $expJunSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $junSavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "Jul") {
                    $expJulSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $julSavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "Aug") {
                    $expAugSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $augSavings += $memberSaving->amount; 
                    }
                }if ($memberSaving->date_paid->format('M') == "Sept") {
                    $expSeptSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $septSavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "Oct") {
                    $expOctSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $octSavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "Nov") {
                    $expNovSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $novSavings += $memberSaving->amount;
                    }
                }if ($memberSaving->date_paid->format('M') == "Dec") {
                    $expDecSavings += $memberSaving->amount;
                    if ($memberSaving->has_paid == true) {
                        $decSavings += $memberSaving->amount;
                    }
                }
            }
            
            // lateRemissions
            foreach($lateRemissions as $lateRemission) {
                // Get total for lateRemissions
                $totalLateRemission += $lateRemission->amount;

                // Get monthly late remissions for members
                if ($lateRemission->date_paid->format('M') == "Jan") {
                    $expJanLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $janLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Feb") {
                    $expFebLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $febLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Mar") {
                    $expMarLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $marLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Apr") {
                    $expAprLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $aprLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "May") {
                    $expMayLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $mayLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Jun") {
                    $expJunLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $junLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Jul") {
                    $expJulLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $julLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Aug") {
                    $expAugLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $augLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Sept") {
                    $expSeptLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $septLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Oct") {
                    $expOctLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $octLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Nov") {
                    $expNovLateRems += $lateRemission->amount;
                    if ($lateRemission->has_paid == true) {
                        $novLateRems += $lateRemission->amount;
                    }
                }if ($lateRemission->date_paid->format('M') == "Dec") {
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
                if ($missedMeeting->date_paid->format('M') == "Jan") {
                    $expJanMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $janMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Feb") {
                    $expFebMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $febMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Mar") {
                    $expMarMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $marMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Apr") {
                    $expAprMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $aprMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "May") {
                    $expMayMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $mayMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Jun") {
                    $expJunMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $junMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Jul") {
                    $expJulMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $julMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Aug") {
                    $expAugMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $augMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Sept") {
                    $expSeptMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $septMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Oct") {
                    $expOctMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $octMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Nov") {
                    $expNovMissMeetings += $missedMeeting->amount;
                    if ($missedMeeting->has_paid == true) {
                        $novMissMeetings += $missedMeeting->amount;
                    }
                }if ($missedMeeting->date_paid->format('M') == "Dec") {
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
            'totalMemberSaving', 'totalLateRemission', 'totalMissedMeeting', 'totalInvestments', 'totalMembers', 'totalAssets', 'totalExpenses', 'expMonthSavings', 'financialMonths', 
            'janSavings', 'febSavings', 'marSavings', 'aprSavings', 'maySavings', 'junSavings', 'julSavings', 'augSavings', 'septSavings', 'octSavings', 'novSavings', 'decSavings', 
            'expJanSavings', 'expFebSavings', 'expMarSavings', 'expAprSavings', 'expMaySavings', 'expJunSavings', 'expJulSavings', 'expAugSavings', 'expSeptSavings', 'expOctSavings', 'expNovSavings', 'expDecSavings',
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
