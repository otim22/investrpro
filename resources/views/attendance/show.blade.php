@extends('layouts.master.app')

@section('content')

@push('styles')
    <style>
        .camel-sent {text-transform: capitalize;}
    </style>
@endpush

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12">
            @include('messages.flash')
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">meeting / <a href="{{ route('meetings.index') }}">List of meetings</a> / <a href="{{ route('meetings.show', $meeting)}}">{{ $meeting->title }}</a> / <a href="{{ route('attendances.index', $meeting) }}">Attendance list</a> / </span>{{ $attendance->title }}</h5>
                </div>
                @can('show attendance actions')
                    <div>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item btn-sm" href="{{ route('attendances.edit', [$meeting, $attendance]) }}">
                                    <i class='me-2 bx bxs-edit-alt'></i>
                                    Edit attendance
                                </a>
                                <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#confirmAttendanceDeletion{{ $attendance->id }}">
                                    <i class='me-2 bx bx-trash'></i>
                                    Delete attendance
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <form action="{{ route('attendances.destroy', [$meeting, $attendance]) }}" class="hidden" id="delete-attendance-{{ $attendance->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmAttendanceDeletion{{ $attendance->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
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
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-attendance-{{ $attendance->id }}').submit();">Delete</button>
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
                    <form method="POST" action="{{ route('attendances.update', [$meeting, $attendance]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="title">Attendance title</label>
                            <div class="col-sm-9">
                                <input 
                                    type="text" 
                                    id="title" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    name="title"
                                    value="{{ old('title', $attendance->title) }}"
                                    placeholder="End of month meeting attendance" 
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
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="member_id">Member's name</label>
                            <div class="col-sm-9">
                                <select 
                                    id="member_id" 
                                    class="form-select @error('member_id') is-invalid @enderror" 
                                    name="member_id"
                                    aria-label="Default select member"
                                    disabled
                                >
                                    <option selected>{{ $attendance->member->given_name }} {{ $attendance->member->surname }}</option>
                                    @if($members)
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->surname }} {{ $member->given_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('member_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="has_attended">Attendance Status</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <select 
                                        id="has_attended" 
                                        class="form-select @error('has_attended') is-invalid @enderror" 
                                        name="has_attended"
                                        aria-label="Default select month"
                                        disabled
                                    >
                                        @if ($attendance->has_attended)
                                            <option value="{{ $attendance->has_attended }}" selected>Yes, attended</option>
                                        @else 
                                            <option value="{{ $attendance->has_attended }}" selected>No, did not attend</option>
                                        @endif
                                        <option value="0">No, did not attend the meeting</option>
                                        <option value="1">Yes, attended the meeting</option>
                                </select>
                                    @error('has_attended')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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