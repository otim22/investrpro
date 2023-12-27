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
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Assets / <a href="{{ route('assets.index') }}">Assets</a> / </span>{{ $asset->member->surname }} {{ $asset->member->given_name }}</h5>
                </div>
                <div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item btn-sm" href="{{ route('assets.edit', $asset) }}">
                                <i class='me-2 bx bxs-edit-alt'></i>
                                Edit asset
                            </a>
                            <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#confirmAssetDeletion{{ $asset->id }}">
                                <i class='me-2 bx bx-trash'></i>
                                Delete asset
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('assets.destroy', $asset) }}" class="hidden" id="delete-saving-{{ $asset->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmAssetDeletion{{ $asset->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmAssetDeletion{{ $asset->id }}">
                                Asset for {{ $asset->member->surname }} {{ $asset->member->given_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure deleting {{ $asset->member->surname }} {{ $asset->member->given_name }} asset?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-saving-{{ $asset->id }}').submit();">Delete</button>
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
                    <form method="POST" action="{{ route('assets.update', $asset) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="basic-default-name">Member's name</label>
                            <div class="col-sm-10">
                                <select 
                                    id="member_id" 
                                    class="form-select @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    aria-label="Default select member"
                                    disabled
                                >
                                    @if($members)
                                        <option value="{{ $asset->member->id }}" selected>{{ $asset->member->surname }} {{ $asset->member->given_name }}</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->surname }} {{ $member->given_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="asset">Asset name</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="asset" 
                                    class="form-control @error('asset') is-invalid @enderror" 
                                    name="asset"
                                    value="{{ old('asset', $asset->asset) }}"
                                    placeholder="Assets" 
                                    disabled
                                />
                                @error('asset')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="asset_type">Asset type</label>
                            <div class="col-sm-10">
                                <select 
                                    id="asset_type" 
                                    class="form-select @error('asset_type') is-invalid @enderror" 
                                    name="asset_type"
                                    aria-label="Default select asset type"
                                    disabled
                                >
                                    @if($assetTypes)
                                        <option value="{{ $asset->asset_type }}" selected>{{ $asset->asset_type }}</option>
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
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="financial_year">Financial year</label>
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
                                        value="{{ old('type', $asset->financial_year) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="amount">Amount</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="amount" 
                                    class="form-control @error('amount') is-invalid @enderror" 
                                    name="amount"
                                    value="{{ old('amount', number_format($asset->amount)) }}"
                                    placeholder="100000" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="date_paid">Date of payment</label>
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
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="has_paid">Status</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <select 
                                    id="has_paid" 
                                    class="form-select @error('has_paid') is-invalid @enderror" 
                                    name="has_paid"
                                    aria-label="Default select asset type"
                                    disabled
                                >
                                    @if($assetTypes)
                                        @if ($asset->has_paid)
                                            <option value="{{ $asset->has_paid }}" selected>Paid</option>
                                        @else 
                                            <option value="{{ $asset->has_paid }}" selected>Not paid</option>
                                        @endif
                                    @endif
                                </select>
                                @error('has_paid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="comment">Comment</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <textarea
                                        type="text"
                                        id="comment"
                                        name="comment"
                                        class="form-control @error('comment') is-invalid @enderror"
                                        aria-describedby="comment"
                                        disabled
                                    >{{ old('comment', $asset->comment) }}</textarea>
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