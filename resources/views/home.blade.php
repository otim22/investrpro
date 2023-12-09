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
                        <h5 class="card-title mb-2">UGX {{ number_format($totalAssets) }}/-</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1">Total liability value</span>
                        <h5 class="card-title mb-2">UGX {{ number_format($totalLiabilities) }}/-</h5>
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
                        <h5 class="card-title mb-2">{{ number_format($totalMembers) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-lg-12  col-md-12">
                <div class="d-flex justify-content-between">
                    <h5 class="text-capitalize fw-bold">Annual savings performance</h5>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card shadow-sm px-4 py-3" style="background-color: rgb(251, 251, 251)">
                    <canvas id="savingsBar"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="d-flex justify-content-between">
                    <h5 class="text-capitalize fw-bold">Annual missed meetings</h5>
                </div>
                <div class="card shadow-sm px-4 py-3" style="background-color: rgb(251, 251, 251)">
                    <canvas id="missedMeetingBar"></canvas>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="d-flex justify-content-between">
                    <h5 class="text-capitalize fw-bold">Annual late remissions</h5>
                </div>
                <div class="card shadow-sm px-4 py-3" style="background-color: rgb(251, 251, 251)">
                    <canvas id="lateRemissionBar"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const savingsCtx = document.getElementById('savingsBar');
        var financialMonths = {{ Js::from($financialMonths) }};
        var expMonthSavings = {{ Js::from($expMonthSavings) }};
        var janSavings = {{ Js::from($janSavings) }};
        var febSavings = {{ Js::from($febSavings) }};
        var marSavings = {{ Js::from($marSavings) }};
        var aprSavings = {{ Js::from($aprSavings) }};
        var maySavings = {{ Js::from($maySavings) }};
        var junSavings = {{ Js::from($junSavings) }};
        var julSavings = {{ Js::from($julSavings) }};
        var augSavings = {{ Js::from($augSavings) }};
        var septSavings = {{ Js::from($septSavings) }};
        var octSavings = {{ Js::from($octSavings) }};
        var novSavings = {{ Js::from($novSavings) }};
        var decSavings = {{ Js::from($decSavings) }};

        new Chart(savingsCtx, {
            type: 'bar',
            data: {
                labels: financialMonths,
                datasets: [{
                    label: 'Expected Monthly Savings',
                    data: [expMonthSavings, expMonthSavings, expMonthSavings, expMonthSavings, expMonthSavings, expMonthSavings, expMonthSavings],
                    backgroundColor: ['rgb(151, 208, 232, 0.2)'],
                    borderColor: ['rgba(151, 208, 232)'],
                    borderWidth: 1
                }, 
                {
                    label: 'Actual Monthly Savings',
                    data: [janSavings, febSavings, marSavings, aprSavings, maySavings, junSavings, julSavings, augSavings, septSavings, octSavings, novSavings, decSavings],
                    backgroundColor: ['rgb(151, 208, 232)'],
                    borderColor: ['rgba(151, 208, 232, 0.2)'],
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
    <script>
        const missedMeetingCtx = document.getElementById('lateRemissionBar');
        var janLateRems = {{ Js::from($janLateRems) }};
        var febLateRems = {{ Js::from($febLateRems) }};
        var marLateRems = {{ Js::from($marLateRems) }};
        var aprLateRems = {{ Js::from($aprLateRems) }};
        var mayLateRems = {{ Js::from($mayLateRems) }};
        var junLateRems = {{ Js::from($junLateRems) }};
        var julLateRems = {{ Js::from($julLateRems) }};
        var augLateRems = {{ Js::from($augLateRems) }};
        var septLateRems = {{ Js::from($septLateRems) }};
        var octLateRems = {{ Js::from($octLateRems) }};
        var novLateRems = {{ Js::from($novLateRems) }};
        var decLateRems = {{ Js::from($decLateRems) }};
        
        var expJanLateRems = {{ Js::from($expJanLateRems) }};
        var expFebLateRems = {{ Js::from($expFebLateRems) }};
        var expMarLateRems = {{ Js::from($expMarLateRems) }};
        var expAprLateRems = {{ Js::from($expAprLateRems) }};
        var expMayLateRems = {{ Js::from($expMayLateRems) }};
        var expJunLateRems = {{ Js::from($expJunLateRems) }};
        var expJulLateRems = {{ Js::from($expJulLateRems) }};
        var expAugLateRems = {{ Js::from($expAugLateRems) }};
        var expSeptLateRems = {{ Js::from($expSeptLateRems) }};
        var expOctLateRems = {{ Js::from($expOctLateRems) }};
        var expNovLateRems = {{ Js::from($expNovLateRems) }};
        var expDecLateRems = {{ Js::from($expDecLateRems) }};

        new Chart(missedMeetingCtx, {
            type: 'bar',
            data: {
                labels: financialMonths,
                datasets: [
                {
                    label: 'Expected Late remissions',
                    data: [expJanLateRems, expFebLateRems, expMarLateRems, expAprLateRems, expMayLateRems, expJunLateRems, expJulLateRems, expAugLateRems, expSeptLateRems, expOctLateRems, expNovLateRems, expDecLateRems],
                    backgroundColor: ['rgb(137, 171, 141, 0.2)'],
                    borderColor: ['rgba(137, 171, 141)'],
                    borderWidth: 1
                },
                {
                    label: 'Actual Late remissions',
                    data: [janLateRems, febLateRems, marLateRems, aprLateRems, mayLateRems, junLateRems, julLateRems, augLateRems, septLateRems, octLateRems, novLateRems, decLateRems],
                    backgroundColor: ['rgb(137, 171, 141)'],
                    borderColor: ['rgba(137, 171, 141, 0.5)'],
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
    <script>
        const lateRemissionCtx = document.getElementById('missedMeetingBar');
        var totalMembers = {{ Js::from($totalMembers) }};

        new Chart(lateRemissionCtx, {
            type: 'bar',
            data: {
                labels: financialMonths,
                datasets: [
                {
                    label: 'Expected Missed meetings',
                    data: [10, 20, 0, 5, 8, 0, 6],
                    backgroundColor: ['rgb(192, 151, 232, 0.2)'],
                    borderColor: ['rgba(192, 151, 232)'],
                    borderWidth: 1
                },
                {
                    label: 'Actual Missed meetings',
                    data: [0, 3, 1, 5, 2, 7, 0],
                    backgroundColor: ['rgb(192, 151, 232)'],
                    borderColor: ['rgba(192, 151, 232, 0.2)'],
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