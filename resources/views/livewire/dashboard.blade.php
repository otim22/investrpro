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
