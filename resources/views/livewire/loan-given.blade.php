<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-2">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Loan service / </span> {{ $authUser }} credit</h5>
                <div>
                    <div class="btn-group rounded" role="group">
                        <button wire:click="loanHistory"  type="button" class="btn btn-sm btn-outline-primary {{ $currentloanHistory ? 'active' : '' }}">All</button>
                        <button wire:click="activeLoans"  type="button" class="btn btn-sm btn-outline-primary {{ $currentActive ? 'active' : '' }}">Running</button>
                        <button wire:click="inActiveLoans" type="button" class="btn btn-sm btn-outline-primary {{ $currentInActive ? 'active' : '' }}">Ended</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="card p-3">
                @if (count($credits) > 0)
                    <div style="overflow-x: auto">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Credit taken</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Date paid</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Amount paid</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Comment</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Balance</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($credits as $advancedCredit)
                                    <tr>
                                        <td class="text-nowrap">{{ number_format($advancedCredit->amount_taken) }}/-</td>
                                        @if($advancedCredit->date_paid)
                                            <td class="text-nowrap">{{ $advancedCredit->date_paid->format('d/m/Y') }}</td>
                                        @else
                                            <td class="text-nowrap">--</td>
                                        @endif
                                        @if($advancedCredit->amount_paid)
                                            <td class="text-nowrap">{{ number_format($advancedCredit->amount_paid) }}/-</td>
                                        @else
                                            <td class="text-nowrap">0.00</td>
                                        @endif
                                        @if($advancedCredit->comment)
                                            <td class="text-nowrap">{{ $advancedCredit->comment }}</td>
                                        @else
                                            <td class="text-nowrap">--</td>
                                        @endif
                                        <td class="text-nowrap">{{ number_format($advancedCredit->balance) }}/-</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $credits->links() !!}
                    </div>
                @else
                    <p class="mb-0 text-center text-capitalize">No loan found</p>
                @endif
            </div>
        </div>
    </div>
</div>
