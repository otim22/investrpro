@extends('admin.layouts.app')

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
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">General / <a href="{{ route('admin.asset-types.index') }}">List of asset types</a> / </span>{{ $assetType->asset_type }}</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('admin.asset-types.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to asset types
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.asset-types.update', $assetType) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="basic-default-name">Company name</label>
                            <div class="col-sm-10">
                                <select 
                                    id="company_id" 
                                    class="form-select @error('company_id') is-invalid @enderror" 
                                    name="company_id"
                                    aria-label="Default select member"
                                    autofocus
                                >
                                    <option value="{{ $assetType->company_id }}" selected>{{ $assetType->company->company_name }}</option>
                                    @if(count($companies) > 0)
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="asset_type">Asset type</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="asset_type" 
                                    class="form-control @error('asset_type') is-invalid @enderror" 
                                    name="asset_type"
                                    value="{{ old('asset_type', $assetType->asset_type) }}"
                                    placeholder="January" 
                                />
                                @error('asset_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-secondary camel-sent fs-6" for="description">Description</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <textarea
                                        type="text"
                                        id="description"
                                        name="description"
                                        class="form-control"
                                    >{{ old('description', $assetType->description) }} </textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10 mt-2">
                                <button type="submit" class="btn btn-primary text-capitalize">Update asset type</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection