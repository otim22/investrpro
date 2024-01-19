<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LoanHistory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class LoanGiven extends Component
{
    use WithPagination;
    
    public $advancedCredits;
    public $authUser = null;
    public $currentActive = false;
    public $currentInActive = false;
    public $currentloanHistory = true;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->authUser = Auth::user()->first_name .' '. Auth::user()->last_name;
    }

    public function render()
    {
        if ($this->currentActive) {
            $credit = $this->advancedCredit($status = true);
        } else if ($this->currentInActive) {
            $credit = $this->advancedCredit($status = false);
        } else if ($this->currentloanHistory) {
            $credit = $this->loanHistory();
        }
        return view('livewire.loan-given', ['credits' => $credit]);
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
        return LoanHistory::where([
            'company_id' => Auth::user()->company->id
        ])->orderBy('date_paid','desc')->paginate(25);
    }

    public function advancedCredit($status)
    {
        return LoanHistory::where([
            'company_id' => Auth::user()->company->id,
            'is_active' => $status,
        ])->orderBy('date_paid','desc')->paginate(25);
    }
}
