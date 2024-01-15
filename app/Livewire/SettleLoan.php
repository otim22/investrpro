<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;
use App\Models\LoanHistory;
use App\Models\LoanApplication;
use Livewire\Attributes\Validate;

class SettleLoan extends Component
{
    public $member = null;
    public $currentUpdateCredit = false;
    public $currentActive = true;
    public $currentInActive = false;
    public $currentloanHistory = false;
    protected $loanApplication = null;
    public $repayment_loan_id = null;
    public $loan_application_id = null;
    public $date_paid = null;
    public $amount_paid = null;
    public $comment = null;
    
    public function mount($id)
    {
        $this->loan_application_id = $id;
        $this->loanApplication = LoanApplication::find($id);
        $this->member = Member::find($this->loanApplication->member_id);
    }

    public function setLoanHistoryId($id)
    {
        $this->repayment_loan_id = $id;
    }
    
    public function render()
    {
        if ($this->currentActive) {
            $loanHistories = $this->advancedCredit($status = true);
        } else if ($this->currentInActive) {
            $loanHistories = $this->advancedCredit($status = false);
        } else if ($this->currentloanHistory) {
            $loanHistories = $this->loanHistory();
        }
        return view('livewire.settle-loan', ['loanHistories' => $loanHistories]);
    }

    public function handleLoanUpdate()
    {
        $loan = LoanHistory::find($this->repayment_loan_id);
        $loan->update(['has_paid' => false]);
        LoanHistory::create([
            'amount_taken' => $loan->amount_taken,
            'date_paid' => $this->date_paid,
            'amount_paid' => $this->amount_paid,
            'balance' => ($loan->amount_taken - $this->amount_paid),
            'comment' => $this->comment,
            'has_paid' => true,
            'is_active' => true,
            'member_id' => $this->member->id,
            'loan_application_id' => $this->loan_application_id,
            'company_id' => $this->member->company_id,
        ]);
        
        $this->date_paid = '';
        $this->amount_paid = '';
        $this->comment = '';

        return redirect()->route('settlements.show', $this->loan_application_id);
    }

    public function updateCredit()
    {
        $this->currentUpdateCredit = true;
        $this->currentActive = false;
        $this->currentInActive = false;
        $this->currentloanHistory = false;
    }
    
    public function activeLoans()
    {
        $this->currentActive = true;
        $this->currentInActive = false;
        $this->currentloanHistory = false;
        $this->currentUpdateCredit = false;
    }

    public function inActiveLoans()
    {
        $this->currentActive = false;
        $this->currentInActive = true;
        $this->currentloanHistory = false;
        $this->currentUpdateCredit = false;
    }

    public function loanHistory()
    {
        $this->currentActive = false;
        $this->currentInActive = false;
        $this->currentloanHistory = true;
        $this->currentUpdateCredit = false;
        return $this->allAdvancedCredit();
    }
    
    public function allAdvancedCredit()
    {
        return LoanHistory::where([
            'member_id' => $this->member->id
        ])->orderBy('date_paid','desc')->paginate(25);
    }

    public function advancedCredit($status)
    {
        return LoanHistory::where([
            'member_id' => $this->member->id,
            'is_active' => $status,
        ])->orderBy('date_paid','desc')->paginate(25);
    }
}
