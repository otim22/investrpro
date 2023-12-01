@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Expenses / </span>{{ $expense->formatDate($expense->date_of_expense) }}</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('expenses.create') }}" aria-haspopup="true" aria-expanded="false">
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
                    <form method="POST" action="{{ route('expenses.update', $expense) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_of_expense">Date of expense</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="date"
                                        id="date_of_expense"
                                        name="date_of_expense"
                                        value="{{ old('date_of_expense', date('Y-m-d')) }}"
                                        class="form-control @error('date_of_expense') is-invalid @enderror"
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
                                >{{ old('details', $expense->details) }}</textarea>
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
                                    value="{{ old('rate', $expense->rate) }}"
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
                                    value="{{ old('amount', $expense->amount) }}"
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
                                    value="{{ old('designate', $expense->designate) }}"
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
                                <button type="submit" class="btn btn-primary">Update expense</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection