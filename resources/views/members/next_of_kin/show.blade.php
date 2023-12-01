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
                        <h5 class="fw-bold py-1 text-capitalize">
                            <span class="text-muted fw-light">Members / <a
                                    href="{{ route('members.show', $member) }}">{{ $member->surname }} {{ $member->given_name }}</a>
                                / Next of kin / </span>{{ $member->nextOfKin->surname }} {{ $member->nextOfKin->given_name }}
                        </h5>
                    </div>
                    <div>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item text-capitalize btn-sm"
                                    href="{{ route('next-of-kin.edit', [$member, $member->nextOfKin]) }}">
                                    <i class='me-2 bx bxs-edit-alt'></i>
                                    Edit next of kin
                                </a>
                                <a class="dropdown-item text-capitalize btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#confirmmemberDeletion{{ $member->nextOfKin->id }}">
                                    <i class='me-2 bx bx-trash'></i>
                                    Delete next of kin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('next-of-kin.delete', [$member, $member->nextOfKin]) }}" class="hidden"
                    id="delete-member-{{ $member->nextOfKin->id }}" method="POST">
                    @csrf
                    @method('delete')
                </form>
                <div class="modal fade" id="confirmmemberDeletion{{ $member->nextOfKin->id }}" tabindex="-1"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmmemberDeletion{{ $member->nextOfKin->id }}">
                                    {{ $member->nextOfKin->surname }} {{ $member->nextOfKin->given_name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        Are you sure want to delete, "{{ $member->nextOfKin->surname }}
                                        {{ $member->nextOfKin->given_name }}"?
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary"
                                    onclick="event.preventDefault(); document.getElementById('delete-member-{{ $member->nextOfKin->id }}').submit();">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="surname">Surname</label>
                            <div class="col-sm-9">
                                <input type="text" id="surname" class="form-control" name="surname"
                                    value="{{ $member->nextOfKin->surname }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="given_name">Given name</label>
                            <div class="col-sm-9">
                                <input type="text" id="given_name" class="form-control" name="given_name"
                                    value="{{ $member->nextOfKin->given_name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="other_name">Other name</label>
                            <div class="col-sm-9">
                                <input type="text" id="other_name" class="form-control" name="other_name"
                                    value="{{ $member->nextOfKin->other_name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="relationship">Relationship</label>
                            <div class="col-sm-9">
                                <input type="text" id="relationship" class="form-control" name="relationship"
                                    value="{{ $member->nextOfKin->relationship }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="telephone_number">Telephone number</label>
                            <div class="col-sm-9">
                                <input type="text" id="telephone_number" class="form-control" name="telephone_number"
                                    value="{{ $member->nextOfKin->telephone_number }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="email">email</label>
                            <div class="col-sm-9">
                                <input type="email" id="email" class="form-control" name="email"
                                    value="{{ $member->nextOfKin->email }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="address">Address</label>
                            <div class="col-sm-9">
                                <input type="text" id="address" class="form-control" name="address"
                                    value="{{ $member->nextOfKin->address }}" disabled />
                            </div>
                        </div>
                        @if ($member->nextOfKin->nin)
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="nin">National Identification Number
                                    (NIN)</label>
                                <div class="col-sm-9">
                                    <input type="text" id="nin" class="form-control" name="nin"
                                        value="{{ $member->nextOfKin->nin }}" disabled />
                                </div>
                            </div>
                        @endif
                        @if ($member->nextOfKin->passport_number)
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="passport_number">Passport number</label>
                                <div class="col-sm-9">
                                    <input type="text" id="passport_number" class="form-control"
                                        name="passport_number" value="{{ $member->nextOfKin->passport_number }}"
                                        disabled />
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <label class="col-sm-3 col-form-label" for="passport_number">Attached document</label>
                            <div class="col-sm-9">
                                @if ($member->nextOfKin->getFirstMediaUrl('relevant_document'))
                                    <div>{{ $member->nextOfKin->getFirstMedia('relevant_document')->name }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
