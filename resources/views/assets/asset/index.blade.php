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
                <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Profit & Loss / </span>Assets</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('assets.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add asset
                    </a>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1">Asset number</span>
                        @if($assets)
                            <h5 class="card-title mb-2">{{ count($assets) }}</h5>
                        @else
                            <h5 class="card-title mb-2">0</h5>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body"> 
                        <span class="d-block text-capitalize mb-1">Overall value</span>
                        @if($totalNetworth)
                            <h5 class="card-title mb-2">{{ number_format($totalNetworth) }}</h5>
                        @else
                            <h5 class="card-title mb-2">0.00</h5>
                        @endif
                    </div>
                </div>
            </div>
            @foreach($totalByTypes as $key => $totalByType)
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="d-block text-capitalize mb-1">{{ $key }}</span>
                            <h5 class="card-title mb-2">{{ number_format($totalByType) }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card p-3">
                @if (count($assets))
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Asset name</th>
                                <th class="text-nowrap">Type</th>
                                <th class="text-nowrap">Amount (UGX)</th>
                                <th class="text-nowrap">Financial year</th>
                                <th class="text-nowrap">Date acquired</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($assets as $asset)
                                <tr>
                                    <td>
                                        <a href="{{ route('assets.show', $asset) }}">
                                            {{ $asset->asset_name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $asset->asset_type }}
                                    </td>
                                    <td>
                                        {{ number_format($asset->amount) }}
                                    </td>
                                    <td>
                                        {{ $asset->financial_year }}
                                    </td>
                                    <td>
                                        {{ $asset->formatDate($asset->date_acquired) }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('assets.show', $asset) }}">
                                                    <i class='bx bx-list-check me-1'></i> Show
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('assets.edit', $asset) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmMemberDeletion{{ $asset->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <form action="{{ route('assets.destroy', $asset) }}" class="hidden"
                                    id="delete-asset-{{ $asset->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <div class="modal fade" id="confirmMemberDeletion{{ $asset->id }}"
                                    tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="confirmMemberDeletion{{ $asset->id }}">
                                                    Deleting {{ $asset->asset_name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        Are you sure deleting {{ $asset->asset_name }}?
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="event.preventDefault(); document.getElementById('delete-asset-{{ $asset->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mb-0 text-center text-capitalize">No assets found</p>
                @endif
            </div>
        </div>
      </div>
    </div>
@endsection
