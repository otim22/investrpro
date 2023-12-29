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
    public $expAssetToal = 0;
    public $actAssetToal = 0;
    public $netAsset = 0;
    public $totalActSaving = 0;
    public $totalActLateRemission = 0;
    public $totalActMissedMeeting = 0;
    public $expAssetTotal = 0;
    public $actualAssetTotal = 0;

    // Expenses
    public $expenses = [];
    public $totalExpensesValue = 0;
    public $totalCurrentExpenses = 0;
    public $currentExpenses = 0;
    public $nonCurrentExpenses = 0;
    public $totalNonCurrentExpenses = 0;
    
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
    protected $customCurrentLiab = "Current expenses";
    protected $customNonCurrentLiab = "Non Current expenses";
    public $years = [];
    public $year = null;
    public $month = null;

    public function mount()
    {
        if(Auth::user()->company) {
            /* Assets */
            $this->totalActSaving = Asset::where([
                'company_id' => Auth::user()->company->id,
                'asset' => $this->customSavings,
                'has_paid' => true
            ])->get()->reduce(function($carry, $item){
                return $carry + $item->amount;
            }, 0);

            $this->totalActLateRemission = Asset::where([
                'company_id'  => Auth::user()->company->id,
                'asset' => $this->customLateRemission,
                'has_paid' => true
            ])->get()->reduce(function($carry, $item){
                return $carry + $item->amount;
            }, $this->expAssetToal);

            $this->totalActMissedMeeting = Asset::where([
                'company_id'  => Auth::user()->company->id,
                'asset' => $this->customMissedMeeting,
                'has_paid' => true
            ])->get()->reduce(function($carry, $item){
                return $carry + $item->amount;
            }, $this->expAssetToal);

            $this->expAssetToal = Asset::where([
                'company_id' => Auth::user()->company->id,
            ])->get()->reduce(function($carry, $item){
                return $carry + $item->amount;
            }, $this->expAssetToal);

            $this->actAssetToal = Asset::where([
                'company_id' => Auth::user()->company->id,
                'has_paid' => true
            ])->get()->reduce(function($carry, $item){
                return $carry + $item->amount;
            }, $this->actAssetToal);

            $this->months = FinancialMonth::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            $this->years = FinancialYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            
            /* Expenses */
            $this->expenses = Expense::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $this->totalExpensesValue = Expense::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);

            $this->currentExpenses = Expense::where([
                'company_id' => Auth::user()->company->id,
                'expense_type' => $this->customCurrentLiab
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);

            $this->totalCurrentExpenses = Expense::where([
                'company_id' => Auth::user()->company->id,
                'expense_type' => $this->customCurrentLiab
            ])->count();
            $this->totalNonCurrentExpenses = Expense::where([
                'company_id' => Auth::user()->company->id,
                'expense_type' => $this->customNonCurrentLiab
            ])->count();
            $this->nonCurrentExpenses = Expense::where([
                'company_id' => Auth::user()->company->id,
                'expense_type' => $this->customNonCurrentLiab
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
        }

        $this->actualAssetTotal = $this->actAssetToal;
        $this->netAsset = $this->actAssetToal - $this->totalExpensesValue;
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
                /* Member saving by month */
                $this->totalActSaving = Asset::where([
                    'company_id' => Auth::user()->company->id,
                    'asset' => $this->customSavings,
                    'has_paid' => true
                ])->whereMonth('date_paid', $key)->get()->reduce(function($carry, $item){
                    return $carry + $item->amount;
                }, 0);
                
                // Late remissions saving by month
                $this->totalActLateRemission = Asset::where([
                    'company_id' => Auth::user()->company->id,
                    'asset' => $this->customLateRemission,
                    'has_paid' => true
                ])->whereMonth('date_paid', $key)->get()->reduce(function($carry, $item) {
                    return $carry + $item->amount;
                }, 0);
                
                // Missed meeting by month
                $this->totalActMissedMeeting = Asset::where([
                    'company_id' => Auth::user()->company->id,
                    'asset' => $this->customMissedMeeting,
                    'has_paid' => true
                ])->whereMonth('date_paid', $key)->get()->reduce(function($carry, $item){
                    return $carry + $item->amount;
                }, 0);
                
                $this->actualAssetTotal = $this->totalActSaving + $this->totalActLateRemission + $this->totalActMissedMeeting;

                /* Expenses */
                $this->expenses = Expense::where([
                    'company_id' => Auth::user()->company->id,
                ])->whereMonth('date_of_expense', $key)->orderBy('id', 'desc')->get();

                $this->totalExpensesValue = Expense::where([
                    'company_id' => Auth::user()->company->id,
                ])->whereMonth('date_of_expense', $key)->get()->reduce(function($carry, $item) {
                    $subTotal = $item->amount * $item->rate;
                    return $carry += $subTotal;
                }, 0);

                $this->currentExpenses = Expense::where([
                    'company_id' => Auth::user()->company->id,
                    'expense_type' => $this->customCurrentLiab
                ])->whereMonth('date_of_expense', $key)->get()->reduce(function($carry, $item){
                    $subTotal = $item->amount * $item->rate;
                    return $carry += $subTotal;
                }, 0);

                $this->nonCurrentExpenses = Expense::where([
                    'company_id' => Auth::user()->company->id,
                    'expense_type' => $this->customNonCurrentLiab
                ])->whereMonth('date_of_expense', $key)->get()->reduce(function($carry, $item){
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
            $this->totalActSaving = Asset::where([
                'company_id' => Auth::user()->company->id,
                'asset' => $this->customSavings,
                'financial_year' => $this->year,
                'has_paid' => true
            ])->get()->reduce(function($carry, $item){
                    return $carry + $item->amount;
            }, 0);
            
            // Late remissions saving by year
            $this->totalActLateRemission = Asset::where([
                'company_id' => Auth::user()->company->id,
                'asset' => $this->customLateRemission,
                'financial_year' => $this->year,
                'has_paid' => true
            ])->get()->reduce(function($carry, $item){
                    return $carry + $item->amount;
            }, 0);
            
            // Missed meeting by year
            $this->totalActMissedMeeting = Asset::where([
                'company_id' => Auth::user()->company->id,
                'asset' => $this->customMissedMeeting,
                'financial_year' => $this->year,
                'has_paid' => true
            ])->get()->reduce(function($carry, $item){
                    return $carry + $item->amount;
            }, 0);
            
            $this->actualAssetTotal = $this->totalActSaving + $this->totalActLateRemission + $this->totalActMissedMeeting;

            // Expenses
            $this->expenses = Expense::where([
                'company_id' => Auth::user()->company->id,
                'financial_year' => $this->year
            ])->orderBy('id', 'desc')->get();

            $this->totalExpensesValue = Expense::where([
                'company_id' => Auth::user()->company->id,
                'financial_year' => $this->year
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);

            $this->currentExpenses = Expense::where([
                'company_id' => Auth::user()->company->id,
                'expense_type' => $this->customCurrentLiab,
                'financial_year' => $this->year
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);

            $this->nonCurrentExpenses = Expense::where([
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
