<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\FinancialYear;
use App\Models\LoanApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoanApplicationRequest;
use App\Http\Requests\LoanApplicationUpdateRequest;

class LoanApplicationController extends Controller
{
    public function index()
    {
        $loanApplications = [];
        if(Auth::user()->company) {
            $loanApplications = LoanApplication::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->paginate(25);
        }
        return view('loan_application.index', compact('loanApplications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = [];
        $financialYears = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }
        return view('loan_application.create', compact(['members', 'financialYears']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoanApplicationRequest $request)
    {
        $request->validated();
        $loanApplication = LoanApplication::create([
            'credit_type' => $request->credit_type,
            'credit_purpose' => $request->credit_purpose,
            'amount_requested' => $request->amount_requested,
            'repayment_plan' => $request->repayment_plan,
            'signature' => $request->signature,
            'financial_year' => $request->financial_year,
            'member_id' => $request->member_id,
            'company_id' => Auth::user()->company->id,
        ]); 
        return redirect()->route('loan-application.index')->with("success", "Loan application created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanApplication $loanApplication)
    {
        $members = [];
        $financialYears = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }
        return view('loan_application.show', compact(['loanApplication', 'members', 'financialYears']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanApplication $loanApplication)
    {
        $members = [];
        $financialYears = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
            $financialYears = FinancialYear::where('company_id', Auth::user()->company->id)->get();
        }
        return view('loan_application.edit', compact(['loanApplication', 'members', 'financialYears']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LoanApplicationUpdateRequest $request, LoanApplication $loanApplication)
    {
        $request->validated();
        $loanApplication->update($request->all());
        return redirect()->route('loan-application.index', $loanApplication)->with('success', 'Loan application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(LoanApplication $loanApplication)
    {
        $loanApplication->delete();
        return redirect()->route('loan-application.index')->with('success', 'Loan application deleted successfully');
    }
}
