@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Membership fees / <a href="{{ route('membership-fees.index') }}">Yearly membership fee</a> / </span>{{ $membershipFee->member->surname }} {{ $membershipFee->member->given_name }}</h5>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                        href="{{ route('membership-fees.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to membership fees
                    </a>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item btn-sm" href="{{ route('membership-fees.edit', $membershipFee) }}">
                            <i class='me-2 bx bxs-edit-alt'></i>
                            Edit fee
                        </a>
                        <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#confirmPremiumDeletion{{ $membershipFee->id }}">
                            <i class='me-2 bx bx-trash'></i>
                            Delete fee
                        </a>
                    </div>
                </div>
            </div>
            <form action="{{ route('membership-fees.destroy', $membershipFee) }}" class="hidden" id="delete-month-{{ $membershipFee->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmPremiumDeletion{{ $membershipFee->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmPremiumDeletion{{ $membershipFee->id }}">
                                Membership fee for {{ $membershipFee->member->surname }} {{ $membershipFee->member->given_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure deleting {{ $membershipFee->member->surname }} {{ $membershipFee->member->given_name }} membership fee?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-month-{{ $membershipFee->id }}').submit();">Delete</button>
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
                    <form method="POST" action="{{ route('membership-fees.update', $membershipFee) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

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
                                        <option value="{{ $membershipFee->member->id }}" selected>{{ $membershipFee->member->surname }} {{ $membershipFee->member->given_name }}</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->surname }} {{ $member->given_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="fee_amount">Fee amount</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="fee_amount" 
                                    class="form-control @error('fee_amount') is-invalid @enderror" 
                                    name="fee_amount"
                                    value="{{ old('fee_amount', number_format($membershipFee->fee_amount)) }}"
                                    placeholder="100000" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="year_paid_for">Year being paid for</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="year_paid_for" 
                                    class="form-control @error('year_paid_for') is-invalid @enderror" 
                                    name="year_paid_for"
                                    value="{{ old('year_paid_for', $membershipFee->year_paid_for) }}"
                                    disabled
                                />
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
                                        value="{{ old('date_of_payment', date('Y-m-d')) }}"
                                        class="form-control @error('date_of_payment') is-invalid @enderror"
                                        placeholder="12/03/2029"
                                        aria-label="12/03/2029"
                                        aria-describedby="date_of_payment"
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
                                    >{{ old('comment', $membershipFee->comment) }}</textarea>
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