@push('styles')
    <style>
        .camel-sent {text-transform: capitalize;}
    </style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible text-capitalize" role="alert" style="padding: 10px;background-color: rgb(116, 203, 128);color: white;margin-bottom: 15px;">
                        <strong>{{ session('message') }}</strong>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Loan service / <a href="{{ route('loan-approval.index') }}">List of loan approvals</a> / </span>{{ $loanApplication->credit_type }}</h5>
                </div>
                <div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a wire:click="approveLoan({{ $loanApplication->id }})" class="dropdown-item btn-sm" href="javascript:void(0);">
                                <i class='me-2 bx bx-check-double'></i>
                                Approve loan
                            </a>
                            <a type="button" class="dropdown-item btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                <i class='me-2 bx bx-x'></i>
                                Reject loan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="modalCenterTitle">Rejection comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="comment" class="form-label text-capitalize fs-6">Comment</label>
                        <textarea
                            type="text"
                            id="comment"
                            wire:model="comment"
                            rows="2"
                            class="form-control @error('comment') is-invalid @enderror"
                            aria-describedby="comment"
                        >{{ old('comment')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close </button>
                <button wire:click="rejectLoan({{ $loanApplication->id }})" type="button" class="btn btn-primary text-capitalize">Save</button>
            </div>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="member_id">Member's name</label>
                        <div class="col-sm-9">
                            <select 
                                id="member_id" 
                                class="form-select @error('member_id') is-invalid @enderror" 
                                name="member_id"
                                aria-label="Default select member"
                                autofocus
                                disabled
                            >
                                <option value="{{ $loanApplication->member_id }}" selected>{{ $loanApplication->member->surname }} {{ $loanApplication->member->given_name }}</option>
                                @if($members)
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->surname }} {{ $member->given_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('member_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="financial_year">Financial year</label>
                        <div class="col-sm-9">
                            <div class="input-group input-group-merge">
                                <select 
                                    id="financial_year" 
                                    class="form-select @error('financial_year') is-invalid @enderror" 
                                    name="financial_year"
                                    aria-label="Default select year"
                                    disabled
                                >
                                    <option value="{{ $loanApplication->financial_year }}" selected>{{ $loanApplication->financial_year }}</option>
                                    @if($financialYears)
                                        @foreach($financialYears as $financialYear)
                                            <option value="{{ $financialYear->title }}">{{ $financialYear->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('financial_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="credit_type">Credit type</label>
                        <div class="col-sm-9">
                            <div class="input-group input-group-merge">
                                <select 
                                    id="credit_type" 
                                    class="form-select @error('credit_type') is-invalid @enderror" 
                                    name="credit_type"
                                    aria-label="Default select month"
                                    disabled
                                >
                                    <option value="{{ $loanApplication->credit_type }}" selected>{{ $loanApplication->credit_type }}</option>
                                    <option value="new loan">New Loan</option>
                                    <option value="top up">Top Up</option>
                            </select>
                                @error('credit_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="credit_purpose">Credit purpose</label>
                        <div class="col-sm-9">
                            <textarea
                                type="text"
                                id="credit_purpose"
                                name="credit_purpose"
                                rows="2"
                                class="form-control @error('credit_purpose') is-invalid @enderror"
                                aria-describedby="credit_purpose"
                                disabled
                            >{{ old('credit_purpose', $loanApplication->credit_purpose)}}</textarea>
                            @error('credit_purpose')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="amount_requested">Amount requested</label>
                        <div class="col-sm-9">
                            <input 
                                type="number" 
                                id="amount_requested" 
                                class="form-control @error('amount_requested') is-invalid @enderror" 
                                name="amount_requested"
                                value="{{ old('amount_requested', $loanApplication->amount_requested) }}"
                                placeholder="10000" 
                                disabled
                            />
                            @error('amount_requested')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="repayment_plan">Repayment plan</label>
                        <div class="col-sm-9">
                            <div class="input-group input-group-merge">
                                <select 
                                    id="repayment_plan" 
                                    class="form-select @error('repayment_plan') is-invalid @enderror" 
                                    name="repayment_plan"
                                    aria-label="Default select month"
                                    disabled
                                >
                                    <option value="{{ $loanApplication->repayment_plan }}" selected>{{ $loanApplication->repayment_plan }}</option>
                                    <option value="< 30 days">< 30 days</option>
                                    <option value="31 - 60 days">31 - 60 days</option>
                                    <option value="61 - 120 days">61 - 120 days</option>
                            </select>
                                @error('repayment_plan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="signature">Signature </label>
                        <div class="col-sm-9">
                            <input 
                                type="text" 
                                id="signature" 
                                class="form-control @error('signature') is-invalid @enderror" 
                                name="signature"
                                value="{{ old('signature', $loanApplication->signature) }}"
                                placeholder="John doore" 
                                disabled
                            />
                        </div>
                    </div>
                    @if ($loanApplication->comment)
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="comment">Rejection comment </label>
                            <div class="col-sm-9">
                                <textarea
                                type="text"
                                id="comment"
                                name="comment"
                                rows="2"
                                class="form-control @error('comment') is-invalid @enderror"
                                aria-describedby="comment"
                                disabled
                            >{{ old('comment', $loanApplication->comment)}}</textarea>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card px-2 py-2 mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 text-capitalize"><span class="fw-bold">Approve loan</span> {{ $loanApplication->approved_by_two }}</div>
                            <div>
                                <button wire:click="approveLoan({{ $loanApplication->id }})" class="btn btn-sm btn-outline-primary px-3 me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fingerprint me-2" viewBox="0 0 16 16">
                                        <path d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z"/>
                                        <path d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332q0 .613-.066 1.221A.5.5 0 0 1 6 8.447q.06-.555.06-1.115zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8m-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329"/>
                                        <path d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334m.3 1.67a.5.5 0 0 1 .449.546 10.7 10.7 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.7 9.7 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z"/>
                                        <path d="M3.902 4.222a5 5 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 4 4 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556m6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705M3.68 5.842a.5.5 0 0 1 .422.568q-.044.289-.044.59c0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.5 6.5 0 0 0 3.058 7q0-.375.054-.736a.5.5 0 0 1 .568-.422m8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.5 10.5 0 0 0 .584-2.678.5.5 0 0 1 .54-.456"/>
                                        <path d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865m-.89 1.257a.5.5 0 0 1 .04.706A5.48 5.48 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346m12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49"/>
                                    </svg>
                                    Accept
                                </button>
                                <button class="btn btn-sm btn-outline-danger px-3" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x me-2" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                    Reject
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
