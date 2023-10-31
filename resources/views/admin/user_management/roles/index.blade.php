@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                @include('messages.flash')
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <h4 class="fw-bold"><span class="text-muted text-capitalize fw-light">User management / </span>Roles</h4>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="d-flex justify-content-start">
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('admin.roles.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add role
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card text-center p-3">
                    <p class="mb-0 text-capitalize">No roles found</p>
                </div>
            </div>
        </div>
    </div>
@endsection
