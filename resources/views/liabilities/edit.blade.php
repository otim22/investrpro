@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h4 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Liabilities / <a href="{{ route('liabilities.index') }}">List of liabilities</a> / </span>{{ $liability->liability_name }}</h4>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('liabilities.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to liabilities
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('liabilities.update', $liability) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="liability_name">Asset name</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="liability_name" 
                                    class="form-control @error('liability_name') is-invalid @enderror" 
                                    name="liability_name"
                                    value="{{ old('liability_name', $liability->liability_name) }}"
                                    placeholder="Premiums" 
                                />
                                @error('liability_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="liability_type">Asset type</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="liability_type" 
                                    class="form-control @error('liability_type') is-invalid @enderror" 
                                    name="liability_type"
                                    value="{{ old('liability_type', $liability->liability_type) }}"
                                    placeholder="Current assets" 
                                />
                                @error('liability_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="amount">Amount</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="amount"
                                        name="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        placeholder="100000"
                                        aria-label="100000"
                                        aria-describedby="amount"
                                        value="{{ old('amount', $liability->amount) }}"
                                    />
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="financial_year">Financial year</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        id="financial_year"
                                        name="financial_year"
                                        class="form-control @error('financial_year') is-invalid @enderror"
                                        placeholder="FY22/23"
                                        aria-label="FY22/23"
                                        aria-describedby="financial_year"
                                        value="{{ old('financial_year', $liability->financial_year) }}"
                                    />
                                    @error('financial_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_acquired">Date acquired</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="date"
                                        id="date_acquired"
                                        name="date_acquired"
                                        class="form-control @error('date_acquired') is-invalid @enderror"
                                        placeholder="12/03/2029"
                                        aria-label="12/03/2029"
                                        aria-describedby="date_acquired"
                                        value="{{ old('date_acquired', date('Y-m-d')) }}"
                                    />
                                    @error('date_acquired')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10 mt-2">
                                <button type="submit" class="btn btn-primary">Update liability</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection