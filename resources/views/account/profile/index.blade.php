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
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <h5 class="fw-bold py-1"><span class="text-muted fw-light">Account / </span>Profile</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 text-capitalize">User details:</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update.name') }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="first_name">First Name</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="first_name"
                                        class="form-control @error('first_name') is-invalid @enderror" 
                                        name="first_name"
                                        value="{{ $user->first_name }}" 
                                        required 
                                    />
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="last_name">Last Name</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror" 
                                        name="last_name"
                                        value="{{ $user->last_name }}" 
                                        required 
                                    />
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="email">Email</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $user->email }}" 
                                        disabled
                                    />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-9 mt-2">
                                    <button type="submit" class="btn btn-primary text-capitalize">Update profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 text-capitalize">Change password:</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update.password') }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="password">Old password</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="password" 
                                        id="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required 
                                    />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="new_password">Create new password</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="password"
                                        id="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                                        required 
                                    />
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="password-confirm">Confirm new password</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="password" 
                                        id="password-confirm"
                                        class="form-control" 
                                        name="new_password_confirmation" 
                                        required
                                    />
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-9 mt-2">
                                    <button type="submit" class="btn btn-primary text-capitalize">Update password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
