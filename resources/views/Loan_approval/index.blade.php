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
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Loan service / </span>List of loan approvals</h5>
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
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">Credit Purpose</th>
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">Amount requested</th>
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">Repayment plan</th>
                                        <th class="text-capitalize text-nowrap fs-6" scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($loanApplications as $loanApplication)
                                        <tr>
                                            <td class="text-nowrap"><a href="{{ route('loan-approval.show', $loanApplication) }}">{{ $loanApplication->member->surname }} {{ $loanApplication->member->given_name }}</a></td>
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
                                        </tr>
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
