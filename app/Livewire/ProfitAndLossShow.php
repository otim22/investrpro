<?php

namespace App\Livewire;

use App\Models\Asset;
use App\Models\Expense;
use Livewire\Component;
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
    protected $customMonths = [
        1 => "January",
        2 => "Febuary",
        3 => "March",
        4 => "April",
        5 => "May",
        6 => "June",
        7 => "July",
        8 => "August",
        9 => "September",
        10 => "October",
        11 => "November",
        12 => "December",
    ];
    protected $customSavings = "Savings";
    protected $customLateRemission = "Late remission";
    protected $customMissedMeeting = "Missed meeting";
    protected $customCurrentLiab = "Current Liabilities";
    protected $customNonCurrentLiab = "Non Current Liabilities";
    public $years = [];
    public $year = null;
    public $month = null;

    public function mount()
    {
        if(Auth::user()->company) {
            /* Assets */
            $this->memberSavings = Asset::where([
                'company_id' => Auth::user()->company->id,
                'asset' => $this->customSavings,
            ])->get();
            $this->lateRemissions = Asset::where([
                'company_id'  => Auth::user()->company->id,
                'asset' => $this->customLateRemission,
                'has_paid' => true
            ])->get();
            $this->missedMeetings = Asset::where([
                'company_id'  => Auth::user()->company->id,
                'asset' => $this->customMissedMeeting,
                'has_paid' => true
            ])->get();
            $this->months = FinancialMonth::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            $this->years = FinancialYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            
            /* Liabilities */
            $this->liabilities = Expense::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $this->totalLiabilityValue = Expense::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $this->currentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'expense_type' => $this->customCurrentLiab
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $this->nonCurrentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'expense_type' => $this->customNonCurrentLiab
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);


            foreach($this->memberSavings as $memberSaving) {
                $this->totalMemberSaving += $memberSaving->premium;
            }
            foreach($this->lateRemissions as $lateRemission) {
                $this->totalLateRemission += $lateRemission->amount;
            }
            foreach($this->missedMeetings as $missedMeeting) {
                $this->totalMissedMeeting += $missedMeeting->amount;
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
            $key = array_search($this->month, $this->customMonths);
            if(!$key) {
                return;
            } else {
                /* Assets
                ** Member saving by month */
                $this->memberSavings = Asset::where([
                    'company_id' => Auth::user()->company->id,
                    'asset' => $this->customSavings
                ])
                ->whereMonth('date_paid', $key)->get();
                
                $memMonthSavTotal = 0;
                foreach($this->memberSavings as $memberSaving) {
                    $memMonthSavTotal += $memberSaving->premium;
                }
                $this->totalMemberSaving = $memMonthSavTotal;
                
                // Late remissions saving by month
                $this->lateRemissions = Asset::where([
                    'company_id' => Auth::user()->company->id,
                    'asset' => $this->customLateRemission,
                    'has_paid' => true
                ])->whereMonth('date_paid', $key)->get();

                $latRemMonthTotal = 0;
                foreach($this->lateRemissions as $lateRemission) {
                    $latRemMonthTotal += $lateRemission->amount;
                }
                $this->totalLateRemission = $latRemMonthTotal;
                
                // Missed meeting by month
                $this->missedMeetings = Asset::where([
                    'company_id' => Auth::user()->company->id,
                    'asset' => $this->customMissedMeeting,
                    'has_paid' => true
                ])->whereMonth('date_paid', $key)->get();

                $missedMeetingTotal = 0;
                foreach($this->missedMeetings as $missedMeeting) {
                    $missedMeetingTotal += $missedMeeting->amount;
                }

                $this->totalMissedMeeting = $missedMeetingTotal;
                $this->overallAssetTotal = $this->totalMemberSaving + $this->totalLateRemission + $this->totalMissedMeeting;

                /* Liabilities */
                $this->liabilities = Expense::where([
                    'company_id' => Auth::user()->company->id,
                ])
                ->whereMonth('date_of_expense', $key)
                ->orderBy('id', 'desc')->get();

                $this->totalLiabilityValue = Expense::where([
                    'company_id' => Auth::user()->company->id,
                ])
                ->whereMonth('date_of_expense', $key)
                ->get()->reduce(function($carry, $item) {
                    $subTotal = $item->amount * $item->rate;
                    return $carry += $subTotal;
                }, 0);

                $this->currentLiabilities = Expense::where([
                    'company_id' => Auth::user()->company->id,
                    'expense_type' => $this->customCurrentLiab
                ])
                ->whereMonth('date_of_expense', $key)
                ->get()->reduce(function($carry, $item){
                    $subTotal = $item->amount * $item->rate;
                    return $carry += $subTotal;
                }, 0);

                $this->nonCurrentLiabilities = Expense::where([
                    'company_id' => Auth::user()->company->id,
                    'expense_type' => $this->customNonCurrentLiab
                ])
                ->whereMonth('date_of_expense', $key)
                ->get()->reduce(function($carry, $item){
                    $subTotal = $item->amount * $item->rate;
                    return $carry += $subTotal;
                }, 0);
            }
        }
    }
    
    public function filterDataByYear()
    {
        if ($this->year) {
            // Member saving by year
            $this->memberSavings = Asset::where([
                'company_id' => Auth::user()->company->id,
                'asset' => $this->customSavings,
                'financial_year' => $this->year
            ])->get();
            $memyearSavTotal = 0;
            foreach($this->memberSavings as $memberSaving) {
                $memyearSavTotal += $memberSaving->premium;
            }
            $this->totalMemberSaving = $memyearSavTotal;
            
            // Late remissions saving by year
            $this->lateRemissions = Asset::where([
                'company_id' => Auth::user()->company->id,
                'asset' => $this->customLateRemission,
                'financial_year' => $this->year,
                'has_paid' => true
            ])->get();
            $latRemyearTotal = 0;
            foreach($this->lateRemissions as $lateRemission) {
                $latRemyearTotal += $lateRemission->amount;
            }
            $this->totalLateRemission = $latRemyearTotal;
            
            // Missed meeting by year
            $this->missedMeetings = Asset::where([
                'company_id' => Auth::user()->company->id,
                'asset' => $this->customMissedMeeting,
                'financial_year' => $this->year,
                'has_paid' => true
            ])->get();
            $missedMeetingTotal = 0;
            foreach($this->missedMeetings as $missedMeeting) {
                $missedMeetingTotal += $missedMeeting->amount;
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
                'expense_type' => $this->customCurrentLiab,
                'financial_year' => $this->year
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);

            $this->nonCurrentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'expense_type' => $this->customNonCurrentLiab,
                'financial_year' => $this->year
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
        }
    }
}
