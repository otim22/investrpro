<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Asset;
use App\Models\Member;
use App\Models\Investment;
use App\Models\FinancialYear;
use App\Models\FinancialMonth;
use Illuminate\Support\Facades\Auth;

class IndividualAccount extends Component
{
    public $individual = null;
    public $paidSavings = 0;
    public $unPaidSavings = 0;
    public $annualFees = 0;
    public $investment = 0;
    public $members = 0;
    public $individualWorth = 0;
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
    public $years = [];
    public $year = null;
    public $month = null;

    public function mount()
    {
        if(Auth::user()->company) {
            $this->months = FinancialMonth::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            $this->years = FinancialYear::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get()->pluck('title');
            $this->individual = Auth::user();
            $this->paidSavings = Asset::where([
                'member_id' => $this->individual->id, 
                'has_paid' => true,
            ])->get()->reduce(function($carry, $item) {
                return $carry + $item->amount;
            }, 0);
            $this->unPaidSavings = Asset::where([
                'member_id' => $this->individual->id, 
                'has_paid' => false,
            ])->get()->reduce(function($carry, $item) {
                return $carry + $item->amount;
            }, 0);
            $this->annualFees = Asset::where([
                'member_id' => $this->individual->id, 
                'asset' => 'Membership fees',
            ])->get()->reduce(function($carry, $item) {
                return $carry + $item->amount;
            }, 0);
            $this->investment = Investment::where([
                'company_id' => $this->individual->company->id 
            ])->get()->reduce(function($carry, $item) {
                return $carry + $item->interest_recieved;
            }, 0);
            $this->members = Member::where([
                'company_id' => $this->individual->company->id
            ])->count();
            $this->individualWorth = $this->investment / $this->members;
        }
    }

    public function render()
    {
        return view('livewire.individual-account');
    }

    public function filterDataByMonth()
    {
        if ($this->month) {
            $key = array_search($this->month, $this->customMonths);
            if(!$key) {
                return;
            } else {
                $this->paidSavings = Asset::where([
                    'member_id' => $this->individual->id, 
                    'has_paid' => true,
                ])->whereMonth('date_paid', $key)->get()->reduce(function($carry, $item){
                    return $carry + $item->amount;
                }, 0);
                $this->unPaidSavings = Asset::where([
                    'member_id' => $this->individual->id, 
                    'has_paid' => false,
                ])->whereMonth('date_paid', $key)->get()->reduce(function($carry, $item){
                    return $carry + $item->amount;
                }, 0);
                $this->annualFees = Asset::where([
                    'member_id' => $this->individual->id, 
                    'asset' => 'Membership fees',
                ])->whereMonth('date_paid', $key)->get()->reduce(function($carry, $item){
                    return $carry + $item->amount;
                }, 0);
                $this->investment = Investment::where([
                    'company_id' => $this->individual->company->id 
                ])->whereMonth('date_of_investment', $key)->get()->reduce(function($carry, $item){
                    return $carry + $item->interest_recieved;
                }, 0);
                $this->individualWorth = $this->investment / $this->members;
            }
        }
    }
    
    public function filterDataByYear()
    {
        if ($this->year) {
            $this->paidSavings = Asset::where([
                'member_id' => $this->individual->id, 
                'financial_year' => $this->year,
                'has_paid' => true,
            ])->get()->reduce(function($carry, $item){
                return $carry + $item->amount;
            }, 0);
            $this->unPaidSavings = Asset::where([
                'member_id' => $this->individual->id, 
                'financial_year' => $this->year,
                'has_paid' => false,
            ])->get()->reduce(function($carry, $item){
                return $carry + $item->amount;
            }, 0);
            $this->annualFees = Asset::where([
                'member_id' => $this->individual->id, 
                'financial_year' => $this->year,
                'asset' => 'Membership fees',
            ])->get()->reduce(function($carry, $item){
                return $carry + $item->amount;
            }, 0);
            $this->investment = Investment::where([
                'company_id' => $this->individual->company->id,
                'financial_year' => $this->year
            ])->get()->reduce(function($carry, $item) {
                return $carry + $item->interest_recieved;
            }, 0);
            
            $this->individualWorth = $this->investment / $this->members;
        }
    }
}
