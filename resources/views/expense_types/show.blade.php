@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">General / <a href="{{ route('expense-types.index') }}">List of expense types</a> / </span>{{ $expenseType->expense_type }}</h5>
                </div>
                <div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item btn-sm" href="{{ route('expense-types.edit', $expenseType) }}">
                                <i class='me-2 bx bxs-edit-alt'></i>
                                Edit expense type
                            </a>
                            <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#confirmexpenseDeletion{{ $expenseType->id }}">
                                <i class='me-2 bx bx-trash'></i>
                                Delete expense type
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('expense-types.destroy', $expenseType) }}" class="hidden" id="delete-expense-{{ $expenseType->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmexpenseDeletion{{ $expenseType->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-capitalize">
                            <h5 class="modal-title" id="confirmexpenseDeletion{{ $expenseType->id }}">
                                {{ $expenseType->expense_type }} type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure deleting {{ $expenseType->expense_type }}?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-expense-{{ $expenseType->id }}').submit();">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('expense-types.update', $expenseType) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="expense_type">Title</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="expense_type" 
                                    class="form-control @error('expense_type') is-invalid @enderror" 
                                    name="expense_type"
                                    value="{{ old('expense_type', $expenseType->expense_type) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="description">Description</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <textarea
                                        type="text"
                                        id="description"
                                        name="description"
                                        class="form-control"
                                        disabled
                                    >{{ old('description', $expenseType->description) }} </textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection