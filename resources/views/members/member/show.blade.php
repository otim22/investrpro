@extends('layouts.master.app')

@push('styles')
<style>
    .camel-sent {text-transform: capitalize;}
</style>
@endpush

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
                            <span class="text-muted fw-light">Membership / <a href="{{ route('members.index') }}">Registration</a>
                                / </span>{{ $member->surname }} {{ $member->given_name }}
                        </h5>
                    </div>
                    @can('show member actions')
                    <div>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item btn-sm" href="{{ route('members.edit', $member) }}">
                                    <i class='me-2 bx bxs-edit-alt'></i>
                                    Edit member
                                </a>
                                <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#confirmMemberDeletion{{ $member->id }}">
                                    <i class='me-2 bx bx-trash'></i>
                                    Delete member
                                </a>
                                <a class="dropdown-item btn-sm" href="{{ route('next-of-kin.index', $member) }}">
                                    <i class='me-2 bx bx-user'></i>
                                    Next of Kin
                                </a>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
                <form action="{{ route('members.destroy', $member) }}" class="hidden" id="delete-member-{{ $member->id }}"
                    method="POST">
                    @csrf
                    @method('delete')
                </form>
                <div class="modal fade" id="confirmMemberDeletion{{ $member->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmMemberDeletion{{ $member->id }}">
                                    {{ $member->surname }} {{ $member->given_name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        Are you sure want to delete, "{{ $member->surname }} {{ $member->given_name }}"?
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary"
                                    onclick="event.preventDefault(); document.getElementById('delete-member-{{ $member->id }}').submit();">Delete</button>
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
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="surname">Surname</label>
                            <div class="col-sm-9">
                                <input type="text" id="surname" class="form-control" name="surname"
                                    value="{{ $member->surname }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="given_name">Given name</label>
                            <div class="col-sm-9">
                                <input type="text" id="given_name" class="form-control" name="given_name"
                                    value="{{ $member->given_name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="other_name">Other name</label>
                            <div class="col-sm-9">
                                <input type="text" id="other_name" class="form-control" name="other_name"
                                    value="{{ $member->other_name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="date_of_birth">Date of birth</label>
                            <div class="col-sm-9">
                                <input type="date" id="date_of_birth" class="form-control" name="date_of_birth"
                                    value="{{ $member->date_of_birth }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="telephone_number">Telephone number</label>
                            <div class="col-sm-9">
                                <input type="text" id="telephone_number" class="form-control" name="telephone_number"
                                    value="{{ $member->telephone_number }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="email">email address</label>
                            <div class="col-sm-9">
                                <input type="email" id="email" class="form-control" name="email"
                                    value="{{ $member->email }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="address">Physical Address</label>
                            <div class="col-sm-9">
                                <input type="text" id="address" class="form-control" name="address"
                                    value="{{ $member->address }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="occupation">Occupation</label>
                            <div class="col-sm-9">
                                <input type="text" id="occupation" class="form-control" name="occupation"
                                    value="{{ $member->occupation }}" disabled />
                            </div>
                        </div>
                        @if($member->nin)
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="nin">National Identification Number
                                    (NIN)</label>
                                <div class="col-sm-9">
                                    <input type="text" id="nin" class="form-control" name="nin"
                                        value="{{ $member->nin }}" disabled />
                                </div>
                            </div>
                        @endif
                        @if($member->passport_number)
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="passport_number">Passport number</label>
                                <div class="col-sm-9">
                                    <input type="text" id="passport_number" class="form-control" name="passport_number"
                                        value="{{ $member->passport_number }}" disabled />
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="passport_number">Attachment document</label>
                            <div class="col-sm-9">
                                @if ($member->getFirstMediaUrl('relevant_document'))
                                    <div>{{ $member->getFirstMedia('relevant_document')->name }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="conscent_form">Conscent form</label>
                            <div class="col-sm-9">
                                @if ($member->getFirstMediaUrl('conscent_form'))
                                    <div>{{ $member->getFirstMedia('conscent_form')->name }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
