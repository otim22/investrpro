<?php

namespace App\Livewire;

use App\Models\Asset;
use Livewire\Component;
use App\Models\MemberSaving;
use App\Models\LateRemission;
use App\Models\MissedMeeting;
use App\Models\FinancialMonth;
use App\Models\FinancialYear;
use App\Models\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetIndex extends Component
{
    public $memberSavings = [];
    public $lateRemissions = [];
    public $missedMeetings = [];
    public $months = [];
    public $years = [];
    public $totalMemberSaving = 0;
    public $totalLateRemission = 0;
    public $totalMissedMeeting = 0;
    public $overallTotal = 0;
    public $expLateRems = 0;
    public $availLateRems = 0;
    public $month = null;
    public $year = null;

    public function mount()
    {
        if(Auth::user()->company) {
            $this->memberSavings = MemberSaving::where('company_id', Auth::user()->company->id)->get();
            $this->lateRemissions = LateRemission::where('company_id', Auth::user()->company->id)->get();
            $this->missedMeetings = MissedMeeting::where('company_id', Auth::user()->company->id)->get();
            $this->months = FinancialMonth::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            $this->years = FinancialYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            
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

        $this->overallTotal = $this->totalMemberSaving + $this->totalLateRemission + $this->totalMissedMeeting;
    }

    public function render()
    {
        return view('livewire.asset-index');
    }

    public function filterDataByMonth()
    {
        if ($this->month) {
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

            $this->overallTotal = $this->totalMemberSaving + $this->totalLateRemission + $this->totalMissedMeeting;
        }
    }
    
    public function filterDataByYear()
    {
        // dd($this->year);
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

            $this->overallTotal = $this->totalMemberSaving + $this->totalLateRemission + $this->totalMissedMeeting;
        }
    }
}
