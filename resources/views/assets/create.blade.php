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
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Assets / <a href="{{ route('assets.index') }}">Assets</a> / </span>New form</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('assets.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to assets
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('assets.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="member_id">Member's name</label>
                            <div class="col-sm-9">
                                <select 
                                    id="member_id" 
                                    class="form-select @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    aria-label="Default select member"
                                    autofocus
                                    required
                                >
                                    <option selected>Select member</option>
                                    @if($members)
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->surname }} {{ $member->given_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('member_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="asset">Asset name</label>
                            <div class="col-sm-9">
                                <select 
                                    id="asset" 
                                    class="form-select @error('asset') is-invalid @enderror" 
                                    name="asset"
                                    aria-label="Default select charge"
                                    required
                                >
                                    <option value="" selected>Select asset</option>
                                    @if($chargeSettings)
                                        @foreach($chargeSettings as $chargeSetting)
                                            <option value="{{ $chargeSetting->title }}">{{ $chargeSetting->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('asset')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="asset_type">Asset type</label>
                            <div class="col-sm-9">
                                <select 
                                    id="asset_type" 
                                    class="form-select @error('asset_type') is-invalid @enderror" 
                                    name="asset_type"
                                    aria-label="Default select asset type"
                                    required
                                >
                                    <option value="" selected>Select type</option>
                                    @if($assetTypes)
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
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="amount">Amount</label>
                            <div class="col-sm-9">
                                <input 
                                    type="number" 
                                    id="amount" 
                                    class="form-control @error('amount') is-invalid @enderror" 
                                    name="amount"
                                    value="{{ old('amount') }}"
                                    placeholder="100000" 
                                />
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="date_paid">Date of payment</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="date"
                                        id="date_paid"
                                        name="date_paid"
                                        class="form-control @error('date_paid') is-invalid @enderror"
                                        placeholder="12/03/2029"
                                        aria-label="12/03/2029"
                                        aria-describedby="date_paid"
                                    />
                                    @error('date_paid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="has_paid">Payment Status</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <select 
                                        id="has_paid" 
                                        class="form-select @error('has_paid') is-invalid @enderror" 
                                        name="has_paid"
                                        aria-label="Default select month"
                                    >
                                        <option selected>Select option</option>
                                        <option value="0">No, has not paid</option>
                                        <option value="1">Yes, has paid</option>
                                </select>
                                    @error('has_paid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="comment">Comment</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <textarea
                                        type="text"
                                        id="comment"
                                        name="comment"
                                        rows="3"
                                        class="form-control @error('comment') is-invalid @enderror"
                                        aria-describedby="comment"
                                    >{{ old('comment')}}</textarea>
                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-9 mt-2">
                                <button type="submit" class="btn btn-primary text-capitalize">Save asset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection