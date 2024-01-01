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
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">meeting / <a href="{{ route('meetings.index') }}">List of meetings</a> / </span>{{ $meeting->title }}</h5>
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
                    <form method="POST" action="{{ route('meetings.update', $meeting) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

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
                            <label class="col-sm-3 col-form-label text-secondary camel-sent fs-6" for="start">Start date</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input 
                                        type="datetime-local" 
                                        id="start" 
                                        class="form-control @error('start') is-invalid @enderror" 
                                        name="start"
                                        value="{{ old('start', $meeting->start) }}"
                                        required
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
                                        required
                                    />
                                    @error('end')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-9 mt-2">
                                <button type="submit" class="btn btn-primary text-capitalize">Update meeting</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection