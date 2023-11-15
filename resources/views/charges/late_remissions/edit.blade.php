@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Late remissions / <a href="{{ route('late-remissions.index') }}">List of late remissions</a> / </span>Late remissions form</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('late-remissions.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to late remissions
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('late-remissions.update', $lateRemission) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="member_id">Member names</label>
                            <div class="col-sm-10">
                                <select 
                                    id="member_id" 
                                    class="form-select @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    aria-label="Default select member"
                                    autofocus
                                >
                                    @if($members)
                                        <option value="{{ $lateRemission->member->id }}" selected>{{ $lateRemission->member->surname }} {{ $lateRemission->member->given_name }}</option>
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
                            <label class="col-sm-2 col-form-label" for="charge_paid_for">Charge being paid for</label>
                            <div class="col-sm-10">
                                <select 
                                    id="charge_paid_for" 
                                    class="form-select @error('charge_paid_for') is-invalid @enderror" 
                                    name="charge_paid_for"
                                    aria-label="Default select charge"
                                    autofocus
                                >
                                    @if($chargeSettings)
                                        <option value="{{ $lateRemission->charge_paid_for}}" selected>{{ $lateRemission->charge_paid_for}}</option>
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
                            <label class="col-sm-2 col-form-label" for="charge_amount">Charge amount</label>
                            <div class="col-sm-10">
                                <select 
                                    id="charge_amount" 
                                    class="form-select @error('charge_amount') is-invalid @enderror" 
                                    name="charge_amount"
                                    aria-label="Default select amount"
                                    autofocus
                                >
                                    @if($chargeSettings)
                                        <option value="{{ $lateRemission->charge_amount}}" selected>{{ number_format($lateRemission->charge_amount) }}</option>
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
                            <label class="col-sm-2 col-form-label" for="month_paid_for">Month paid for</label>
                            <div class="col-sm-10">
                                <select 
                                    id="month_paid_for" 
                                    class="form-select @error('month_paid_for') is-invalid @enderror" 
                                    name="month_paid_for"
                                    aria-label="Default select month"
                                    autofocus
                                >
                                    @if($months)
                                        <option value="{{ $lateRemission->month_paid_for}}" selected>{{ $lateRemission->month_paid_for }}</option>
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
                                        value="{{ old('date_of_payment', date('Y-m-d')) }}"
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
                                    >{{ old('comment', $lateRemission->comment) }}</textarea>
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
                                <button type="submit" class="btn btn-primary">Update late remission</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection