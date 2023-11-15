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
                <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Asset settings / <a href="{{ route('asset-settings.index') }}">List of asset settings</a> / </span>{{ $assetSetting->asset_type }}</h5>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button"
                        href="{{ route('asset-settings.index') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-arrow-back'></i>
                        Back to assets
                    </a>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item btn-sm" href="{{ route('asset-settings.edit', $assetSetting) }}">
                            <i class='me-2 bx bxs-edit-alt'></i>
                            Edit asset
                        </a>
                        <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#confirmAssetDeletion{{ $assetSetting->id }}">
                            <i class='me-2 bx bx-trash'></i>
                            Delete asset
                        </a>
                    </div>
                </div>
            </div>
            <form action="{{ route('asset-settings.destroy', $assetSetting) }}" class="hidden" id="delete-asset-{{ $assetSetting->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmAssetDeletion{{ $assetSetting->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmAssetDeletion{{ $assetSetting->id }}">
                                Setting for {{ $assetSetting->asset_type }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure deleting {{ $assetSetting->asset_type }}?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-asset-{{ $assetSetting->id }}').submit();">Delete</button>
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
                    <form method="POST" action="{{ route('asset-settings.update', $assetSetting) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="asset_type">Title</label>
                            <div class="col-sm-10">
                                <input 
                                    type="text" 
                                    id="asset_type" 
                                    class="form-control @error('asset_type') is-invalid @enderror" 
                                    name="asset_type"
                                    value="{{ old('asset_type', $assetSetting->asset_type) }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" for="description">Description</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <textarea
                                        type="text"
                                        id="description"
                                        name="description"
                                        class="form-control"
                                        disabled
                                    >{{ old('description', $assetSetting->description) }} </textarea>
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