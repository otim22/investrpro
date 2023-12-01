@extends('layouts.master.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Archive / <a href="{{ route('sop.index') }}">Standard Operating Procedure</a> / </span>{{ $sop->title }}</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('sop.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to SOP
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('sop.update', $sop) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title">Title</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="title" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    name="title"
                                    value="{{ old('title', $sop->title) }}"
                                    placeholder="January" 
                                    autofocus
                                />
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="description">Description</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <textarea
                                        type="text"
                                        id="description"
                                        name="description"
                                        class="form-control"
                                    >{{ old('description', $sop->description) }} </textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="amount">Attach document</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="file" 
                                        class="form-control" 
                                        name="doc_attachement" 
                                        accept=".doc,.docx,.pdf" 
                                        id="doc_attachement" 
                                    />
                                    <label class="input-group-text" for="doc_attachement">Upload</label>
                                </div>
                                <div class="mt-2">
                                    @if($sop->getFirstMediaUrl("doc_attachement"))
                                        <label for="doc_attachement"><small class="text-warning">Current form (* Uploading a form overrides current one)</small> </label><br />
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-right-short pb-1" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                            </svg>                                         
                                            {{ $sop->getFirstMedia("doc_attachement")->name }}
                                        </div>
                                    @endif
                                </div>
                                @error('doc_attachement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10 mt-2">
                                <button type="submit" class="btn btn-primary text-capitalize">Update constitution</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection