@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 mb-2 order-md-3 order-lg-2">
                <div class="d-flex justify-content-between">
                    <h4 class="fw-bold py-1 text-capitalize">
                        <span class="text-muted fw-light">Members / <a
                                href="{{ route('member-registration.show', $member) }}">{{ $member->surname }} {{ $member->given_name }}</a>
                            / Next of kin / </span>{{ $member->nextOfKin->surname }} {{ $member->nextOfKin->given_name }}
                    </h4>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                            href="{{ route('member-registration.show', $member) }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-arrow-back'></i>
                            Back to {{ $member->surname }} 
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 text-capitalize">Next of kin form</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('next-of-kin.update', [$member, $member->nextOfKin]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="surname">Surname</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="surname"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ $member->nextOfKin->surname }}" 
                                        required 
                                    />
                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="given_name">Given name</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="given_name"
                                        class="form-control @error('given_name') is-invalid @enderror" name="given_name"
                                        value="{{ $member->nextOfKin->given_name }}" 
                                        required 
                                    />
                                    @error('given_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="other_name">Other name</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="other_name"
                                        class="form-control @error('other_name') is-invalid @enderror" name="other_name"
                                        value="{{ $member->nextOfKin->other_name }}" 
                                    />
                                    @error('other_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="relationship">Relationship</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="relationship"
                                        class="form-control @error('relationship') is-invalid @enderror" name="relationship"
                                        value="{{ $member->nextOfKin->relationship }}" 
                                        required 
                                    />
                                    @error('relationship')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="telephone_number">Telephone number</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="telephone_number"
                                        class="form-control @error('telephone_number') is-invalid @enderror" name="telephone_number"
                                        value="{{ $member->nextOfKin->telephone_number }}" 
                                        required 
                                    />
                                    @error('telephone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="email">email</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="email" 
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $member->nextOfKin->email }}" 
                                        required 
                                    />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="address">Address</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="address"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ $member->nextOfKin->address }}" 
                                        required 
                                    />
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="nin">National Identification Number (NIN)</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="nin"
                                        class="form-control @error('nin') is-invalid @enderror" name="nin"
                                        value="{{ $member->nextOfKin->nin }}" 
                                    />
                                    @error('nin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="passport_number">Passport number</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="passport_number"
                                        class="form-control @error('passport_number') is-invalid @enderror" name="passport_number"
                                        value="{{ $member->nextOfKin->passport_number }}" 
                                    />
                                    @error('passport_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="relevant_document">Attach NIN or Passport</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="file" 
                                            class="form-control" 
                                            id="relevant_document"
                                            name="relevant_document" 
                                            accept=".doc,.docx,.pdf" 
                                        />
                                        <label class="input-group-text" for="relevant_document">Upload</label>
                                    </div>
                                    <div class="mt-2">
                                        <label for="relevant_document"><small class="text-muted">Current document (* Uploading document overrides current one)</small> </label>
                                        @if($member->nextOfKin->getFirstMediaUrl("relevant_document"))
                                            <div>{{ $member->nextOfKin->getFirstMedia("relevant_document")->name }}</div>
                                        @endif
                                    </div>
                                    @error('relevant_document')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-9 mt-2">
                                    <button type="submit" class="btn btn-primary text-capitalize">Update next of kin</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection