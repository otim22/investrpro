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
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Expenses / </span>List of Expenses</h5>
                @can('add expense')
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('expenses.create') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-plus'></i>
                            Add expense
                        </a>
                    </div>
                @endcan
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card px-3 py-4" style="overflow-x: auto">
                    @if (count($expenses) > 0)
                        <livewire:expense-table />
                    @else
                        <p class="mb-0 text-center text-capitalize">No expenses found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection