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
                <h4 class="fw-bold text-capitalize"><span class="text-muted fw-light">Charges / <a href="{{ route('late-remissions.index') }}">All Charges</a> / </span>{{ $lateRemission->charge_paid_for }}</h4>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                        href="{{ route('late-remissions.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to charges
                    </a>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item btn-sm" href="{{ route('late-remissions.edit', $lateRemission) }}">
                            <i class='me-2 bx bxs-edit-alt'></i>
                            Edit charge
                        </a>
                        <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#confirmChargeDeletion{{ $lateRemission->id }}">
                            <i class='me-2 bx bx-trash'></i>
                            Delete charge
                        </a>
                    </div>
                </div>
            </div>
            <form action="{{ route('late-remissions.destroy', $lateRemission) }}" class="hidden" id="delete-charge-{{ $lateRemission->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmChargeDeletion{{ $lateRemission->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmChargeDeletion{{ $lateRemission->id }}">
                                Charge for {{ $lateRemission->charge_paid_for }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure to delete, {{ $lateRemission->charge_paid_for }}?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-charge-{{ $lateRemission->id }}').submit();">Delete</button>
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
                    <form method="POST" action="{{ route('late-remissions.update', $lateRemission) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="member_id">Member names</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="member_id" 
                                    class="form-control @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    value="{{ old('member_id', $lateRemission->member->surname . ' ' . $lateRemission->member->given_name) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="charge_paid_for">Charge being paid for</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input 
                                        type="text" 
                                        id="charge_paid_for" 
                                        class="form-control @error('charge_paid_for') is-invalid @enderror" 
                                        name="charge_paid_for"
                                        value="{{ old('charge_paid_for', $lateRemission->charge_paid_for) }}"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="charge_amount">Charge Amount</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="charge_amount" 
                                    class="form-control @error('charge_amount') is-invalid @enderror" 
                                    name="charge_amount"
                                    value="{{ old('charge_amount', number_format($lateRemission->charge_amount, 2)) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="month_paid_for">Charge Month</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="month_paid_for" 
                                    class="form-control @error('month_paid_for') is-invalid @enderror" 
                                    name="month_paid_for"
                                    value="{{ old('month_paid_for', $lateRemission->month_paid_for) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date_of_payment">Date of payment</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="date_of_payment" 
                                    class="form-control @error('date_of_payment') is-invalid @enderror" 
                                    name="date_of_payment"
                                    value="{{ old('date_of_payment', $lateRemission->formatDate($lateRemission->date_of_payment)) }}"
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
                                >{{ old('comment', $lateRemission->comment) }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection