@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                @include('messages.flash')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Account / <a href="{{ route('org.user.index') }}">All Users </a> / </span>{{ $user->first_name }}</h5>
                    </div>
                    <div>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item btn-sm" href="{{ route('org.user.edit', $user) }}">
                                    <i class='me-2 bx bxs-edit-alt'></i>
                                    Edit user
                                </a>
                                <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#confirmPremiumDeletion{{ $user->id }}">
                                    <i class='me-2 bx bx-trash'></i>
                                    Delete user
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('org.user.destroy', $user) }}" class="hidden" id="delete-month-{{ $user->id }}"
                    method="POST">
                    @csrf
                    @method('delete')
                </form>
                <div class="modal fade" id="confirmPremiumDeletion{{ $user->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmPremiumDeletion{{ $user->id }}">
                                    Account for {{ $user->first_name }} {{ $user->last_name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        Are you sure deleting {{ $user->first_namename }} {{ $user->last_name }}?
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary"
                                    onclick="event.preventDefault(); document.getElementById('delete-month-{{ $user->id }}').submit();">Delete</button>
                            </div>
                        </div>
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
                                        value="{{ $user->first_name }}" 
                                        disabled 
                                    />
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
                                        value="{{ $user->last_name }}" 
                                        disabled 
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label" for="email">Email</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $user->email }}" 
                                        disabled
                                    />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
