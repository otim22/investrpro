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
                <h4 class="fw-bold text-capitalize"><span class="text-muted fw-light">Liabilities / </span>List of liabilities</h4>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('liabilities.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add liability
                    </a>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Liability number</span>
                        @if($liabilities)
                            <h3 class="card-title mb-2">{{ count($liabilities) }}</h3>
                        @else
                            <h3 class="card-title mb-2">0</h3>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Overall Total (UGX)</span>
                        <h3 class="card-title mb-2">12,628</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Total Type B (UGX)</span>
                        <h3 class="card-title mb-2">12,628</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Total Type C (UGX)</span>
                        <h3 class="card-title mb-2">12,628</h3>
                    </div>
                </div>
            </div>
        </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card p-3">
                @if (count($liabilities))
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Liability name</th>
                                <th class="text-nowrap">Type</th>
                                <th class="text-nowrap">Amount (UGX)</th>
                                <th class="text-nowrap">Financial year</th>
                                <th class="text-nowrap">Date acquired</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($liabilities as $liability)
                                <tr>
                                    <td>
                                        <a href="{{ route('liabilities.show', $liability) }}">
                                            {{ $liability->liability_name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $liability->liability_type }}
                                    </td>
                                    <td>
                                        {{ number_format($liability->amount) }}
                                    </td>
                                    <td>
                                        {{ $liability->financial_year }}
                                    </td>
                                    <td>
                                        {{ $liability->formatDate($liability->date_acquired) }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('liabilities.show', $liability) }}">
                                                    <i class='bx bx-list-check me-1'></i> Show
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('liabilities.edit', $liability) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmMemberDeletion{{ $liability->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <form action="{{ route('liabilities.destroy', $liability) }}" class="hidden"
                                    id="delete-asset-{{ $liability->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <div class="modal fade" id="confirmMemberDeletion{{ $liability->id }}"
                                    tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="confirmMemberDeletion{{ $liability->id }}">
                                                    Deleting {{ $liability->liability_name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        Are you sure deleting {{ $liability->liability_name }}?
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="event.preventDefault(); document.getElementById('delete-asset-{{ $liability->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mb-0 text-center text-capitalize">No liabilities found</p>
                @endif
            </div>
        </div>
      </div>
    </div>
@endsection