@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 mb-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h4 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Member savings / <a href="{{ route('member-savings.index') }}">Monthly premiums</a> / </span>Collection form</h4>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('member-savings.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to premiums
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('member-savings.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Member names</label>
                            <div class="col-sm-10">
                                <select 
                                    id="member_id" 
                                    class="form-select @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    aria-label="Default select member"
                                    autofocus
                                >
                                    @if($members)
                                        <option selected>Select member</option>
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
                            <label class="col-sm-2 col-form-label" for="premium">Premium amount</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="premium" 
                                    class="form-control @error('premium') is-invalid @enderror" 
                                    name="premium"
                                    value="{{ old('premium') }}"
                                    placeholder="100000" 
                                />
                                @error('premium')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="month">Month being paid for</label>
                            <div class="col-sm-10">
                                <select 
                                    id="month" 
                                    class="form-select @error('month') is-invalid @enderror" 
                                    name="month"
                                    aria-label="Default select month"
                                >
                                    @if($months)
                                        <option selected>Select month</option>
                                        @foreach($months as $months)
                                            <option value="{{ $months->title }}">{{ $months->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                <button type="submit" class="btn btn-primary">Save premium</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection