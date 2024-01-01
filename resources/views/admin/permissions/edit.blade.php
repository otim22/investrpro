@extends('admin.layouts.app')

@push('styles')
    <style>
        .camel-sent {text-transform: capitalize;}
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-2">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold text-capitalize">
                        <span class="text-muted fw-light">
                            Permissions / <a href="{{ route('admin.permissions.index') }}">List of permissions</a> /
                        </span>{{ $permission->name }}
                    </h5>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                            href="{{ route('admin.permissions.index') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-arrow-back'></i>
                            Back to Permissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 text-capitalize">Permissions form</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                            @csrf
                            @method('patch')

                            <div class="row">
                                <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="name">Permission Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="name"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $permission->name) }}" required />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-9 mt-4">
                                    <button type="submit" class="btn btn-primary text-capitalize">Update permission</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
