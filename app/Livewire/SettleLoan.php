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
    public $currentActive = false;
    public $currentInActive = false;
    public $currentloanHistory = true;
    public $loanApplication = null;
    public $repayment_loan_id = null;
    public $specific_loan_repayment_id = null;
    public $loan_application_id = null;
    public $date_paid = null;
    public $amount_paid = null;
    public $comment = null;
    public $edited_date_paid = null;
    public $edited_amount_paid = null;
    public $edited_comment = null;

    public function mount($id)
    {
        $this->loan_application_id = $id;
        $this->loanApplication = LoanApplication::find($id);
        $this->member = Member::find($this->loanApplication->member_id);
    }

    public function handleLoanPaymentId($id)
    {
        $this->repayment_loan_id = $id;
    }
    
    public function handleLoanPaymentEditId($id)
    {
        $this->specific_loan_repayment_id = $id;
        $loan = LoanHistory::find($this->specific_loan_repayment_id);
        $this->edited_date_paid = $loan->date_paid;
        $this->edited_amount_paid = $loan->amount_paid;
        $this->edited_comment = $loan->comment;
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

    public function handleLoanPayment()
    {
        $loan = LoanHistory::find($this->repayment_loan_id);
        $amountPaid = $loan->amount_taken - $loan->balance;
        $balanceLeft = $loan->amount_taken - $amountPaid;
        $computedBalance = ($loan->balance - $this->amount_paid);
        if ($this->amount_paid == $balanceLeft) {
            $loan->update(['has_paid' => false]);
            LoanHistory::create([
                'ref_code' => $loan->ref_code,
                'amount_taken' => $loan->amount_taken,
                'date_paid' => $this->date_paid,
                'amount_paid' => $this->amount_paid,
                'balance' => $computedBalance,
                'comment' => $this->comment,
                'has_paid' => true,
                'is_active' => false,
                'member_id' => $this->member->id,
                'loan_application_id' => $this->loan_application_id,
                'company_id' => $this->member->company_id,
            ]);
            $this->date_paid = '';
            $this->amount_paid = '';
            $this->comment = '';
            $this->dispatch('updated-loan');
        } else if ($this->amount_paid < $balanceLeft) {
            $loan->update(['has_paid' => false]);
            LoanHistory::create([
                'ref_code' => $loan->ref_code,
                'amount_taken' => $loan->amount_taken,
                'date_paid' => $this->date_paid,
                'amount_paid' => $this->amount_paid,
                'balance' => $computedBalance,
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
            $this->dispatch('updated-loan');
        } else {
            $loan->update(['has_paid' => true]);
            $this->date_paid = '';
            $this->amount_paid = '';
            $this->comment = '';
            return redirect()->route('settlements.show', $this->loan_application_id)->with('warning', 'You are paying excess');
        }
    }
    
    public function handleLoanPaymentEdit()
    {
        $loan = LoanHistory::find($this->specific_loan_repayment_id);
        $amountPaid = $loan->amount_taken - $loan->balance;
        $balanceLeft = $loan->amount_taken - $amountPaid;
        $computedBalance = ($balanceLeft - $this->edited_amount_paid);
        if ($this->edited_amount_paid < $balanceLeft) {
            $loan->update([
                'amount_taken' => $loan->amount_taken,
                'date_paid' => $this->edited_date_paid,
                'amount_paid' => $this->edited_amount_paid,
                'balance' => $computedBalance,
                'comment' => $this->edited_comment,
                'has_paid' => true,
                'is_active' => true,
                'member_id' => $this->member->id,
                'loan_application_id' => $this->loan_application_id,
                'company_id' => $this->member->company_id,
            ]);
            $this->edited_date_paid = '';
            $this->edited_amount_paid = '';
            $this->edited_comment = '';
            $this->dispatch('updated-loan');
        } else if ($this->edited_amount_paid == $balanceLeft) {
            $loan->update([
                'amount_taken' => $loan->amount_taken,
                'date_paid' => $this->edited_date_paid,
                'amount_paid' => $this->edited_amount_paid,
                'balance' => $computedBalance,
                'comment' => $this->edited_comment,
                'has_paid' => true,
                'is_active' => false,
                'member_id' => $this->member->id,
                'loan_application_id' => $this->loan_application_id,
                'company_id' => $this->member->company_id,
            ]);
            $this->edited_date_paid = '';
            $this->edited_amount_paid = '';
            $this->edited_comment = '';
            $this->dispatch('updated-loan');
        } else {
            $this->edited_date_paid = '';
            $this->edited_amount_paid = '';
            $this->edited_comment = '';
            return redirect()->route('settlements.show', $this->loan_application_id)->with('warning', 'You\'re paying more');
        }
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
