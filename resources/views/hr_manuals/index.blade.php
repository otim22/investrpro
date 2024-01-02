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
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">HR Manuals / </span>List of HR Manuals</h5>
                    @can('add hr manual')
                        <div>
                            <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('hr-manuals.create') }}" aria-haspopup="true" aria-expanded="false">
                                <i class='me-2 bx bx-plus'></i>
                                Add manuals
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    @if (count($hrManuals) > 0)
                        <livewire:hr-manual-table />
                    @else
                        <p class="mb-0 text-center text-capitalize">No HR Manuals found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
