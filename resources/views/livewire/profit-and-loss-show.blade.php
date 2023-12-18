<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <h5 class="fw-bold py-1 text-capitalize">Summary of Profits & Losses</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Profit / </span>Assets</h5>
                </div>
                <div class="d-flex">
                    <div class="me-3">
                        <form wire:submit="filterDataByYear" class="d-flex justify-content-between">
                            <div>
                                <select 
                                    id="filterByYear" 
                                    class="form-select form-select-sm" 
                                    aria-label="Default select"
                                    wire:model="year" 
                                >
                                    <option selected>Year</option>
                                    @foreach ($years as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-sm btn-secondary ms-2">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <form wire:submit="filterDataByMonth" class="d-flex justify-content-between">
                            <div>
                                <select 
                                    id="filterByMonth" 
                                    class="form-select form-select-sm" 
                                    aria-label="Default select"
                                    wire:model="month" 
                                >
                                    <option selected>Month</option>
                                    @foreach ($months as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-sm btn-secondary ms-2">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-2">Asset value</span>
                    @if($overallAssetTotal)
                        <h5 class="card-title mb-2">UGX {{ number_format($overallAssetTotal) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body">
                    <span class="d-block text-capitalize mb-2">Monthly savings total</span>
                    @if($totalMemberSaving)
                        <h5 class="card-title mb-2">UGX {{ number_format($totalMemberSaving) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-2">Late remissions total</span>
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
                    <span class="d-block text-capitalize mb-2">Missed meetings total</span>
                    @if($totalLateRemission)
                        <h5 class="card-title mb-2">UGX {{ number_format($totalMissedMeeting) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-2">
        <div class="col-lg-12 col-md-12 col-12">
            <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Loss / </span>Liabilities</h5>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body">
                    <span class="d-block text-capitalize mb-2">Liability value</span>
                    @if ($totalLiabilityValue)
                        <h5 class="card-title mb-2">UGX {{ number_format($totalLiabilityValue) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body">
                    <span class="d-block text-capitalize mb-2">Number of Liabilities</span>
                    @if ($liabilities)
                        <h5 class="card-title mb-2">{{ number_format(count($liabilities)) }}</h5>
                    @else
                        <h5 class="card-title mb-2">0</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body">
                    <span class="d-block text-capitalize mb-2">Current Liabilities</span>
                    @if ($currentLiabilities)
                        <h5 class="card-title mb-2">UGX {{ number_format($currentLiabilities) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card shadow-sm" style="background-color: rgb(235, 238, 247">
                <div class="card-body">
                    <span class="d-block text-capitalize mb-2">Non Current Liabilities</span>
                    @if ($nonCurrentLiabilities)
                        <h5 class="card-title mb-2">UGX {{ number_format($nonCurrentLiabilities) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
