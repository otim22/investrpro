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
                        <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Membership / </span> List of members</h5>
                    </div>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                            href="{{ route('members.create') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-plus'></i>
                            Add member
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    @if (count($members) > 0)
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-capitalize fs-6">Identification</th>
                                    <th class="text-capitalize fs-6">Address</th>
                                    <th class="text-capitalize fs-6">Occupation</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($members as $member)
                                    <tr>
                                        <td>
                                            <a href="{{ route('members.show', $member)}}">
                                                <div>
                                                    {{ $member->surname }} {{ $member->given_name }} {{ $member->other_name }}
                                                </div>
                                            
                                                <div>
                                                    {{ $member->nin }}
                                                </div>

                                                <div>
                                                    @if($member->passport_number)
                                                        {{ $member->passport_number }}
                                                    @endif
                                                </div>
                                                <div>
                                                    {{ $member->date_of_birth }}
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $member->address }}
                                            </div>
                                            
                                            <div>
                                                {{ $member->email }}
                                            </div>
                                            <div>
                                                {{ $member->telephone_number }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $member->occupation }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('members.show', $member) }}">
                                                        <i class='bx bx-list-check me-1'></i> Show
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('members.edit', $member) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmmemberDeletion{{ $member->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <form action="{{ route('members.destroy', $member) }}" class="hidden"
                                        id="delete-member-{{ $member->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="modal fade" id="confirmmemberDeletion{{ $member->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmmemberDeletion{{ $member->id }}">
                                                        {{ $member->name }} member</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            Are you sure to delete "{{ $member->name }}" member?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="event.preventDefault(); document.getElementById('delete-member-{{ $member->id }}').submit();">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mb-0 text-center text-capitalize">No member found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
