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
                <div class="card shadow" style="background-color: rgb(247, 248, 249)">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1 text-muted">Total asset value</span>
                        <h5 class="card-title mb-2">UGX {{ number_format($totalAssets) }}/-</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card shadow" style="background-color: rgb(247, 248, 249)">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1 text-muted">Total expenses</span>
                        <h5 class="card-title mb-2">UGX {{ number_format($totalExpenses) }}/-</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card shadow" style="background-color: rgb(247, 248, 249)">
                    <div class="card-body">
                        <span class="d-block mb-1 text-muted">Number of Investments</span>
                        <h5 class="card-title mb-2">{{ number_format($totalInvestments) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <div class="card shadow" style="background-color: rgb(247, 248, 249)">
                    <div class="card-body">
                        <span class="d-block text-capitalize mb-1 text-muted">Total members</span>
                        <h5 class="card-title mb-2">{{ number_format($totalMembers) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12 col-lg-12  col-md-12">
                <div class="d-flex justify-content-center">
                    <h5 class="text-capitalize fw-bold">Savings performance</h5>
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
                <div class="d-flex justify-content-center">
                    <h5 class="text-capitalize fw-bold">Missed meetings</h5>
                </div>
                <div class="card shadow-sm px-4 py-3" style="background-color: rgb(251, 251, 251)">
                    <canvas id="missedMeetingBar"></canvas>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="d-flex justify-content-center">
                    <h5 class="text-capitalize fw-bold">Late remissions</h5>
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- Monthly savings --}}
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
        
        var expJanSavings = {{ Js::from($expJanSavings) }};
        var expFebSavings = {{ Js::from($expFebSavings) }};
        var expMarSavings = {{ Js::from($expMarSavings) }};
        var expAprSavings = {{ Js::from($expAprSavings) }};
        var expMaySavings = {{ Js::from($expMaySavings) }};
        var expJunSavings = {{ Js::from($expJunSavings) }};
        var expJulSavings = {{ Js::from($expJulSavings) }};
        var expAugSavings = {{ Js::from($expAugSavings) }};
        var expSeptSavings = {{ Js::from($expSeptSavings) }};
        var expOctSavings = {{ Js::from($expOctSavings) }};
        var expNovSavings = {{ Js::from($expNovSavings) }};
        var expDecSavings = {{ Js::from($expDecSavings) }};

        new Chart(savingsCtx, {
            type: 'bar',
            data: {
                labels: financialMonths,
                datasets: [{
                    label: 'Expected',
                    data: [expJanSavings, expFebSavings, expMarSavings, expAprSavings, expMaySavings, expJunSavings, expJulSavings, expAugSavings, expSeptSavings, expOctSavings, expNovSavings, expDecSavings],
                    backgroundColor: ['rgb(151, 208, 232, 0.2)'],
                    borderColor: ['rgba(151, 208, 232)'],
                    borderWidth: 1
                }, 
                {
                    label: 'Actual',
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
    {{-- Late remissions --}}
    <script>
        const lateRemissionCtx = document.getElementById('lateRemissionBar');
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

        new Chart(lateRemissionCtx, {
            type: 'bar',
            data: {
                labels: financialMonths,
                datasets: [
                {
                    label: 'Expected',
                    data: [expJanLateRems, expFebLateRems, expMarLateRems, expAprLateRems, expMayLateRems, expJunLateRems, expJulLateRems, expAugLateRems, expSeptLateRems, expOctLateRems, expNovLateRems, expDecLateRems],
                    backgroundColor: ['rgb(137, 171, 141, 0.2)'],
                    borderColor: ['rgba(137, 171, 141)'],
                    borderWidth: 1
                },
                {
                    label: 'Actual',
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
     {{-- Missed meetings  --}}
    <script>
        const missedMeetingCtx = document.getElementById('missedMeetingBar');
        var janMissMeetings = {{ Js::from($janMissMeetings) }};
        var febMissMeetings = {{ Js::from($febMissMeetings) }};
        var marMissMeetings = {{ Js::from($marMissMeetings) }};
        var aprMissMeetings = {{ Js::from($aprMissMeetings) }};
        var mayMissMeetings = {{ Js::from($mayMissMeetings) }};
        var junMissMeetings = {{ Js::from($junMissMeetings) }};
        var julMissMeetings = {{ Js::from($julMissMeetings) }};
        var augMissMeetings = {{ Js::from($augMissMeetings) }};
        var septMissMeetings = {{ Js::from($septMissMeetings) }};
        var octMissMeetings = {{ Js::from($octMissMeetings) }};
        var novMissMeetings = {{ Js::from($novMissMeetings) }};
        var decMissMeetings = {{ Js::from($decMissMeetings) }};
        
        var expJanMissMeetings = {{ Js::from($expJanMissMeetings) }};
        var expFebMissMeetings = {{ Js::from($expFebMissMeetings) }};
        var expMarMissMeetings = {{ Js::from($expMarMissMeetings) }};
        var expAprMissMeetings = {{ Js::from($expAprMissMeetings) }};
        var expMayMissMeetings = {{ Js::from($expMayMissMeetings) }};
        var expJunMissMeetings = {{ Js::from($expJunMissMeetings) }};
        var expJulMissMeetings = {{ Js::from($expJulMissMeetings) }};
        var expAugMissMeetings = {{ Js::from($expAugMissMeetings) }};
        var expSeptMissMeetings = {{ Js::from($expSeptMissMeetings) }};
        var expOctMissMeetings = {{ Js::from($expOctMissMeetings) }};
        var expNovMissMeetings = {{ Js::from($expNovMissMeetings) }};
        var expDecMissMeetings = {{ Js::from($expDecMissMeetings) }};

        new Chart(missedMeetingCtx, {
            type: 'bar',
            data: {
                labels: financialMonths,
                datasets: [
                {
                    label: 'Expected',
                    data: [expJanMissMeetings, expFebMissMeetings, expMarMissMeetings, expAprMissMeetings, expMayMissMeetings, expJunMissMeetings, expJulMissMeetings, expAugMissMeetings, expSeptMissMeetings, expOctMissMeetings, expNovMissMeetings, expDecMissMeetings],
                    backgroundColor: ['rgb(192, 151, 232, 0.2)'],
                    borderColor: ['rgba(192, 151, 232)'],
                    borderWidth: 1
                },
                {
                    label: 'Actual',
                    data: [janMissMeetings, febMissMeetings, marMissMeetings, aprMissMeetings, mayMissMeetings, junMissMeetings, julMissMeetings, augMissMeetings, septMissMeetings, octMissMeetings, novMissMeetings, decMissMeetings],
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