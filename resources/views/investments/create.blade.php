@extends('layouts.master.app')

@section('content')

@push('styles')
    <style>
        .camel-sent {text-transform: capitalize;}
    </style>
@endpush

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Investments / <a href="{{ route('investments.index') }}">List of investments</a> / </span>Investments form</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('investments.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to investments
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('investments.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="investment_type">Investment type</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="investment_type" 
                                    class="form-control @error('investment_type') is-invalid @enderror" 
                                    name="investment_type"
                                    value="{{ old('investment_type') }}"
                                    placeholder="T-Bond" 
                                />
                                @error('investment_type')
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
                                        <option value="" selected>Select year</option>
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
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="date_of_investment">Date of investment</label>
                            <div class="col-sm-9">
                                <input 
                                    type="date" 
                                    id="date_of_investment" 
                                    class="form-control @error('date_of_investment') is-invalid @enderror" 
                                    name="date_of_investment"
                                    value="{{ old('date_of_investment') }}"
                                />
                                @error('date_of_investment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="duration">Duration</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="duration"
                                        name="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        placeholder="3"
                                        aria-describedby="duration"
                                        value="{{ old('duration') }}"
                                    />
                                    @error('duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="interest_rate">Interest rate</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="interest_rate"
                                        name="interest_rate"
                                        class="form-control @error('interest_rate') is-invalid @enderror"
                                        placeholder="0.03"
                                        aria-describedby="interest_rate"
                                        value="{{ old('interest_rate') }}"
                                    />
                                    @error('interest_rate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="amount_invested">Amount invested</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="amount_invested"
                                        name="amount_invested"
                                        class="form-control @error('amount_invested') is-invalid @enderror"
                                        placeholder="100000"
                                        aria-describedby="amount_invested"
                                        value="{{ old('amount_invested') }}"
                                    />
                                    @error('amount_invested')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="date_of_maturity">Date of maturity</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="date"
                                        id="date_of_maturity"
                                        name="date_of_maturity"
                                        class="form-control @error('date_of_maturity') is-invalid @enderror"
                                        placeholder="100000"
                                        aria-describedby="date_of_maturity"
                                        value="{{ old('date_of_maturity') }}"
                                    />
                                    @error('date_of_maturity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="expected_tax">Expected tax</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="expected_tax"
                                        name="expected_tax"
                                        class="form-control @error('expected_tax') is-invalid @enderror"
                                        placeholder="0.015"
                                        aria-describedby="expected_tax"
                                        value="{{ old('expected_tax') }}"
                                    />
                                    @error('expected_tax')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="expected_return_after_tax">Expected return after tax</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="expected_return_after_tax"
                                        name="expected_return_after_tax"
                                        class="form-control @error('expected_return_after_tax') is-invalid @enderror"
                                        placeholder="0.013"
                                        aria-describedby="expected_return_after_tax"
                                        value="{{ old('expected_return_after_tax') }}"
                                    />
                                    @error('expected_return_after_tax')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="interest_recieved">Interest recieved</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="interest_recieved"
                                        name="interest_recieved"
                                        class="form-control @error('interest_recieved') is-invalid @enderror"
                                        placeholder="0.01"
                                        aria-describedby="interest_recieved"
                                        value="{{ old('interest_recieved') }}"
                                    />
                                    @error('interest_recieved')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-9 mt-2">
                                <button type="submit" class="btn btn-primary text-capitalize">Save investment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection