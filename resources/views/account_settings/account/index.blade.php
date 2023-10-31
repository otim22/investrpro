@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <h4 class="fw-bold py-1"><span class="text-muted fw-light">Account settings / </span>Group account</h4>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="d-flex justify-content-start pb-2">
                    <a class="btn btn-sm btn-outline-primary" type="button" href="{{ route('member-savings.create') }}" aria-haspopup="true" aria-expanded="false">
                        Create group account
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card p-4">
                    <p>No group account</p>
                </div>
            </div>
        </div>
    </div>
@endsection
