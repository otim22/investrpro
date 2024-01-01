@extends('layouts.master.app')

@section('content')

@push('styles')
    <style>
        .camel-sent {text-transform: capitalize;}
    </style>
@endpush

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-2">
        <div class="col-12 col-lg-12">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">meeting / <a href="{{ route('meetings.index') }}">List of meetings</a> / </span>{{ $meeting->title }}</h5>
                {{-- @can('show meeting actions')
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('meetings.index') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-arrow-back'></i>
                            Back to meetings
                        </a>
                    </div>
                @endcan --}}
                @can('show meeting actions')
                    <div>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item btn-sm" href="{{ route('meetings.edit', $meeting) }}">
                                    <i class='me-2 bx bxs-edit-alt'></i>
                                    Edit meeting
                                </a>
                                <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#confirmMeetingDeletion{{ $meeting->id }}">
                                    <i class='me-2 bx bx-trash'></i>
                                    Delete meeting
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <form action="{{ route('meetings.destroy', $meeting) }}" class="hidden" id="delete-meeting-{{ $meeting->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmMeetingDeletion{{ $meeting->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
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
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-meeting-{{ $meeting->id }}').submit();">Delete</button>
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
                    <form method="POST" action="{{ route('meetings.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="title">Meeting title</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="title" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    name="title"
                                    value="{{ old('title', $meeting->title) }}"
                                    placeholder="End of month meeting" 
                                    autofocus
                                    disabled
                                />
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="start">Start date</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input 
                                        type="datetime-local" 
                                        id="start" 
                                        class="form-control @error('start') is-invalid @enderror" 
                                        name="start"
                                        value="{{ old('start', $meeting->start) }}"
                                        disabled
                                    />
                                    @error('start')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="end">End date</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input 
                                        type="datetime-local" 
                                        id="end" 
                                        class="form-control @error('end') is-invalid @enderror" 
                                        name="end"
                                        value="{{ old('end', $meeting->end) }}"
                                        disabled
                                    />
                                    @error('end')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="end">Attendance</label>
                            <div class="col-sm-9">
                                @if (isset($meeting->attendance))
                                    <a class="btn btn-sm btn-outline-secondary text-capitalize" href="{{ route('attendances.index', $meeting) }}">Attendance list</a>
                                @elseif (is_null($meeting->attendance))
                                    <a class="btn btn-sm btn-outline-primary text-capitalize" href="{{ route('attendances.create', $meeting) }}">Add attendance list</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection