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
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Profit & Loss / </span>Assets</h5>
            </div>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-1">Overall networth</span>
                    @if($overallTotal)
                        <h5 class="card-title mb-2">UGX {{ number_format($overallTotal) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body">
                    <span class="d-block text-capitalize mb-1">Monthly savings total</span>
                    @if($totalMemberSaving)
                        <h5 class="card-title mb-2">UGX {{ number_format($totalMemberSaving) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-1">Late remissions total</span>
                    @if($totalLateRemission)
                        <h5 class="card-title mb-2">UGX {{ number_format($totalLateRemission) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-1">Missed meetings total</span>
                    @if($totalLateRemission)
                        <h5 class="card-title mb-2">UGX {{ number_format($totalMissedMeeting) }}/-</h5>
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
                    <h5 class="fw-bold text-capitalize">Assets status summary</h5>
                    <h5 class="fw-bold text-capitalize">Assets status summary</h5>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-4 col-md-12 col-12">
                <div class="card px-2 py-3">
                    <h5 class="fw-bold text-center text-capitalize">Monthly savings</h5>
                    <canvas id="monthlySavingsChart"></canvas>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12">
                <div class="card px-2 py-3">
                    <h5 class="fw-bold text-center text-capitalize">Late remissions</h5>
                    <canvas id="lateRemissionsChart"></canvas>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12">
                <div class="card px-2 py-3">
                    <h5 class="fw-bold text-center text-capitalize">Missed meetings</h5>
                    <canvas id="missedMeetingsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const monthlySavingCtx = document.getElementById('monthlySavingsChart');
        new Chart(monthlySavingCtx, {
            type: 'doughnut',
            data: {
                labels: ['Expected', 'Actual', 'UnPaid'],
                datasets: [{
                    label: 'monthly Savings',
                    data: [300, 300, 20],
                    backgroundColor: [
                        'rgb(110, 150, 126)',
                        'rgb(7, 135, 39)',
                        'rgb(220, 224, 221)'
                    ],
                    hoverOffset: 4
                }]
            },
        });
    </script> 
    <script>
        const lateRemissionCtx = document.getElementById('lateRemissionsChart');
        new Chart(lateRemissionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Expected', 'Actual', 'UnPaid'],
                datasets: [{
                    label: 'Late Remissions',
                    data: [300, 10, 20],
                    backgroundColor: [
                        'rgb(110, 131, 150)',
                        'rgb(5, 56, 125)',
                        'rgb(228, 231, 235)'
                    ],
                    hoverOffset: 4
                }]
            },
        });
    </script>
    <script>
        const missedMeetingCtx = document.getElementById('missedMeetingsChart');
        new Chart(missedMeetingCtx, {
            type: 'doughnut',
            data: {
                labels: ['Expected', 'Actual', 'UnPaid'],
                datasets: [{
                    label: 'Missed Meeting',
                    data: [300, 0, 300],
                    backgroundColor: [
                        'rgb(120, 68, 76)',
                        'rgb(125, 5, 23)',
                        'rgb(224, 220, 221)'
                    ],
                    hoverOffset: 4
                }]
            },
        });
    </script>    
@endpush