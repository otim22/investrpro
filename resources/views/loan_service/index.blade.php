@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Loan service / </span> Start here</h5>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
