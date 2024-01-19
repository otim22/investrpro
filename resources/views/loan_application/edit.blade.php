@extends('layouts.master.app')

@section('content')

@push('styles')
    <style>
        .camel-sent {text-transform: capitalize;}
    </style>
@endpush

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-2">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Loan service / <a href="{{ route('loan-application.index') }}">List of loan applications</a> / </span>{{ $loanApplication->ref_code }}</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('loan-application.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to applications
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('loan-application.update', $loanApplication) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="member_id">Member's name</label>
                            <div class="col-sm-9">
                                <select 
                                    id="member_id" 
                                    class="form-select @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    aria-label="Default select member"
                                    autofocus
                                    required
                                >
                                    <option value="{{ $loanApplication->member_id }}" selected>{{ $loanApplication->member->surname }} {{ $loanApplication->member->given_name }}</option>
                                    @if($members)
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->surname }} {{ $member->given_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('member_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="financial_year">Financial year</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <select 
                                        id="financial_year" 
                                        class="form-select @error('financial_year') is-invalid @enderror" 
                                        name="financial_year"
                                        aria-label="Default select year"
                                        required
                                    >
                                        <option value="{{ $loanApplication->financial_year }}" selected>{{ $loanApplication->financial_year }}</option>
                                        @if($financialYears)
                                            @foreach($financialYears as $financialYear)
                                                <option value="{{ $financialYear->title }}">{{ $financialYear->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('financial_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="credit_type">Credit type</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <select 
                                        id="credit_type" 
                                        class="form-select @error('credit_type') is-invalid @enderror" 
                                        name="credit_type"
                                        aria-label="Default select month"
                                    >
                                        <option value="{{ $loanApplication->credit_type }}" selected>{{ $loanApplication->credit_type }}</option>
                                        <option value="new loan">New Loan</option>
                                        <option value="top up">Top Up</option>
                                </select>
                                    @error('credit_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="credit_purpose">Credit purpose</label>
                            <div class="col-sm-9">
                                <textarea
                                    type="text"
                                    id="credit_purpose"
                                    name="credit_purpose"
                                    rows="2"
                                    class="form-control @error('credit_purpose') is-invalid @enderror"
                                    aria-describedby="credit_purpose"
                                >{{ old('credit_purpose', $loanApplication->credit_purpose)}}</textarea>
                                @error('credit_purpose')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="amount_requested">Amount requested</label>
                            <div class="col-sm-9">
                                <input 
                                    type="number" 
                                    id="amount_requested" 
                                    class="form-control @error('amount_requested') is-invalid @enderror" 
                                    name="amount_requested"
                                    value="{{ old('amount_requested', $loanApplication->amount_requested) }}"
                                    placeholder="10000" 
                                    required
                                />
                                @error('amount_requested')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="repayment_plan">Repayment plan</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <select 
                                        id="repayment_plan" 
                                        class="form-select @error('repayment_plan') is-invalid @enderror" 
                                        name="repayment_plan"
                                        aria-label="Default select month"
                                    >
                                        <option value="{{ $loanApplication->repayment_plan }}" selected>{{ $loanApplication->repayment_plan }}</option>
                                        <option value="< 30 days">< 30 days</option>
                                        <option value="31 - 60 days">31 - 60 days</option>
                                        <option value="61 - 120 days">61 - 120 days</option>
                                </select>
                                    @error('repayment_plan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="signature">Signature </label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="signature" 
                                    class="form-control @error('signature') is-invalid @enderror" 
                                    name="signature"
                                    value="{{ old('signature', $loanApplication->signature) }}"
                                    placeholder="John doore" 
                                    required
                                />
                                <small class="text-muted">By entering your name you agree to the terms & conditions.</small>
                                @error('signature')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-9 mt-2">
                                <button type="submit" class="btn btn-primary text-capitalize">Update application</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection