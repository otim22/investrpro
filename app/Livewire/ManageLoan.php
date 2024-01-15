<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Auth;

class ManageLoan extends Component
{
    private $status = true;

    public function render()
    {
        $activeLoans = LoanApplication::where([
            'company_id' => Auth::user()->company->id,
            'is_approved' => $this->status,
        ])->orderBy('id', 'desc')->paginate(25);

        return view('livewire.manage-loan', [
            'activeLoans' => $activeLoans
        ]);
    }
}
