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
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Fund / <a href="{{ route('member-savings.index') }}">Monthly savings</a> / </span>{{ $memberSaving->member->surname }} {{ $memberSaving->member->given_name }}</h5>
                </div>
                <div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item btn-sm" href="{{ route('member-savings.edit', $memberSaving) }}">
                                <i class='me-2 bx bxs-edit-alt'></i>
                                Edit saving
                            </a>
                            <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#confirmSavingDeletion{{ $memberSaving->id }}">
                                <i class='me-2 bx bx-trash'></i>
                                Delete saving
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('member-savings.destroy', $memberSaving) }}" class="hidden" id="delete-saving-{{ $memberSaving->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmSavingDeletion{{ $memberSaving->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmSavingDeletion{{ $memberSaving->id }}">
                                Premium for {{ $memberSaving->member->surname }} {{ $memberSaving->member->given_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure deleting {{ $memberSaving->member->surname }} {{ $memberSaving->member->given_name }} premium?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-saving-{{ $memberSaving->id }}').submit();">Delete</button>
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
                    <form method="POST" action="{{ route('member-savings.update', $memberSaving) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="asset_name">Asset name</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="asset_name" 
                                    class="form-control @error('asset_name') is-invalid @enderror" 
                                    name="asset_name"
                                    value="{{ old('asset_name', $memberSaving->asset_name) }}"
                                    placeholder="Premiums" 
                                    disabled
                                    autofocus
                                />
                                @error('asset_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                        <option value="{{ $memberSaving->asset_type }}" selected>{{ $memberSaving->asset_type }}</option>
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
                                        value="{{ old('type', $memberSaving->financial_year) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Member names</label>
                            <div class="col-sm-10">
                                <select 
                                    id="member_id" 
                                    class="form-select @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    aria-label="Default select member"
                                    disabled
                                >
                                    @if($members)
                                        <option value="{{ $memberSaving->member->id }}" selected>{{ $memberSaving->member->surname }} {{ $memberSaving->member->given_name }}</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->surname }} {{ $member->given_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="premium">Premium amount</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="premium" 
                                    class="form-control @error('premium') is-invalid @enderror" 
                                    name="premium"
                                    value="{{ old('premium', number_format($memberSaving->premium)) }}"
                                    placeholder="100000" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="month">Month being paid for</label>
                            <div class="col-sm-10">
                                <select 
                                    id="month" 
                                    class="form-select @error('month') is-invalid @enderror" 
                                    name="month"
                                    disabled
                                    aria-label="Default select month"
                                >
                                    @if($months)
                                        <option value="{{ $memberSaving->month }}" selected>{{ $memberSaving->month }}</option>
                                        @foreach($months as $months)
                                            <option value="{{ $months->title }}">{{ $months->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_paid">Date of payment</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="date"
                                        id="date_paid"
                                        name="date_paid"
                                        value="{{ old('date_paid', date('Y-m-d')) }}"
                                        class="form-control @error('date_paid') is-invalid @enderror"
                                        placeholder="12/03/2029"
                                        aria-label="12/03/2029"
                                        aria-describedby="date_paid"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="comment">Comment</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <textarea
                                        type="text"
                                        id="comment"
                                        name="comment"
                                        class="form-control @error('comment') is-invalid @enderror"
                                        aria-describedby="comment"
                                        disabled
                                    >{{ old('comment', $memberSaving->comment) }}</textarea>
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