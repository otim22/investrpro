@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 mb-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h4 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Member savings / <a href="{{ route('member-savings.index') }}">Monthly premiums</a> / </span>{{ $memberSaving->member->surname }} {{ $memberSaving->member->given_name }}</h4>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                        href="{{ route('member-savings.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to premiums
                    </a>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item btn-sm" href="{{ route('member-savings.edit', $memberSaving) }}">
                            <i class='me-2 bx bxs-edit-alt'></i>
                            Edit premium
                        </a>
                        <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#confirmPremiumDeletion{{ $memberSaving->id }}">
                            <i class='me-2 bx bx-trash'></i>
                            Delete premium
                        </a>
                    </div>
                </div>
            </div>
            <form action="{{ route('member-savings.destroy', $memberSaving) }}" class="hidden" id="delete-month-{{ $memberSaving->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmPremiumDeletion{{ $memberSaving->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmPremiumDeletion{{ $memberSaving->id }}">
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
                                onclick="event.preventDefault(); document.getElementById('delete-month-{{ $memberSaving->id }}').submit();">Delete</button>
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
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Member</label>
                            <div class="col-sm-10">
                                <select 
                                    id="member_id" 
                                    class="form-select @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    aria-label="Default select member"
                                    autofocus
                                    disabled
                                >
                                    @if($members)
                                        <option value="{{ $memberSaving->member->id }}" selected>{{ $memberSaving->member->surname }} {{ $memberSaving->member->given_name }}</option>
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
                            <label class="col-sm-2 col-form-label" for="premium">Premium</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="premium" 
                                    class="form-control @error('premium') is-invalid @enderror" 
                                    name="premium"
                                    value="{{ old('premium', number_format($memberSaving->premium, 2)) }}"
                                    placeholder="100000" 
                                    disabled
                                />
                                @error('premium')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="month">Month</label>
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
                                @error('month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_paid">Date</label>
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
                                    @error('date_paid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10 mt-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection