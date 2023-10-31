@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-items-center py-5">
        <div class="col-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="border round rounded-2 shadow px-5 py-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="text-center pb-4">
                        <h4 class="fw-bold text-capitalize">Register account</h4>
                        <p class="text-muted">Fill the form to create an account.</p>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="first_name" class="text-capitalize">First name</label>
                            <input type="text" name="first_name" class="form-control mt-1 @error('first_name') is-invalid @enderror" autofocus value="{{ old('first_name') }}" placeholder="Maynard" id="first_name">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="last_name" class="text-capitalize">Last name</label>
                            <input type="text" name="last_name" class="form-control mt-1 @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Zane" id="last_name">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="mb-3">
                        <label for="company_name" class="text-capitalize">Company name</label>
                        <input name="company_name" class="form-control mt-1 @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" placeholder="Bogan savings" id="company_name">
                        @error('company_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="email" class="text-capitalize">Email</label>
                        <input name="email" class="form-control mt-1 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="example@domain.xyz" id="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="password" class="text-capitalize">Password</label>
                            <input type="password" name="password" class="form-control mt-1 @error('password') is-invalid @enderror" required autocomplete="new-password" id="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                
                        <div class="col-12 col-md-6 mb-3">
                            <label for="password-confirm" class="text-capitalize">Confirm password</label>
                            <input name="password_confirmation" class="form-control mt-1"  required autocomplete="new-password" id="password-confirm">
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary text-capitalize fw-bold rounded rounded-5 mt-4">
                            Register
                        </button>
                    </div>

                    <div class="d-flex justify-content-center pt-3">
                        <div class="pe-2">
                            Already have account?
                        </div>
                        <div>
                            <a href="{{ route('login') }}" class="d-flex align-items-center text-decoration-none">
                                <span class="fw-bold"> Login here!</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
