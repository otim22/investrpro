@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <h4 class="fw-bold py-1 text-capitalize">
                <span class="text-muted fw-light">Member registration / <a href="{{ route('members.index') }}">Members</a> / </span>{{ $member->surname }}</h4>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="d-flex justify-content-between">
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                        href="{{ route('members.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to members
                    </a>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                        href="{{ route('members.edit', $member) }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bxs-edit-alt'></i>
                        Edit
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 text-capitalize">Member registration form</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="surname">Surname</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="surname"
                                    class="form-control" 
                                    name="surname"
                                    value="{{ $member->surname }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="given_name">Given name</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="given_name"
                                    class="form-control" 
                                    name="given_name"
                                    value="{{ $member->given_name }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="other_name">Other name</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="other_name"
                                    class="form-control" 
                                    name="other_name"
                                    value="{{ $member->other_name }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="date_of_birth">Date of birth</label>
                            <div class="col-sm-9">
                                <input 
                                    type="date" 
                                    id="date_of_birth"
                                    class="form-control" 
                                    name="date_of_birth"
                                    value="{{ $member->date_of_birth }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="telephone_number">Telephone number</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="telephone_number"
                                    class="form-control" 
                                    name="telephone_number"
                                    value="{{ $member->telephone_number }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="email">email</label>
                            <div class="col-sm-9">
                                <input 
                                    type="email" 
                                    id="email"
                                    class="form-control" 
                                    name="email"
                                    value="{{ $member->email }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="address">Address</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="address"
                                    class="form-control" 
                                    name="address"
                                    value="{{ $member->address }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="occupation">Occupation</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="occupation"
                                    class="form-control" 
                                    name="occupation"
                                    value="{{ $member->occupation }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="nin">National Identification Number (NIN)</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="nin"
                                    class="form-control" 
                                    name="nin"
                                    value="{{ $member->nin }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="passport_number">Passport number</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="passport_number"
                                    class="form-control" 
                                    name="passport_number"
                                    value="{{ $member->passport_number }}" 
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="passport_number">Attached document</label>
                            <div class="col-sm-9">
                                @if($member->getFirstMediaUrl("relevant_document"))
                                    <div>{{ $member->getFirstMedia("relevant_document")->name }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
