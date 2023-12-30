<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 mb-2">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="fw-bold py-1 text-capitalize">Summary of Profits & Losses</h5>
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
            <div class="card shadow-sm" style="background-color: rgb(247, 248, 249)">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-2 text-muted">Expected asset (UGX)</span>
                    @if($expAssetToal > 0)
                        <h5 class="card-title mb-2">{{ number_format($expAssetToal) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(247, 248, 249)">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-2 text-muted">available asset (UGX)</span>
                    @if($actAssetToal > 0)
                        <h5 class="card-title mb-2">{{ number_format($actAssetToal) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(247, 248, 249)">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-2 text-muted">Net asset (UGX)</span>
                    @if($netAsset)
                        <h5 class="card-title mb-2">{{ number_format($netAsset) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
            <div class="card shadow-sm" style="background-color: rgb(247, 248, 249)">
                <div class="card-body"> 
                    <span class="d-block text-capitalize mb-2 text-muted">Expense (UGX)</span>
                    @if($totalExpensesValue > 0)
                        <h5 class="card-title mb-2">{{ number_format($totalExpensesValue) }}/-</h5>
                    @else
                        <h5 class="card-title mb-2">0.00</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-lg-6 col-md-6 col-6 mb-4">
            <div class="card shadow" style="background-color: rgb(247, 248, 249)">
                <div class="card-body"> 
                    <div class="text-capitalize fw-bold d-flex justify-content-center mb-2">
                        Available asset overview (UGX)
                    </div>

                    @if ($actualAssetTotal > 0)
                        <div class="d-flex justify-content-between">
                            <div class="d-block text-capitalize mb-2 text-muted">Savings</div>
                            @if($totalActSaving > 0)
                                <div class="card-title mb-2">{{ number_format($totalActSaving) }}/-</div>
                            @else
                                <div class="card-title mb-2">0.00</div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="d-block text-capitalize mb-2 text-muted">Late remissions</span>
                            @if($totalActLateRemission > 0)
                                <div class="card-title mb-2">{{ number_format($totalActLateRemission) }}/-</div>
                            @else
                                <div class="card-title mb-2">0.00</div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="d-block text-capitalize mb-2 text-muted">Missed meetings</span>
                            @if($totalActMissedMeeting > 0)
                                <div class="card-title mb-2">{{ number_format($totalActMissedMeeting) }}/-</div>
                            @else
                                <div class="card-title mb-2">0.00</div>
                            @endif
                        </div>
                        
                        <div><hr /></div>

                        <div class="d-flex justify-content-between">
                            <div class="d-block text-capitalize mb-2 text-muted">Total</div>
                            @if($actualAssetTotal > 0)
                                <div class="mb-2 fw-bold">{{ number_format($actualAssetTotal) }}/-</div>
                            @else
                                <div class="mb-2">0.00</div>
                            @endif
                        </div>
                    @else
                        <div class="d-flex justify-content-between">
                            <p class="mb-0 text-center text-capitalize">No assets found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-6 mb-4">
            <div class="card shadow" style="background-color: rgb(247, 248, 249)">
                <div class="card-body"> 
                    <div class="text-capitalize fw-bold d-flex justify-content-center mb-2">
                        Expense overview (UGX)
                    </div>
                    
                    @if ($totalExpensesValue > 0)
                        <div class="d-flex justify-content-between">
                            <span class="d-block text-capitalize mb-2 text-muted">Current expenses ({{ $totalCurrentExpenses }})</span>
                            @if ($currentExpenses > 0)
                                <div class="card-title mb-2">{{ number_format($currentExpenses) }}/-</div>
                            @else
                                <div class="card-title mb-2">0.00</div>
                            @endif
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <span class="d-block text-capitalize mb-2 text-muted">Non Current expenses ({{ $totalNonCurrentExpenses }})</span>
                            @if ($nonCurrentExpenses > 0)
                                <div class="card-title mb-2">{{ number_format($nonCurrentExpenses) }}/-</div>
                            @else
                                <div class="card-title mb-2">0.00</div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="d-block text-capitalize mb-2 text-muted">Number of expenses</span>
                            @if (count($expenses) > 0)
                                <div class="card-title mb-2">{{ number_format(count($expenses)) }}</div>
                            @else
                                <div class="card-title mb-2">0</div>
                            @endif
                        </div>

                        <div><hr /></div>
                        
                        <div class="d-flex justify-content-between">
                            <div class="d-block text-capitalize mb-2 text-muted">Total</div>
                            @if ($totalExpensesValue > 0)
                                <div class="card-title fw-bold mb-2">{{ number_format($totalExpensesValue) }}/-</div>
                            @else
                                <div class="card-title mb-2">0.00</div>
                            @endif
                        </div>
                    @else
                        <div class="d-flex justify-content-between">
                            <p class="mb-0 text-center text-capitalize">No expenses found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
