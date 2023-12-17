@extends('layouts.master.app')

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
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Profit & Loss /
                        </span>Liabilities</h5>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1">Overall value</span>
                        @if ($totalValue)
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
                        @if ($liabilities)
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
                        @if ($currentLiabilities)
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
                        @if ($nonCurrentLiabilities)
                            <h5 class="card-title mb-2">UGX {{ number_format($nonCurrentLiabilities) }}/-</h5>
                        @else
                            <h5 class="card-title mb-2">0.00</h5>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
