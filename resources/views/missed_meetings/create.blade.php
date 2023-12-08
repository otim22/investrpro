@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Assets / <a href="{{ route('missed-meetings.index') }}">Missed meetings</a> / </span>missed meeting form</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('missed-meetings.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to missed meeting
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('missed-meetings.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="charge_paid_for">Asset name</label>
                            <div class="col-sm-10">
                                <select 
                                    id="charge_paid_for" 
                                    class="form-select @error('charge_paid_for') is-invalid @enderror" 
                                    name="charge_paid_for"
                                    aria-label="Default select charge"
                                    autofocus
                                    required
                                >
                                    @if($chargeSettings)
                                        @foreach($chargeSettings as $chargeSetting)
                                            <option value="{{ $chargeSetting->title }}">{{ $chargeSetting->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('charge_paid_for')
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
                                >
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
                            <label class="col-sm-2 col-form-label" for="member_id">Member names</label>
                            <div class="col-sm-10">
                                <select 
                                    id="member_id" 
                                    class="form-select @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    aria-label="Default select member"
                                    required
                                >
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
                            <label class="col-sm-2 col-form-label" for="charge_amount">Charge amount</label>
                            <div class="col-sm-10">
                                <select 
                                    id="charge_amount" 
                                    class="form-select @error('charge_amount') is-invalid @enderror" 
                                    name="charge_amount"
                                    aria-label="Default select amount"
                                    required
                                >
                                    @if($chargeSettings)
                                        @foreach($chargeSettings as $chargeSetting)
                                            <option value="{{ $chargeSetting->amount }}">{{ number_format($chargeSetting->amount) }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('charge_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="month_paid_for">Month being paid for</label>
                            <div class="col-sm-10">
                                <select 
                                    id="month_paid_for" 
                                    class="form-select @error('month_paid_for') is-invalid @enderror" 
                                    name="month_paid_for"
                                    aria-label="Default select month"
                                    required
                                >
                                    @if($months)
                                        @foreach($months as $month)
                                            <option value="{{ $month->title }}">{{ $month->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('month_paid_for')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_of_payment">Date of payment</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="date"
                                        id="date_of_payment"
                                        name="date_of_payment"
                                        class="form-control @error('date_of_payment') is-invalid @enderror"
                                        placeholder="12/03/2029"
                                        aria-label="12/03/2029"
                                        aria-describedby="date_of_payment"
                                    />
                                    @error('date_of_payment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="comment">Comment</label>
                            <div class="col-sm-10">
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
                            <div class="col-sm-10 mt-2">
                                <button type="submit" class="btn btn-primary text-capitalize">Create missed meeting</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection