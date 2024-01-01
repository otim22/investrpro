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
                <div class="d-flex py-1 justify-content-between">
                    <div>
                        <h5 class="fw-bold text-capitalize py-1"><span class="text-muted fw-light">Members / <a href="{{ route('members.show', $member) }}">{{ $member->surname }} {{ $member->given_name }} </a> / </span>Next of Kin</h5>
                    </div>
                    @can('add next of kin')
                        <div>
                            <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                                href="{{ route('next-of-kin.create', $member) }}" aria-haspopup="true" aria-expanded="false">
                                <i class='me-2 bx bx-plus'></i>
                                Create next of kin
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    @if ($member->nextOfKin)
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-capitalize fs-6">Identification</th>
                                    <th class="text-capitalize fs-6">Address</th>
                                    <th class="text-capitalize fs-6">Contact</th>
                                    <th class="text-capitalize fs-6">Relationship</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>
                                        <a href="{{ route('next-of-kin.show', [$member, $member->nextOfKin]) }}">
                                            <div>
                                                {{ $member->nextOfKin->surname }}
                                                {{ $member->nextOfKin->given_name }}
                                                {{ $member->nextOfKin->other_name }}
                                            </div>
                                            <div>{{ $member->nextOfKin->nin }}</div>
                                            <div>{{ $member->nextOfKin->passport_number }}</div>
                                        </a>
                                    </td>
                                    <td>
                                        <div>{{ $member->nextOfKin->address }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $member->nextOfKin->email }}</div>
                                        <div>{{ $member->nextOfKin->telephone_number }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $member->nextOfKin->relationship }}</div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('next-of-kin.show', [$member, $member->nextOfKin]) }}">
                                                    <i class='bx bx-list-check me-1'></i> Show
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('next-of-kin.edit', [$member, $member->nextOfKin]) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmmemberDeletion{{ $member->nextOfKin->id }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <form action="{{ route('next-of-kin.delete', [$member, $member->nextOfKin]) }}" class="hidden"
                                    id="delete-kin-{{ $member->nextOfKin->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <div class="modal fade" id="confirmmemberDeletion{{ $member->nextOfKin->id }}"
                                    tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-capitalize"
                                                    id="confirmmemberDeletion{{ $member->nextOfKin->id }}">
                                                    The next of kin is {{ $member->nextOfKin->surname }} {{ $member->nextOfKin->given_name }} </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        Are you sure to delete, "{{ $member->nextOfKin->surname }} {{ $member->nextOfKin->given_name }}" as kin?
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="event.preventDefault(); document.getElementById('delete-kin-{{ $member->nextOfKin->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    @else
                        <p class="mb-0 text-center text-capitalize">No next of kin found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
