@extends('layouts.master.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
          <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
              @include('messages.flash')
          </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-12 order-2 mb-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h4 class="fw-bold text-capitalize"><span class="text-muted fw-light">Expenses / </span>List of expenses</h4>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('expenses.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add expense
                    </a>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card p-3">
                @if (count($expenses))
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Date of expense</th>
                                <th>details</th>
                                <th>rate</th>
                                <th>Amount (UGX)</th>
                                <th>Total (UGX)</th>
                                <th>Designate</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>
                                        <a href="{{ route('expenses.show', $expense) }}">
                                            {{ $expense->formatDate($expense->date_of_expense) }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $expense->shortenSentence($expense->details) }}
                                    </td>
                                    <td>
                                        {{ $expense->rate }}
                                    </td>
                                    <td>
                                        {{ number_format($expense->amount, 2) }}
                                    </td>
                                    <td>
                                        {{ number_format($expense->total($expense->rate, $expense->amount), 2) }}
                                    </td>
                                    <td>
                                        {{ $expense->designate }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('expenses.show', $expense) }}">
                                                    <i class='bx bx-list-check me-1'></i> Show
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('expenses.edit', $expense) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmMemberDeletion{{ $expense->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <form action="{{ route('expenses.destroy', $expense) }}" class="hidden"
                                    id="delete-mmember-{{ $expense->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <div class="modal fade" id="confirmMemberDeletion{{ $expense->id }}"
                                    tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmMemberDeletion{{ $expense->id }}">
                                                    Expense on the date of {{ $expense->formatDate($expense->date_of_expense) }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        Are you sure deleting expense for the date of {{ $expense->formatDate($expense->date_of_expense) }}?
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="event.preventDefault(); document.getElementById('delete-mmember-{{ $expense->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mb-0 text-center text-capitalize">No expenses found</p>
                @endif
            </div>
        </div>
      </div>
    </div>
@endsection
