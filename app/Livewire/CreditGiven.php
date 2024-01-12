<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Credit;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class CreditGiven extends Component
{
    use WithPagination;
    
    public $advancedCredits;
    public $authUser = null;
    public $currentActive = true;
    public $currentInActive = false;
    public $currentloanHistory = false;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->authUser = Auth::user()->first_name .' '. Auth::user()->last_name;
    }

    public function render()
    {
        if ($this->currentActive) {
            $credit = $this->advancedCredit($status = 1);
        } else if ($this->currentInActive) {
            $credit = $this->advancedCredit($status = 0);
        } else if ($this->currentloanHistory) {
            $credit = $this->loanHistory();
        }
        return view('livewire.credit-given', ['credits' => $credit]);
    }

    public function activeLoans()
    {
        $this->currentActive = true;
        $this->currentInActive = false;
        $this->currentloanHistory = false;
    }

    public function inActiveLoans()
    {
        $this->currentActive = false;
        $this->currentInActive = true;
        $this->currentloanHistory = false;
    }

    public function loanHistory()
    {
        $this->currentActive = false;
        $this->currentInActive = false;
        $this->currentloanHistory = true;
        return $this->allAdvancedCredit();
    }
    
    public function allAdvancedCredit()
    {
        return Credit::where([
            'company_id' => Auth::user()->company->id
        ])->orderBy('created_at','desc')->paginate(25);
    }

    public function advancedCredit($status)
    {
        return Credit::where([
            'company_id' => Auth::user()->company->id,
            'is_active' => $status,
        ])->orderBy('created_at','desc')->paginate(25);
    }
}
