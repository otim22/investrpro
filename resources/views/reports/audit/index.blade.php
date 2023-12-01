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
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Reports / </span>Audit reports</h5>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('audit-reports.create') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-plus'></i>
                            Add report
                        </a>
                    </div>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-3">
                    @if (count($auditReports))
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Download Link</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($auditReports as $auditReport)
                                    <tr>
                                        <td>
                                            <a href="{{ route('audit-reports.show', $auditReport)}}">
                                                {{ $auditReport->title }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($auditReport->description)
                                                {{ $auditReport->shortenSentence($auditReport->description) }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if ($auditReport->getFirstMediaUrl('report_attachement'))
                                                <a class="text-decoration-none" href="{{ route('audit-reports.download', $auditReport->id) }}" target="_blank">{{ \Str::limit(strip_tags($auditReport->getFirstMedia("report_attachement")->name), 35) }}</a>
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('audit-reports.show', $auditReport) }}">
                                                        <i class='bx bx-list-check me-1'></i> Show
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('audit-reports.edit', $auditReport) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmMemberDeletion{{ $auditReport->id }}">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <form action="{{ route('audit-reports.destroy', $auditReport) }}" class="hidden"
                                        id="delete-charge-{{ $auditReport->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="modal fade" id="confirmMemberDeletion{{ $auditReport->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmMemberDeletion{{ $auditReport->id }}">
                                                        {{ $auditReport->title }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-2">
                                                        <div class="col mb-0">
                                                            Are you sure to delete {{ $auditReport->title }}?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="event.preventDefault(); document.getElementById('delete-charge-{{ $auditReport->id }}').submit();">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mb-0 text-center text-capitalize">No Audit reports found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection