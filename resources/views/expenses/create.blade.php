@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Expenses / </span>New form</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('expenses.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to expenses
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('expenses.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="liability_name">Liability name</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="liability_name" 
                                    class="form-control @error('liability_name') is-invalid @enderror" 
                                    name="liability_name"
                                    value="{{ old('liability_name') }}"
                                    placeholder="Expenses" 
                                />
                                @error('liability_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="liability_type">Liability type</label>
                            <div class="col-sm-10">
                                <select 
                                    id="liability_type" 
                                    class="form-select @error('liability_type') is-invalid @enderror" 
                                    name="liability_type"
                                    aria-label="Default select liability type"
                                >
                                    @if($liabilityTypes)
                                        @foreach($liabilityTypes as $liabilityType)
                                            <option value="{{ $liabilityType->liability_type }}">{{ $liabilityType->liability_type }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('liability_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="financial_year">Financial year</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <select 
                                        id="financial_year" 
                                        class="form-select @error('financial_year') is-invalid @enderror" 
                                        name="financial_year"
                                        aria-label="Default select year"
                                    >
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
                            <label class="col-sm-2 col-form-label" for="month">Month paid</label>
                            <div class="col-sm-10">
                                <select 
                                    id="month" 
                                    class="form-select @error('month') is-invalid @enderror" 
                                    name="month"
                                    aria-label="Default select month"
                                    required
                                >
                                    @if($months)
                                        @foreach($months as $month)
                                            <option value="{{ $month->title }}">{{ $month->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_of_expense">Date acquired</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="date"
                                        id="date_of_expense"
                                        name="date_of_expense"
                                        class="form-control @error('date_of_expense') is-invalid @enderror"
                                        placeholder="12/03/2029"
                                        aria-label="12/03/2029"
                                        aria-describedby="date_of_expense"
                                    />
                                    @error('date_of_expense')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="details">Details</label>
                            <div class="col-sm-10">
                                <textarea 
                                    type="text" 
                                    id="details" 
                                    rows="3"
                                    class="form-control @error('details') is-invalid @enderror" 
                                    name="details"
                                >{{ old('details') }}</textarea>
                                @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="rate">Rate</label>
                            <div class="col-sm-10">
                                <input 
                                    type="number" 
                                    id="rate" 
                                    class="form-control @error('rate') is-invalid @enderror" 
                                    name="rate"
                                    value="{{ old('rate') }}"
                                    placeholder="2" 
                                />
                                @error('rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="amount">Amount</label>
                            <div class="col-sm-10">
                                <input 
                                    type="number" 
                                    id="amount" 
                                    class="form-control @error('amount') is-invalid @enderror" 
                                    name="amount"
                                    value="{{ old('amount') }}"
                                    placeholder="10000" 
                                />
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="designate">Designate</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="designate" 
                                    class="form-control @error('designate') is-invalid @enderror" 
                                    name="designate"
                                    value="{{ old('designate') }}"
                                />
                                @error('designate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10 mt-2">
                                <button type="submit" class="btn btn-primary text-capitalize">Save expense</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection