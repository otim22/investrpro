<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Loan service / <a href="{{ route('settlements.index') }}">Settlements / </a></span> {{ $loanApplication->ref_code }}</h5>
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
                @if (count($loanHistories) > 0)
                    <div style="overflow-x: auto">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Credit taken</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Amount paid</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Date paid</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Comment</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Balance</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($loanHistories as $loanHistory)
                                    <tr>
                                        <td class="text-nowrap">{{ number_format($loanHistory->amount_taken) }}/-</td>
                                        @if($loanHistory->amount_paid)
                                            <td class="text-nowrap">{{ number_format($loanHistory->amount_paid) }}/-</td>
                                        @else
                                            <td class="text-nowrap">0.00/-</td>
                                        @endif
                                        @if($loanHistory->date_paid)
                                            <td class="text-nowrap">{{ $loanHistory->date_paid->format('d/m/Y') }}</td>
                                        @else
                                            <td class="text-nowrap">--</td>
                                        @endif
                                        @if($loanHistory->comment)
                                            <td class="text-nowrap">{{ $loanHistory->comment }}</td>
                                        @else
                                            <td class="text-nowrap">--</td>
                                        @endif
                                        @if ($loanHistory->balance > 0)
                                            <td class="text-nowrap">{{ number_format($loanHistory->balance) }}/-</td>
                                        @else
                                            <td class="text-nowrap">0.00/-</td>
                                        @endif
                                        @if ($loanHistory->has_paid)
                                            <td class="text-nowrap text-capitalize">
                                                @if ($loanHistory->balance > 0)
                                                    <a type="button" wire:click="handleLoanPaymentId({{ $loanHistory->id }})" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#modalPayLoan" href="">Payment</a>
                                                @endif
                                                <a type="button" wire:click="handleLoanPaymentEditId({{ $loanHistory->id }})" class="btn btn-sm btn-outline-secondary px-3" data-bs-toggle="modal" data-bs-target="#modalEditLoan"  href="">Edit</a>
                                                @if(!$loanHistory->is_active)
                                                    <span class="badge bg-label-secondary text-capitalize ms-2">Ended</span>
                                                @endif
                                                
                                            </td>
                                        @elseif (count($loanHistories) < 2)
                                            <td class="text-nowrap text-capitalize">
                                                @if ($loanHistory->balance > 0)
                                                    <a type="button" wire:click="handleLoanPaymentId({{ $loanHistory->id }})" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#modalPayLoan" href="">Payment</a>
                                                @endif
                                                <a type="button" wire:click="handleLoanPaymentEditId({{ $loanHistory->id }})" class="btn btn-sm btn-outline-secondary px-3" data-bs-toggle="modal" data-bs-target="#modalEditLoan"  href="">Edit</a>
                                                @if(!$loanHistory->is_active)
                                                    <span class="badge bg-label-secondary text-capitalize ms-2">Ended</span>
                                                @endif
                                            </td>
                                        @else
                                            <td class="text-nowrap">--</td>
                                        @endif
                                    </tr>

                                    {{-- Pay loan --}}
                                    <div class="modal fade" id="modalPayLoan" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-capitalize" id="modalPayLoanTitle">{{ $member->given_name }} {{ $member->surname }} repayment</h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>
                                                <form wire:submit="handleLoanPayment">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="date_paid" class="form-label text-capitalize fs-6">Date</label>
                                                                <input
                                                                    type="date"
                                                                    id="date_paid"
                                                                    wire:model="date_paid"
                                                                    class="form-control"
                                                                    placeholder="d/m/Y"
                                                                    required
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="amount_paid" class="form-label text-capitalize fs-6">Amount</label>
                                                                <input
                                                                    type="number"
                                                                    id="amount_paid"
                                                                    wire:model="amount_paid"
                                                                    class="form-control"
                                                                    placeholder="10000"
                                                                    required
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                            <label for="comment" class="form-label text-capitalize fs-6">Comment <small class="text-muted">(*Optional)</small></label>
                                                            <textarea
                                                                type="text"
                                                                id="comment"
                                                                wire:model="comment"
                                                                class="form-control"
                                                                rows="3"
                                                            ></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary text-capitalize">Pay loan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Edit loan --}}
                                    <div class="modal fade" id="modalEditLoan" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-capitalize" id="modalEditLoanTitle">{{ $member->given_name }} {{ $member->surname }} edit</h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>
                                                <form wire:submit="handleLoanPaymentEdit">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="edited_date_paid" class="form-label text-capitalize fs-6">Date</label>
                                                                <input
                                                                    type="date"
                                                                    id="edited_date_paid"
                                                                    wire:model="edited_date_paid"
                                                                    class="form-control"
                                                                    placeholder="d/m/Y"
                                                                    value="{{ old('edited_date_paid', date('d/m/Y')) }}"
                                                                    required
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="amount_paid" class="form-label text-capitalize fs-6">Amount</label>
                                                                <input
                                                                    type="number"
                                                                    id="amount_paid"
                                                                    wire:model="edited_amount_paid"
                                                                    class="form-control"
                                                                    placeholder="10000"
                                                                    value="{{ old('edited_amount_paid', $edited_amount_paid)}}"
                                                                    required
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                            <label for="comment" class="form-label text-capitalize fs-6">Comment <small class="text-muted">(*Optional)</small></label>
                                                            <textarea
                                                                type="text"
                                                                id="comment"
                                                                wire:model="edited_comment"
                                                                class="form-control"
                                                                rows="3"
                                                            >{{ old('edited_comment', $edited_comment)}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary text-capitalize">Pay loan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $loanHistories->links() !!}
                    </div>
                @else
                    <p class="mb-0 text-center text-capitalize">No credit found</p>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('updated-loan', (event) => {
                location.reload();
            });
        });
    </script>
@endpush