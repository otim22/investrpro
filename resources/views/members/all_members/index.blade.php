@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <h4 class="fw-bold py-1"><span class="text-muted text-capitalize fw-light">All members</span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    <p class="mb-0 text-center text-capitalize">No members found</p>
                </div>
            </div>
        </div>
    </div>
@endsection
