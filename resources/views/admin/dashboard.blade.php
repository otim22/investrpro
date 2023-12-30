@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <style>
        table tr td, table tr th {
            max-width: 14vw;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        table {
            width: 100%;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 70px !important;
        }
    </style>
@endpush

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <h5 class="fw-bold py-1"><span class="text-muted fw-light">Dashboard / </span>Overview</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Total Premiums</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Expenses</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Investments</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Balance</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection