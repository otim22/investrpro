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
                <h4 class="fw-bold"><span class="text-muted fw-light">Permissions</span></h4>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="d-flex justify-content-start">
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('admin.permissions.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add permissions
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card text-center p-3">
                    @if(count($permissions))
                    <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>Member</th>
                    <th>Premium</th>
                    <th>Month</th>
                    <th>Date</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                    <td> Otim Fredrick</td>
                    <td>100,000</td>
                    <td>Aug</td>
                    <td> Otim </td>
                    <td>
                        <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-trash me-1"></i> Delete</a
                            >
                        </div>
                        </div>
                    </td>
                    </tr>
                </tbody>
                </table>
                    @else
                        <p class="mb-0 text-capitalize">No permissions found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
