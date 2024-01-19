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
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">General / </span>List of expense types</h5>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('admin.expense-types.create') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-plus'></i>
                            Add expense type
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    @if (count($expenseTypes) > 0)
                        <livewire:expense-type-table />
                    @else
                        <p class="mb-0 text-center text-capitalize">No expense types found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection