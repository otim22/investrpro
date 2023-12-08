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
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
          <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
              @include('messages.flash')
          </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Profit & Loss / </span>Liabilities</h5>
            </div>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-1">Overall value</span>
                    @if($totalValue)
                        <h5 class="card-title mb-2">UGX {{ number_format($totalValue) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body">
                    <span class="d-block text-capitalize mb-1">Number of Liabilities</span>
                    @if($liabilities)
                        <h5 class="card-title mb-2">{{ number_format(count($liabilities)) }}</h5>
                    @else
                        <h5 class="card-title mb-2">0</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body">
                    <span class="d-block text-capitalize mb-1">Current Liabilities</span>
                    @if($currentLiabilities)
                        <h5 class="card-title mb-2">UGX {{ number_format($currentLiabilities) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body">
                    <span class="d-block text-capitalize mb-1">Non Current Liabilities</span>
                    @if($nonCurrentLiabilities)
                        <h5 class="card-title mb-2">UGX {{ number_format($nonCurrentLiabilities) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="py-1 text-capitalize">Table of all liabilities</h5>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card p-3">
                @if (count($liabilities))
                    <div class="card p-3">
                        {{ $dataTable->table() }}
                    </div>
                @else
                    <p class="mb-0 text-center text-capitalize">No liabilities found</p>
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