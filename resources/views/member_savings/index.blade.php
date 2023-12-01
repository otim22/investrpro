@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Fund / </span>Monthly savings</h5>
                </div>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('member-savings.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add saving
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card p-3">
                @if (count($memberSavings))
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Member names</th>
                                <th>Premium amount (UGX)</th>
                                <th>Month paid for</th>
                                <th>Date of payment</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($memberSavings as $memberSaving)
                                <tr>
                                    <td>
                                        <a href="{{ route('member-savings.show', $memberSaving) }}">
                                            {{ $memberSaving->member->surname }} {{ $memberSaving->member->given_name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ number_format($memberSaving->premium) }}
                                    </td>
                                    <td>
                                        {{ $memberSaving->month }}
                                    </td>
                                    <td>
                                        {{ $memberSaving->formatDate($memberSaving->date_paid) }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('member-savings.show', $memberSaving) }}">
                                                    <i class='bx bx-list-check me-1'></i> Show
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('member-savings.edit', $memberSaving) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmMemberDeletion{{ $memberSaving->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <form action="{{ route('member-savings.destroy', $memberSaving) }}" class="hidden"
                                    id="delete-mmember-{{ $memberSaving->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <div class="modal fade" id="confirmMemberDeletion{{ $memberSaving->id }}"
                                    tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="confirmMemberDeletion{{ $memberSaving->id }}">
                                                    {{ $memberSaving->member->surname }} {{ $memberSaving->member->given_name }}  premium</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        Are you sure deleting {{ $memberSaving->member->surname }} premium?
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="event.preventDefault(); document.getElementById('delete-mmember-{{ $memberSaving->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mb-0 text-center text-capitalize">No member savings found</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
