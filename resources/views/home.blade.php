@extends('layouts.master.app')

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
            <div class="col-12 col-lg-12 order-2 mb-2 order-md-3 order-lg-2">
                <div class="d-flex justify-content-between">
                    <h4 class="fw-bold py-1"><span class="text-muted fw-light">Dashboard / </span>Overview</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="d-block mb-1">Total Premiums</span>
                        <h5 class="card-title mb-2">$12,628</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="d-block mb-1">Expenses</span>
                        <h5 class="card-title mb-2">$12,628</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="d-block mb-1">Investments</span>
                        <h5 class="card-title mb-2">$12,628</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="d-block mb-1">Balance</span>
                        <h5 class="card-title mb-2">$12,628</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card p-3">
                @if (count($assets))
                    <div class="p-2">
                        {{ $dataTable->table() }}
                    </div>
                @else
                    <p class="mb-0 text-center text-capitalize">No assets found</p>
                @endif
            </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    {{ $dataTable->scripts() }}
@endpush