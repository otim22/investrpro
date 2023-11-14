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
                    <h4 class="fw-bold text-capitalize"><span class="text-muted fw-light">Account / </span>Add user</h4>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('org.user.index') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-arrow-back'></i>
                            Back user
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card p-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('org.user.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="first_name">First Name</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="first_name"
                                        class="form-control @error('first_name') is-invalid @enderror" 
                                        name="first_name"
                                        value="{{ old('first_name') }}" 
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
                                <label class="col-sm-3 col-form-label" for="last_name">Last Name</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror" 
                                        name="last_name"
                                        value="{{ old('last_name') }}" 
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
                                <label class="col-sm-3 col-form-label" for="email">Email</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
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
                                <label class="col-sm-3 col-form-label" for="password">Create new password</label>
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
                                <label class="col-sm-3 col-form-label" for="password-confirm">Confirm new password</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="password" 
                                        id="password-confirm"
                                        class="form-control" 
                                        name="password_confirmation" 
                                        required
                                    />
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-9 mt-2">
                                    <button type="submit" class="btn btn-primary text-capitalize">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
