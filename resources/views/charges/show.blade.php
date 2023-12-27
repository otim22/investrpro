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
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Assets / <a href="{{ route('charges.index') }}">charges</a> / </span>{{ $charge->member->surname }} {{ $charge->member->given_name }}</h5>
                </div>
                <div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item btn-sm" href="{{ route('charges.edit', $charge) }}">
                                <i class='me-2 bx bxs-edit-alt'></i>
                                Edit charges
                            </a>
                            <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#confirmLateRemissionDeletion{{ $charge->id }}">
                                <i class='me-2 bx bx-trash'></i>
                                Delete charges
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('charges.destroy', $charge) }}" class="hidden" id="delete-late-remission-{{ $charge->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmLateRemissionDeletion{{ $charge->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmLateRemissionDeletion{{ $charge->id }}">
                                Charge for {{ $charge->charge }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure deleting {{ $charge->charge }}?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-late-remission-{{ $charge->id }}').submit();">Delete</button>
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
                    <form method="POST" action="{{ route('charges.update', $charge) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="member_id">Member's name</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="member_id" 
                                    class="form-control @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    value="{{ old('member_id', $charge->member->surname . ' ' . $charge->member->given_name) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="charge">Asset name</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input 
                                        type="text" 
                                        id="charge" 
                                        class="form-control @error('charge') is-invalid @enderror" 
                                        name="charge"
                                        value="{{ old('charge', $charge->charge) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="asset_type">Asset type</label>
                            <div class="col-sm-10">
                                <select 
                                    id="asset_type" 
                                    class="form-select @error('asset_type') is-invalid @enderror" 
                                    name="asset_type"
                                    aria-label="Default select asset type"
                                    disabled
                                >
                                    @if($assetTypes)
                                        <option value="{{ $charge->asset_type }}" selected>{{ $charge->asset_type }}</option>
                                        @foreach($assetTypes as $assetType)
                                            <option value="{{ $assetType->asset_type }}">{{ $assetType->asset_type }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('asset_type')
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
                                    <input
                                        type="text"
                                        id="financial_year"
                                        name="financial_year"
                                        class="form-control @error('financial_year') is-invalid @enderror"
                                        placeholder="FY22/23"
                                        aria-label="FY22/23"
                                        aria-describedby="financial_year"
                                        value="{{ old('type', $charge->financial_year) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="charge">Charge being paid for</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input 
                                        type="text" 
                                        id="charge" 
                                        class="form-control @error('charge') is-invalid @enderror" 
                                        name="charge"
                                        value="{{ old('charge', $charge->charge) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="amount">Charge Amount</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="amount" 
                                    class="form-control @error('amount') is-invalid @enderror" 
                                    name="amount"
                                    value="{{ old('amount', number_format($charge->amount)) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="month">Month (Being paid for)</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="month" 
                                    class="form-control @error('month') is-invalid @enderror" 
                                    name="month"
                                    value="{{ old('month', $charge->month) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_paid">Date of payment</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="date_paid" 
                                    class="form-control @error('date_paid') is-invalid @enderror" 
                                    name="date_paid"
                                    value="{{ old('date_paid', $charge->formatDate($charge->date_paid)) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="comment">Comment</label>
                            <div class="col-sm-10">
                                <textarea 
                                    type="text" 
                                    id="comment" 
                                    rows="s"
                                    class="form-control @error('comment') is-invalid @enderror" 
                                    name="comment"
                                    disabled
                                >{{ old('comment', $charge->comment) }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection