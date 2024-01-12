@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                @include('messages.flash')
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Loan service / </span>List of loan applications</h5>
                    @can('add hr manual')
                        <div>
                            <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('loan-application.create') }}" aria-haspopup="true" aria-expanded="false">
                                <i class='me-2 bx bx-plus'></i>
                                Apply for loan
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    @if (count($loanApplications) > 0)
                        <div style="overflow-x: auto">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">member's name</th>
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">Credit type</th>
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">Purpose</th>
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">Amount</th>
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">Repayment plan</th>
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">Status</th>
                                        {{-- @can('show meeting actions') --}}
                                            <th class="text-capitalize text-nowrap fs-6" scope="col">Actions</th>
                                        {{-- @endcan --}}
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($loanApplications as $loanApplication)
                                        <tr>
                                            <td class="text-nowrap"><a href="{{ route('loan-application.show', $loanApplication) }}">{{ $loanApplication->member->surname }} {{ $loanApplication->member->given_name }}</a></td>
                                            <td class="text-nowrap">{{ $loanApplication->credit_type }}</td>
                                            <td class="text-nowrap">{{ $loanApplication->shortenSentence($loanApplication->credit_purpose) }}</td>
                                            <td class="text-nowrap">{{ number_format($loanApplication->amount_requested) }}/-</td>
                                            <td class="text-nowrap">{{ $loanApplication->repayment_plan }}</td>
                                            @if ($loanApplication->approved_by_one && $loanApplication->approved_by_two)
                                                <td class="text-nowrap"><button class="btn btn-sm btn-outline-success">Approved</button></td>
                                            @elseif ($loanApplication->approved_by_one || $loanApplication->approved_by_two)
                                                <td class="text-nowrap"><button class="btn btn-sm btn-outline-secondary px-3">Pending</button></td>
                                            @elseif($loanApplication->comment)
                                                <td class="text-nowrap"><button class="btn btn-sm btn-outline-danger">Cancelled</button></td>
                                            @else
                                                <td class="text-nowrap"><button class="btn btn-sm btn-outline-warning">Unapproved</button></td>
                                            @endif
                                            {{-- @can('show meeting actions') --}}
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('loan-application.edit', $loanApplication) }}">
                                                                <i class="bx bx-edit-alt me-1"></i> Edit appliaction
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmLoanAppDeletion{{ $loanApplication->id }}">
                                                                <i class="bx bx-trash me-1"></i> Delete appliaction
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            {{-- @endcan --}}
                                        </tr>
                                        <form action="{{ route('loan-application.destroy', $loanApplication) }}" class="hidden"
                                            id="delete-loan-app-{{ $loanApplication->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <div class="modal fade" id="confirmLoanAppDeletion{{ $loanApplication->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" meeting="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmLoanAppDeletion{{ $loanApplication->id }}">
                                                            {{ $loanApplication->credit_type }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                Are you sure deleting {{ $loanApplication->credit_type }}?
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="event.preventDefault(); document.getElementById('delete-loan-app-{{ $loanApplication->id }}').submit();">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $loanApplications->links() !!}
                    </div>
                    @else
                        <p class="mb-0 text-center text-capitalize">No loan applications found</p>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
