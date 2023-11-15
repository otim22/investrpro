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
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Asset settings / </span>List of asset settings</h5>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('asset-settings.create') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-plus'></i>
                            Add asset setting
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    @if (count($assetSettings))
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Asset Type</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($assetSettings as $assetSetting)
                                    <tr>
                                        <td>
                                            <a href="{{ route('asset-settings.show', $assetSetting)}}">
                                                {{ $assetSetting->asset_type }}
                                            </a>
                                        </td>
                                        @if($assetSetting->description)
                                            <td>
                                                {{ $assetSetting->shortenSentence($assetSetting->description) }}
                                            </td>
                                        @else
                                            <td>
                                                --
                                            </td>
                                        @endif
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('asset-settings.show', $assetSetting) }}">
                                                        <i class='bx bx-list-check me-1'></i> Show
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('asset-settings.edit', $assetSetting) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmMemberDeletion{{ $assetSetting->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <form action="{{ route('asset-settings.destroy', $assetSetting) }}" class="hidden"
                                        id="delete-charge-{{ $assetSetting->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="modal fade" id="confirmMemberDeletion{{ $assetSetting->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmMemberDeletion{{ $assetSetting->id }}">
                                                        Setting for {{ $assetSetting->asset_type }} charge</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            Are you sure deleting {{ $assetSetting->asset_type }} setting?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="event.preventDefault(); document.getElementById('delete-charge-{{ $assetSetting->id }}').submit();">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mb-0 text-center text-capitalize">No asset settings found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
