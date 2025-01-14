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
            @include('messages.flash')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-between">
                <div> 
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Expenses / <a href="{{ route('expenses.index') }}">List of expenses / </a> </span>{{ $expense->expense_name }}</h5>
                </div>
                @can('show expense actions')
                <div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item btn-sm" href="{{ route('expenses.edit', $expense) }}">
                                <i class='me-2 bx bxs-edit-alt'></i>
                                Edit expense
                            </a>
                            <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#confirmPremiumDeletion{{ $expense->id }}">
                                <i class='me-2 bx bx-trash'></i>
                                Delete expense
                            </a>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
            <form action="{{ route('expenses.destroy', $expense) }}" class="hidden" id="delete-month-{{ $expense->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmPremiumDeletion{{ $expense->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmPremiumDeletion{{ $expense->id }}">
                                Expense on the date of {{ $expense->expense_name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure deleting expense for the date of {{ $expense->expense_name }}?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-month-{{ $expense->id }}').submit();">Delete</button>
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
                    <form method="POST" action="{{ route('expenses.update', $expense) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="expense_name">Expense name</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="expense_name" 
                                    class="form-control @error('expense_name') is-invalid @enderror" 
                                    name="expense_name"
                                    value="{{ old('expense_name', $expense->expense_name) }}"
                                    placeholder="Expenses" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="expense_type">Expense type</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="expense_type" 
                                    class="form-control @error('expense_type') is-invalid @enderror" 
                                    name="expense_type"
                                    value="{{ old('expense_type', $expense->expense_type) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="financial_year">Financial year</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        id="financial_year"
                                        name="financial_year"
                                        class="form-control @error('financial_year') is-invalid @enderror"
                                        placeholder="FY22/23"
                                        aria-label="FY22/23"
                                        aria-describedby="financial_year"
                                        value="{{ old('type', $expense->financial_year) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="date_of_expense">Date of expense</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="date_of_expense" 
                                    class="form-control @error('date_of_expense') is-invalid @enderror" 
                                    name="date_of_expense"
                                    value="{{ old('date_of_expense', date('Y-m-d')) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="details">Details</label>
                            <div class="col-sm-9">
                                <textarea 
                                    type="text" 
                                    id="details" 
                                    class="form-control @error('details') is-invalid @enderror" 
                                    name="details"
                                    value=""
                                    disabled
                                >{{ old('details', $expense->details) }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="rate">Rate</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="rate"
                                        name="rate"
                                        value="{{ old('rate', $expense->rate) }}"
                                        class="form-control @error('rate') is-invalid @enderror"
                                        aria-describedby="rate"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="amount">Amount</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        id="amount"
                                        name="amount"
                                        value="{{ old('amount', $expense->amount) }}"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        aria-describedby="amount"
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