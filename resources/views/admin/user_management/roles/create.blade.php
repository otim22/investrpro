@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <h4 class="fw-bold"><span class="text-muted text-capitalize fw-light">User management / <a href="{{ route('admin.roles.index') }}">Roles</a> / </span>Create</h4>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="d-flex justify-content-start">
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('admin.roles.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to Roles
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 text-capitalize">Roles form</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="name">Name</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="100000" 
                                />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="premium">Premium</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="premium" 
                                    class="form-control @error('premium') is-invalid @enderror" 
                                    name="premium"
                                    value="{{ old('premium') }}"
                                    placeholder="100000" 
                                />
                                @error('premium')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary text-capitalize">Create role</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
