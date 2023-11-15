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
                <h4 class="fw-bold text-capitalize"><span class="text-muted fw-light">Investments / </span>List of investments</h4>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('investments.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add investment
                    </a>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card p-3">
                @if (count($investments))
                    <div style="overflow-x: auto">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">Investment</th>
                                    <th class="text-nowrap">Maturity</th>
                                    <th class="text-nowrap">Expected returns</th>
                                    <th class="text-nowrap">Interest recieved & reinvested</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($investments as $investment)
                                    <tr>
                                        <td>
                                            <span class="text-nowrap text-capitalize">
                                                <span class="fw-bold">Type:</span>
                                                <a href="{{ route('investments.show', $investment) }}">
                                                    {{ $investment->investment_type }} <br />
                                                </a>
                                            </span>
                                            <span class="text-nowrap text-capitalize"> <span class="fw-bold">Date:</span> {{ $investment->formatDate($investment->date_of_investment) }}</span> <br />
                                            <span class="text-nowrap text-capitalize"> <span class="fw-bold">Duration:</span> {{ $investment->duration }} </span> <br />
                                            <span class="text-nowrap text-capitalize"> <span class="fw-bold">Interest rate:</span> {{ $investment->interest_rate }} </span> <br />
                                            
                                        </td>
                                        <td>
                                            <span class="text-nowrap text-capitalize"> <span class="fw-bold">Amount invested:</span> {{ number_format($investment->amount_invested) }} </span> <br />
                                            <span class="text-nowrap text-capitalize"> <span class="fw-bold">Date:</span> {{ $investment->formatDate($investment->date_of_maturity) }} </span>
                                        </td>
                                        <td>
                                            <span class="text-nowrap text-capitalize"> <span class="fw-bold">Before tax:</span> {{ $investment->expected_return_before_tax }} </span> <br />
                                            <span class="text-nowrap text-capitalize"> <span class="fw-bold">After tax:</span> {{ $investment->expected_return_after_tax }}
                                        </td>
                                        <td>
                                        @if($investment->interest_recieved_and_reinvested)
                                            <span class="text-nowrap text-capitalize"> <span class="fw-bold">Amount:</span> {{ $investment->interest_recieved_and_reinvested }}</span>
                                        @else
                                            --
                                        @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('investments.show', $investment) }}">
                                                        <i class='bx bx-list-check me-1'></i> Show
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('investments.edit', $investment) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmMemberDeletion{{ $investment->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <form action="{{ route('investments.destroy', $investment) }}" class="hidden"
                                        id="delete-mmember-{{ $investment->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="modal fade" id="confirmMemberDeletion{{ $investment->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmMemberDeletion{{ $investment->id }}">
                                                        {{ $investment->investment_type }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            Are you sure deleting {{ $investment->investment_type }} investment?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="event.preventDefault(); document.getElementById('delete-mmember-{{ $investment->id }}').submit();">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="mb-0 text-center text-capitalize">No investments found</p>
                @endif
            </div>
        </div>
      </div>
    </div>
@endsection
