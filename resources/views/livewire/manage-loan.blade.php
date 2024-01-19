<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Loan service / </span> Manage loans</h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="card p-3">
                @if (count($activeLoans) > 0)
                    <div style="overflow-x: auto">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Ref code</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">member's name</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Credit type</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Amount</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Repayment plan</th>
                                    <th class="text-capitalize text-nowrap fs-6" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($activeLoans as $activeLoan)
                                    <tr>
                                        {{-- @can('show meeting actions') --}}
                                            <td class="text-nowrap"><a href="{{ route('settlements.show', $activeLoan->id)}}">{{ $activeLoan->ref_code }}</a></td>
                                        {{-- @endcan --}}
                                        <td class="text-nowrap">{{ $activeLoan->member->surname }} {{ $activeLoan->member->given_name }}</td>
                                        <td class="text-nowrap">{{ $activeLoan->credit_type }}</td>
                                        <td class="text-nowrap">{{ number_format($activeLoan->amount_requested) }}/-</td>
                                        <td class="text-nowrap">{{ $activeLoan->repayment_plan }}</td>
                                        @if ($activeLoan->approved_by_one && $activeLoan->approved_by_two)
                                            <td class="text-nowrap"><span class="badge bg-label-success text-capitalize">Approved</span></td>
                                        @elseif ($activeLoan->approved_by_one || $activeLoan->approved_by_two)
                                            <td class="text-nowrap"><span class="badge bg-label-secondary text-capitalize px-3">Pending</span></td>
                                        @elseif($activeLoan->comment)
                                            <td class="text-nowrap"><span class="badge bg-label-danger text-capitalize">Cancelled</span></td>
                                        @else
                                            <td class="text-nowrap"><span class="badge bg-label-warning text-capitalize">Unapproved</span></td>
                                        @endif
                                    </tr>
                                    <form action="{{ route('loan-application.destroy', $activeLoan) }}" class="hidden"
                                        id="delete-loan-app-{{ $activeLoan->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="modal fade" id="confirmLoanAppDeletion{{ $activeLoan->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" meeting="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmLoanAppDeletion{{ $activeLoan->id }}">
                                                        {{ $activeLoan->credit_type }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            Are you sure deleting {{ $activeLoan->credit_type }}?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="event.preventDefault(); document.getElementById('delete-loan-app-{{ $activeLoan->id }}').submit();">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {!! $activeLoans->links() !!}
                    </div>
                @else
                    <p class="mb-0 text-center text-capitalize">No approved loans found</p>
                    
                @endif
            </div>
        </div>
    </div>
</div>

