<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;
use App\Models\MemberSaving;
use App\Models\LateRemission;
use App\Models\MissedMeeting;
use App\Models\FinancialMonth;
use App\Models\FinancialYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfitAndLossShow extends Component
{
    // Assets
    public $memberSavings = [];
    public $lateRemissions = [];
    public $missedMeetings = [];
    public $totalMemberSaving = 0;
    public $totalLateRemission = 0;
    public $totalMissedMeeting = 0;
    public $overallAssetTotal = 0;
    public $expLateRems = 0;
    public $availLateRems = 0;

    // Liabilities
    public $liabilities = [];
    public $totalLiabilityValue = 0;
    public $currentLiabilities = 0;
    public $nonCurrentLiabilities = 0;
    
    // Constants
    public $months = [];
    public $years = [];
    public $month = null;
    public $year = null;

    public function mount()
    {
        if(Auth::user()->company) {
            // Assets
            $this->memberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->get();
            $this->lateRemissions = LateRemission::where('company_id', Auth::user()->company->id)->get();
            $this->missedMeetings = MissedMeeting::where('company_id', Auth::user()->company->id)->get();
            $this->months = FinancialMonth::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            $this->years = FinancialYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            
            // Liabilities
            $this->liabilities = Expense::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $this->totalLiabilityValue = Expense::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $this->currentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'liability_type' => 'Current Liabilities'
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $this->nonCurrentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'liability_type' => 'Non Current Liabilities'
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);


            foreach($this->memberSavings as $memberSaving) {
                $this->totalMemberSaving += $memberSaving->premium;
            }
            foreach($this->lateRemissions as $lateRemission) {
                $this->totalLateRemission += $lateRemission->charge_amount;
            }
            foreach($this->missedMeetings as $missedMeeting) {
                $this->totalMissedMeeting += $missedMeeting->charge_amount;
            }
        }

        $this->overallAssetTotal = $this->totalMemberSaving + $this->totalLateRemission + $this->totalMissedMeeting;
    }

    public function render()
    {
        return view('livewire.profit-and-loss-show');
    }

    public function filterDataByMonth()
    {
        if ($this->month) {
            // Assets
            // Member saving by month
            $this->memberSavings = MemberSaving::where([
                'company_id' => Auth::user()->company->id,
                'month' => $this->month
            ])->get();
            $memMonthSavTotal = 0;
            foreach($this->memberSavings as $memberSaving) {
                $memMonthSavTotal += $memberSaving->premium;
            }
            $this->totalMemberSaving = $memMonthSavTotal;
            
            // Late remissions saving by month
            $this->lateRemissions = LateRemission::where([
                'company_id' => Auth::user()->company->id,
                'month_paid_for' => $this->month
            ])->get();
            $latRemMonthTotal = 0;
            foreach($this->lateRemissions as $lateRemission) {
                $latRemMonthTotal += $lateRemission->charge_amount;
            }
            $this->totalLateRemission = $latRemMonthTotal;
            
            // Missed meeting by month
            $this->missedMeetings = MissedMeeting::where([
                'company_id' => Auth::user()->company->id,
                'month_paid_for' => $this->month
            ])->get();
            $missedMeetingTotal = 0;
            foreach($this->missedMeetings as $missedMeeting) {
                $missedMeetingTotal += $missedMeeting->charge_amount;
            }
            $this->totalMissedMeeting = $missedMeetingTotal;
            $this->overallAssetTotal = $this->totalMemberSaving + $this->totalLateRemission + $this->totalMissedMeeting;

            // Liabilities
            $this->liabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'month' => $this->month
            ])->orderBy('id', 'desc')->get();
            $this->totalLiabilityValue = Expense::where([
                'company_id' => Auth::user()->company->id,
                'month' => $this->month
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $this->currentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'liability_type' => 'Current Liabilities',
                'month' => $this->month
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $this->nonCurrentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'liability_type' => 'Non Current Liabilities',
                'month' => $this->month
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
        }
    }
    
    public function filterDataByYear()
    {
        if ($this->year) {
            // Member saving by year
            $this->memberSavings = MemberSaving::where([
                'company_id' => Auth::user()->company->id,
                'financial_year' => $this->year
            ])->get();
            $memyearSavTotal = 0;
            foreach($this->memberSavings as $memberSaving) {
                $memyearSavTotal += $memberSaving->premium;
            }
            // dd($this->memberSavings);
            $this->totalMemberSaving = $memyearSavTotal;
            
            // Late remissions saving by year
            $this->lateRemissions = LateRemission::where([
                'company_id' => Auth::user()->company->id,
                'financial_year' => $this->year
            ])->get();
            $latRemyearTotal = 0;
            foreach($this->lateRemissions as $lateRemission) {
                $latRemyearTotal += $lateRemission->charge_amount;
            }
            $this->totalLateRemission = $latRemyearTotal;
            
            // Missed meeting by year
            $this->missedMeetings = MissedMeeting::where([
                'company_id' => Auth::user()->company->id,
                'financial_year' => $this->year
            ])->get();
            $missedMeetingTotal = 0;
            foreach($this->missedMeetings as $missedMeeting) {
                $missedMeetingTotal += $missedMeeting->charge_amount;
            }
            $this->totalMissedMeeting = $missedMeetingTotal;
            $this->overallAssetTotal = $this->totalMemberSaving + $this->totalLateRemission + $this->totalMissedMeeting;

            // Liabilities
            $this->liabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'financial_year' => $this->year
            ])->orderBy('id', 'desc')->get();
            $this->totalLiabilityValue = Expense::where([
                'company_id' => Auth::user()->company->id,
                'financial_year' => $this->year
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $this->currentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'liability_type' => 'Current Liabilities',
                'financial_year' => $this->year
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $this->nonCurrentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'liability_type' => 'Non Current Liabilities',
                'financial_year' => $this->year
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
        }
    }
}
