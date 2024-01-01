@extends('layouts.master.app')

@section('content')

@push('styles')
    <style>
        .camel-sent {text-transform: capitalize;}
    </style>
@endpush

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">meeting / <a href="{{ route('meetings.index') }}">List of meetings</a> / <a href="{{ route('meetings.show', $meeting)}}">{{ $meeting->title }}</a> / <a href="{{ route('attendances.index', $meeting) }}">Attendance list</a> / </span>{{ $attendance->title }}</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('meetings.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to meetings
                    </a>
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
                                    placeholder="End of month meeting" 
                                    autofocus
                                    required
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
                                >
                                    <option value="{{ $attendance->member->id }}" selected>{{ $attendance->member->given_name }} {{ $attendance->member->surname }}</option>
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
                        <div class="row justify-content-end">
                            <div class="col-sm-9 mt-2">
                                <button type="submit" class="btn btn-primary text-capitalize">Update attendance</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection