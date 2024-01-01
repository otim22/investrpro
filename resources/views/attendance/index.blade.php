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
                <div>
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">meeting / <a href="{{ route('meetings.index') }}">List of meetings</a> / <a href="{{ route('meetings.show', $meeting)}}">{{ $meeting->title }}</a> / </span>Attendance list</h5>
                </div>
                @can('add attendance')
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('attendances.create', $meeting) }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-plus'></i>
                            Add attendance
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="card px-4 py-3">
                @if (count($attendances))
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-capitalize fs-6" scope="col">Attendance title</th>
                                <th class="text-capitalize fs-6" scope="col">Member's name</th>
                                <th class="text-capitalize fs-6" scope="col">Status</th>
                                @can('show attendance actions')
                                    <th class="text-capitalize fs-6" scope="col">Actions</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td><a href="{{ route('attendances.show', [$meeting, $attendance]) }}">{{ $attendance->title }}</a></td>
                                    <td>
                                        {{ $attendance->member->given_name }} {{ $attendance->member->surname }}
                                    </td>
                                    <td>
                                        @if ($attendance->has_attended)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0c8218" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#c70a0a" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                            </svg>
                                        @endif
                                    </td>
                                    @can('show attendance actions')
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('attendances.edit', [$meeting, $attendance]) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit attendance
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmMeetingDeletion{{ $attendance->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete attendance
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                                <form action="{{ route('attendances.destroy', [$meeting, $attendance]) }}" class="hidden"
                                    id="delete-attendance-{{ $attendance->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <div class="modal fade" id="confirmMeetingDeletion{{ $attendance->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" meeting="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmMeetingDeletion{{ $attendance->id }}">
                                                    {{ $attendance->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        Are you sure deleting {{ $attendance->title }}?
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="event.preventDefault(); document.getElementById('delete-attendance-{{ $attendance->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $attendances->links() !!}
                    </div>
                @else
                    <p class="mb-0 text-center text-capitalize">No attendances found</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
