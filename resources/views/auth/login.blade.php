@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-items-center py-5">
        <div class="col-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="border round rounded-2 shadow px-5 py-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
    
                    <div class="d-flex justify-content-center">
                        <h4 class="fw-bold text-capitalize mb-3">Welcome back!</h4>
                    </div>
    
                    <div class="mb-3">
                        <label class="text-capitalize" for="email">Email</label>
                        <input type="email" class="form-control mt-1 @error('email') is-invalid @enderror" name="email" placeholder="example@domain.xy" value="{{ old('email') }}" required autocomplete="email" autofocus id="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
              
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control mt-1 @error('password') is-invalid @enderror" name="password"required autocomplete="current-password" placeholder="password" id="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary text-capitalize fw-bold rounded rounded-5 mt-2">
                            Login
                        </button>
                    </div>

                    <div class="d-flex justify-content-center pt-3">
                        <a href="{{ route('password.request') }}" class="d-flex align-items-center text-decoration-none">
                            <span class="fw-bold">Forgot your password?</span>
                        </a>
                    </div>
    
                    <div class="d-flex justify-content-center">
                        <div class="pe-2">
                            Don't have account?
                        </div>
                        <div>
                            <a href="{{ route('register') }}" class="d-flex align-items-center text-decoration-none">
                                <span class="fw-bold"> Register here!</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
