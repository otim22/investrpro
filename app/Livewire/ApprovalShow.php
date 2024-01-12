<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Member;
use Livewire\Component;
use App\Models\FinancialYear;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Auth;

class ApprovalShow extends Component
{
    public $loanApplication = null;
    public $members = [];
    public $user = null;
    public $comment = null;
    public $financialYears = [];
    
    public function approveLoan($id)
    {
        $loanApplication = LoanApplication::find($id);
        $this->user = Auth::user();
        $date = Carbon::now()->format('Y-m-d H:i:s');
        
        if (!$loanApplication->approved_by_one 
            && $this->user->first_name .' '. $this->user->last_name !== $loanApplication->approved_by_two) {
            if (!$loanApplication->is_rejected) {
                $loanApplication->update([
                    'approved_by_one' => $this->user->first_name .' '. $this->user->last_name,
                    'date_one_signed' => $date
                ]);
                session()->flash('message', 'Approved loan request.');
            } else {
                session()->flash('message', 'You have already rejected.');
            }
        }  else if (!$loanApplication->approved_by_two 
            && $this->user->first_name .' '. $this->user->last_name !== $loanApplication->approved_by_one) {
            if (!$loanApplication->is_rejected) {
                $loanApplication->update([
                    'approved_by_two' => $this->user->first_name .' '. $this->user->last_name,
                    'date_two_signed' => $date
                ]);
                session()->flash('message', 'Approved loan request.');
            } else {
                session()->flash('message', 'You have already rejected.');
            }
        } else if($loanApplication->approved_by_one && $loanApplication->approved_by_two) {
            $true = 1;
            $false = 0;

            $loanApplication->update([
                'is_approved' => $true,
                'is_rejected' => $false,
            ]);

            LoanAdvance::create([
                'amount_taken' => $loanApplication->amount_requested,
                'amount_paid' => '',
                'date_paid' => '',
                'comment' => '',
                'is_active' => $true,
                'loan_application_id' => $loanApplication->id,
                'member_id' => $loanApplication->member_id,
                'company_id' => $loanApplication->company_id,
            ]);
        } else {
            session()->flash('message', 'You have already approved.');
        }
    }

    public function rejectLoan($id)
    {
        $loanApplication = LoanApplication::find($id);
        $this->user = Auth::user();

        if (!$loanApplication->approved_by_one && $this->user->first_name .' '. $this->user->last_name !== $loanApplication->approved_by_two) {
            if($this->comment) {
                $loanApplication->update([
                    'comment' => $this->comment,
                    'is_approved' => 0,
                    'is_rejected' => 1,
                ]);
                session()->flash('message', 'Cancelled loan request.');
            } else {
                session()->flash('message', 'Please write a comment.');
            }
        }  else if (!$loanApplication->approved_by_two && $this->user->first_name .' '. $this->user->last_name !== $loanApplication->approved_by_one) {
            if($this->comment) {
                $loanApplication->update([
                    'comment' => $this->comment,
                    'is_approved' => 0,
                    'is_rejected' => 1,
                ]);
                session()->flash('message', 'Cancelled loan request.');
            } else {
                session()->flash('message', 'Please write a comment.');
            }
        } else {
            session()->flash('message', 'You have already approved.');
        }
        
        return redirect(request()->header('Referer'));
    }

    public function mount($loanApplication)
    {
        if(Auth::user()->company) {
            $this->members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $this->financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }
    }

    public function render()
    {
        return view('livewire.approval-show');
    }
}
