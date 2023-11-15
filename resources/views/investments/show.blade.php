@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h4 class="fw-bold text-capitalize"><span class="text-muted fw-light">investments / <a href="{{ route('investments.index') }}">List of investments </a> / </span>{{ $investment->investment_type }}</h4>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                        href="{{ route('investments.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to investments
                    </a>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item btn-sm" href="{{ route('investments.edit', $investment) }}">
                            <i class='me-2 bx bxs-edit-alt'></i>
                            Edit investment
                        </a>
                        <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#confirmPremiumDeletion{{ $investment->id }}">
                            <i class='me-2 bx bx-trash'></i>
                            Delete investment
                        </a>
                    </div>
                </div>
            </div>
            <form action="{{ route('investments.destroy', $investment) }}" class="hidden" id="delete-month-{{ $investment->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmPremiumDeletion{{ $investment->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmPremiumDeletion{{ $investment->id }}">
                                {{ $investment->investment_type }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure deleting {{ $investment->investment_type }} investment?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-month-{{ $investment->id }}').submit();">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('investments.update', $investment) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="investment_type">Investment type</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="investment_type" 
                                    class="form-control @error('investment_type') is-invalid @enderror" 
                                    name="investment_type"
                                    value="{{ old('investment_type', $investment->investment_type) }}"
                                    placeholder="T-Bond" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_of_investment">Date of investment</label>
                            <div class="col-sm-10">
                                <input 
                                    type="date" 
                                    id="date_of_investment" 
                                    class="form-control @error('date_of_investment') is-invalid @enderror" 
                                    name="date_of_investment"
                                    value="{{ old('date_of_investment', date('Y-m-d')) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="duration">Duration</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="duration"
                                        name="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        placeholder="3"
                                        aria-describedby="duration"
                                        value="{{ old('duration', $investment->duration) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="interest_rate">Interest rate</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="interest_rate"
                                        name="interest_rate"
                                        class="form-control @error('interest_rate') is-invalid @enderror"
                                        placeholder="0.03"
                                        aria-describedby="interest_rate"
                                        value="{{ old('interest_rate', $investment->interest_rate) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="amount_invested">Amount invested</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="amount_invested"
                                        name="amount_invested"
                                        class="form-control @error('amount_invested') is-invalid @enderror"
                                        placeholder="100000"
                                        aria-describedby="amount_invested"
                                        value="{{ old('amount_invested', $investment->amount_invested) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_of_maturity">Date of maturity</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="date"
                                        id="date_of_maturity"
                                        name="date_of_maturity"
                                        class="form-control @error('date_of_maturity') is-invalid @enderror"
                                        placeholder="100000"
                                        aria-describedby="date_of_maturity"
                                        value="{{ old('date_of_maturity', date('Y-m-d')) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="expected_return_before_tax">Expected return before tax</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="expected_return_before_tax"
                                        name="expected_return_before_tax"
                                        class="form-control @error('expected_return_before_tax') is-invalid @enderror"
                                        placeholder="0.015"
                                        aria-describedby="expected_return_before_tax"
                                        value="{{ old('expected_return_before_tax', $investment->expected_return_before_tax) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="expected_return_after_tax">Expected return after tax</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="expected_return_after_tax"
                                        name="expected_return_after_tax"
                                        class="form-control @error('expected_return_after_tax') is-invalid @enderror"
                                        placeholder="0.013"
                                        aria-describedby="expected_return_after_tax"
                                        value="{{ old('expected_return_after_tax', $investment->expected_return_after_tax) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="interest_recieved_and_reinvested">Interest recieved & reinvested</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="interest_recieved_and_reinvested"
                                        name="interest_recieved_and_reinvested"
                                        class="form-control @error('interest_recieved_and_reinvested') is-invalid @enderror"
                                        placeholder="0.01"
                                        aria-describedby="interest_recieved_and_reinvested"
                                        value="{{ old('interest_recieved_and_reinvested', $investment->interest_recieved_and_reinvested) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection