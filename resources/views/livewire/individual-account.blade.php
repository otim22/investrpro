<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Individual account value / </span> {{ $individual->first_name }} current standing</h5>
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
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card py-4 ps-5">
                <div class="row">
                    <div class="col-4">
                        <h5 class="text-capitalize">Full names: </h5>
                        <h5 class="text-capitalize">Returns from investment: </h5>
                        <h5 class="text-capitalize">Annual fees: </h5>
                        <h5 class="text-capitalize">Amount to catch up: </h5>
                        <h5 class="text-capitalize">Netwoth in the club: </h5>
                    </div>
                    <div class="col-8">   
                        <h5 class="text-muted text-capitalize">{{ $individual->first_name }} {{ $individual->last_name }} </h5>
                        <h5 class="text-muted">
                            @if ($individualWorth > 0)
                                {{ number_format($individualWorth) }}/-
                            @else
                                0.00
                            @endif
                        </h5>
                        <h5 class="text-muted">
                            @if ($annualFees > 0)
                                {{ number_format($annualFees) }}/-
                            @else
                                0.00
                            @endif
                        </h5>
                        <h5 class="text-muted">
                            @if ($unPaidSavings > 0)
                                {{ number_format($unPaidSavings) }}/-
                            @else
                                0.00
                            @endif
                        </h5>
                        <h5 class="text-muted">
                            @if ($paidSavings > 0)
                                {{ number_format($paidSavings) }}/-
                            @else
                                0.00
                            @endif    
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
