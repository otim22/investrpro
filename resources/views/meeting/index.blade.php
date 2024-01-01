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
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Meetings / </span> List of meetings</h5>
                </div>
                @can('add meeting')
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('meetings.create') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-plus'></i>
                            Add meeting
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="card px-4 py-3">
                @if (count($meetings))
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-capitalize fs-6" scope="col">Meeting title</th>
                                <th class="text-capitalize fs-6" scope="col">Start date</th>
                                <th class="text-capitalize fs-6" scope="col">End date</th>
                                <th class="text-capitalize fs-6" scope="col">Attendance</th>
                                @can('show meeting actions')
                                    <th class="text-capitalize fs-6" scope="col">Actions</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($meetings as $meeting)
                                <tr>
                                    <td><a href="{{ route('meetings.show', $meeting) }}">{{ $meeting->title }}</a></td>
                                    <td>{{ $meeting->start->format('d/m/Y h:ia') }}</td>
                                    <td>{{ $meeting->end->format('d/m/Y h:ia') }}</td>
                                    <td>
                                        @if (isset($meeting->attendance))
                                            <a class="btn btn-sm btn-outline-secondary text-capitalize px-4" href="{{ route('attendances.index', $meeting) }}">Attendance list</a>
                                        @elseif (is_null($meeting->attendance))
                                            <a class="btn btn-sm btn-outline-primary text-capitalize" href="{{ route('attendances.create', $meeting) }}">Add attendance list</a>
                                        @endif
                                    </td>
                                    @can('show meeting actions')
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('meetings.edit', $meeting) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit meeting
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmMeetingDeletion{{ $meeting->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete meeting
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                                <form action="{{ route('meetings.destroy', $meeting) }}" class="hidden"
                                    id="delete-meeting-{{ $meeting->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                                <div class="modal fade" id="confirmMeetingDeletion{{ $meeting->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" meeting="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmMeetingDeletion{{ $meeting->id }}">
                                                    {{ $meeting->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        Are you sure deleting {{ $meeting->title }}?
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="event.preventDefault(); document.getElementById('delete-meeting-{{ $meeting->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $meetings->links() !!}
                    </div>
                @else
                    <p class="mb-0 text-center text-capitalize">No meetings found</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
