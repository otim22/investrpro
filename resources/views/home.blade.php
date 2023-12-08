@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold"><span class="text-muted fw-light">Dashboard / </span>Overview</h5>
                </div>
            </div>
        </div>
        
        <div class="row mb-2">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1">Total asset value</span>
                        <h5 class="card-title mb-2">UGX {{ number_format($overallAssetTotal) }}/-</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1">Total liability value</span>
                        <h5 class="card-title mb-2">UGX {{ number_format($overallLiabilityTotal) }}/-</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                    <div class="card-body">
                        <span class="d-block mb-1">Number of Investments</span>
                        <h5 class="card-title mb-2">{{ number_format($totalInvestments) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1">Total members</span>
                        <h5 class="card-title mb-2">{{ number_format($overallTotalMembers) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="d-flex justify-content-between">
                    <h5 class="text-capitalize">The annual assets performance</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card px-4 py-3">
                    <canvas id="savingsBar"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const savingsCtx = document.getElementById('savingsBar');
        var totalMembers = {{ Js::from($overallTotalMembers) }};
        console.log(totalMembers)
        new Chart(savingsCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Noc', 'Dec'],
                datasets: [{
                    label: 'Expected Monthly Savings',
                    data: [totalMembers, totalMembers, totalMembers, totalMembers, totalMembers, totalMembers, totalMembers],
                    backgroundColor: [
                        'rgb(151, 208, 232, 0.2)',
                    ],
                    borderColor: [
                        'rgba(151, 208, 232)',
                    ],
                    borderWidth: 1
                }, 
                {
                    label: 'Actual Monthly Savings',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: [
                        'rgb(151, 208, 232)',
                    ],
                    borderColor: [
                        'rgba(151, 208, 232, 0.2)',
                    ],
                    borderWidth: 1
                }, 
                {
                    label: 'Expected Missed Meetings',
                    data: [10, 20, 0, 5, 8, 0, 6],
                    backgroundColor: [
                        'rgb(137, 171, 141, 0.2)',
                    ],
                    borderColor: [
                        'rgba(137, 171, 141)',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Actual Missed meetings',
                    data: [6, 5, 8, 1, 4, 0, 2],
                    backgroundColor: [
                        'rgb(137, 171, 141)',
                    ],
                    borderColor: [
                        'rgba(137, 171, 141, 0.2)',
                    ],
                    borderWidth: 1
                }, 
                {
                    label: 'Expected Monthly Savings',
                    data: [10, 20, 0, 5, 8, 0, 6],
                    backgroundColor: [
                        'rgb(192, 151, 232, 0.2)',
                    ],
                    borderColor: [
                        'rgba(192, 151, 232)',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Actual Late remissions',
                    data: [0, 3, 1, 5, 2, 7, 0],
                    backgroundColor: [
                        'rgb(192, 151, 232)'
                    ],
                    borderColor: [
                        'rgba(192, 151, 232, 0.2)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
        });
    </script>  
@endpush