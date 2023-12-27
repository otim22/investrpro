@extends('layouts.master.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        .camel-sent {text-transform: capitalize;}
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold py-1 text-capitalize">
                        <span class="text-muted fw-light">Membership / <a href="{{ route('members.index') }}">Registration</a> / </span> New form
                    </h5>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                            href="{{ route('members.index') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-arrow-back'></i>
                            Back to members
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="surname">Surname</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="surname"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" 
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
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="given_name">Given name</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="given_name"
                                        class="form-control @error('given_name') is-invalid @enderror" name="given_name"
                                        value="{{ old('given_name') }}" 
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
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="other_name">Other name</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="other_name"
                                        class="form-control @error('other_name') is-invalid @enderror" name="other_name"
                                        value="{{ old('other_name') }}" 
                                    />
                                    @error('other_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="date_of_birth">Date of birth</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="date" 
                                        id="date_of_birth"
                                        class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                                        value="{{ old('date_of_birth') }}" 
                                        required 
                                    />
                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="telephone_number">Telephone number</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="telephone_number"
                                        class="form-control @error('telephone_number') is-invalid @enderror" name="telephone_number"
                                        value="{{ old('telephone_number') }}" 
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
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="email">Email address</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="email" 
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" 
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
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="address">Physical Address</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="address"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" 
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
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="occupation">Occupation</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="occupation"
                                        class="form-control @error('occupation') is-invalid @enderror" name="occupation"
                                        value="{{ old('occupation') }}" 
                                        required 
                                    />
                                    @error('occupation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="nin">National Identification Number (NIN)</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="nin"
                                        class="form-control @error('nin') is-invalid @enderror" name="nin"
                                        value="{{ old('nin') }}" 
                                    />
                                    @error('nin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="passport_number">Passport number</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="passport_number"
                                        class="form-control @error('passport_number') is-invalid @enderror" name="passport_number"
                                        value="{{ old('passport_number') }}" 
                                    />
                                    @error('passport_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="relevant_document">Attach NIN or Passport</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="file" 
                                            class="form-control" 
                                            id="relevant_document"
                                            name="relevant_document" 
                                            accept=".doc,.docx,.pdf" 
                                            required
                                         />
                                        <label class="input-group-text" for="relevant_document">Upload</label>
                                    </div>
                                    @error('relevant_document')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="member_role">Member Role</label>
                                <div class="col-sm-9">
                                    <div class="input-group"> 
                                        <select class="form-select" data-placeholder="Choose role" name="member_role[]" multiple id="multiple_member_role">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('member_role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="conscent_form">Attach conscent form</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="file" 
                                            class="form-control" 
                                            id="conscent_form"
                                            name="conscent_form" 
                                            accept=".doc,.docx,.pdf" 
                                            required
                                         />
                                        <label class="input-group-text" for="conscent_form">Upload</label>
                                    </div>
                                    @error('conscent_form')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-9 mt-2">
                                    <button type="submit" class="btn btn-primary text-capitalize">Create member</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $('#multiple_member_role').select2({
            theme: "bootstrap-5",
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            allowClear: true,
        });
    </script>
@endpush