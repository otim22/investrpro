@extends('layouts.master.app')

@section('content')

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
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Profit & Loss / <a href="{{ route('liabilities.index') }}">Liabilities</a> / </span>{{ $liability->liability_name }}</h5>
                </div>
                <div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item btn-sm" href="{{ route('liabilities.edit', $liability) }}">
                                <i class='me-2 bx bxs-edit-alt'></i>
                                Edit liability
                            </a>
                            <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#confirmPremiumDeletion{{ $liability->id }}">
                                <i class='me-2 bx bx-trash'></i>
                                Delete liability
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('liabilities.destroy', $liability) }}" class="hidden" id="delete-asset-{{ $liability->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmPremiumDeletion{{ $liability->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmPremiumDeletion{{ $liability->id }}">
                                Deleting {{ $liability->liability_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure deleting {{ $liability->liability_name }}?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-asset-{{ $liability->id }}').submit();">Delete</button>
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
                                    disabled
                                />
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
                                    disabled
                                />
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
                                        value="{{ old('type', $liability->amount) }}"
                                        aria-describedby="amount"
                                        disabled
                                    />
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
                                        value="{{ old('type', $liability->financial_year) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
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