<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoanApplicationUpdateRequest;

class LoanApprovalController extends Controller
{
    public function index()
    {
        $loanApplications = [];
        if(Auth::user()->company) {
            $loanApplications = LoanApplication::where([
                'company_id' => Auth::user()->company->id,
            ])->orWhere([
                'approved_by_one' => Auth::user()->first_name .' '. Auth::user()->last_name,
            ])->orWhere([
                'approved_by_two' => Auth::user()->first_name .' '. Auth::user()->last_name
            ])->orderBy('id', 'desc')->paginate(25);
        }
        return view('loan_approval.index', compact('loanApplications'));
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanApplication $loanApplication)
    {
        return view('loan_approval.show', compact('loanApplication'));
    }
}
