@extends('layouts.master.app')

@push('styles')
    <style>
        #chart-container {
            width: 800px;
            height: 500px;
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
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Profit & Loss / </span>Assets</h5>
                {{-- <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('assets.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add asset
                    </a>
                </div> --}}
            </div>
        </div>
      </div>
      <div class="row">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card" style="background-color: rgb(204, 229, 243)">
                    <div class="card-body"> 
                        <span class="d-block text-capitalize mb-1">Overall networth (UGX)</span>
                        @if($overrallTotal)
                            <h5 class="card-title mb-2">{{ number_format($overrallTotal) }}/-</h5>
                        @else
                            <h5 class="card-title mb-2">0.00</h5>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card" style="background-color: rgb(204, 243, 222)">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1">Monthly savings total (UGX)</span>
                        @if($totalMemberSaving)
                            <h5 class="card-title mb-2">{{ number_format($totalMemberSaving) }}/-</h5>
                        @else
                            <h5 class="card-title mb-2">0</h5>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card" style="background-color: rgb(234, 243, 204)">
                    <div class="card-body"> 
                        <span class="d-block text-capitalize mb-1">Late remissions total (UGX)</span>
                        @if($totalLateRemission)
                            <h5 class="card-title mb-2">{{ number_format($totalLateRemission) }}/-</h5>
                        @else
                            <h5 class="card-title mb-2">0.00</h5>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card" style="background-color: rgb(243, 211, 204)">
                    <div class="card-body"> 
                        <span class="d-block text-capitalize mb-1">Missed meetings total (UGX)</span>
                        @if($totalLateRemission)
                            <h5 class="card-title mb-2">{{ number_format($totalMissedMeeting) }}/-</h5>
                        @else
                            <h5 class="card-title mb-2">0.00</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
      <div class="row mt-3">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card p-3">
                @if (count($assets))
                    <div>
                        <canvas id="myChart"></canvas>
                        {{-- <canvas id="chart-container"></canvas> --}}
                    </div>
                    {{-- <table class="table table-striped table-hover">
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
                    </table> --}}
                @else
                    <p class="mb-0 text-center text-capitalize">No assets found</p>
                @endif
            </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Monthly savings',
                    data: [12, 19, 3, 5, 2, 3, 11, 4, 7, 1, 5, 17],
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Late remissions',
                    data: [11, 4, 7, 1, 5, 17, 12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Missed meetings',
                    data: [5, 17, 12, 19, 3, 11, 4, 7, 1, 5, 2, 3],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgb(54, 162, 235)',
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Line Chart'
                }
                }
            }
        });
    </script>    
@endpush