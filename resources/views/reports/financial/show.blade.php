@extends('layouts.master.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pdf_custom.css') }}" />
@endpush

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
                <div>
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Reports / <a href="{{ route('financial-reports.index') }}">List of financial reports</a> / </span>{{ $financialReport->title }}</h5>
                </div>
                @can('show financial report actions')
                <div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item btn-sm" href="{{ route('financial-reports.edit', $financialReport) }}">
                                <i class='me-2 bx bxs-edit-alt'></i>
                                Edit report
                            </a>
                            <a class="dropdown-item btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#confirmReportDeletion{{ $financialReport->id }}">
                                <i class='me-2 bx bx-trash'></i>
                                Delete report
                            </a>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
            <form action="{{ route('financial-reports.destroy', $financialReport) }}" class="hidden" id="delete-charge-{{ $financialReport->id }}"
                method="POST">
                @csrf
                @method('delete')
            </form>
            <div class="modal fade" id="confirmReportDeletion{{ $financialReport->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmReportDeletion{{ $financialReport->id }}">
                                {{ $financialReport->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-0">
                                    Are you sure to delete {{ $financialReport->title }}?
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="event.preventDefault(); document.getElementById('delete-charge-{{ $financialReport->id }}').submit();">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card px-3 py-2">
                <div class="card-body">
                    <div>
                        <div class="mb-3">
                            @include('pdf.pdf_viewer')
                        </div>

                        <div class="mb-3">
                            <div class="fw-bold">
                                Description
                            </div>
                            <div>
                                {{ $financialReport->description }}
                            </div>
                        </div>
                        <div>
                            <div class="text-capitalize fw-bold">
                                Download link
                            </div>
                            <div>
                                @if ($financialReport->getFirstMediaUrl('report_attachement'))
                                    <div><a class="text-decoration-none" href="{{ route('financial-reports.download', $financialReport->id) }}" target="_blank">{{ $financialReport->getFirstMedia("report_attachement")->name }}</a></div>
                                @else
                                    <div>--</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script type="module">
        var {
            pdfjsLib
        } = globalThis;
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js"

        let pdfState = {
            pdf: null,
            currentPage: 1,
            zoom: 1.5
        }
        let pdfRendering = false;

        function getPdf() {
            let url = {{ Js::from($financialReportUrl) }};
            if (url) {
                return {
                    url
                };
            }
        }

        let config = getPdf();
        loadPdf(config.url);

        function loadPdf(url) {
            var loadingTask = pdfjsLib.getDocument(url);
            loadingTask.promise.then(function(pdf) {
                pdfState.pdf = pdf;
                render();
            });
            controls();
        }

        function render() {
            pdfRendering = true;
            document.getElementById('current_page').textContent = pdfState.currentPage;
            document.getElementById('num_pages').textContent = pdfState.pdf._pdfInfo.numPages;

            pdfState.pdf.getPage(pdfState.currentPage).then((page) => {
                var canvas = document.getElementById("pdf_renderer");
                if (canvas) {
                    var ctx = canvas.getContext('2d');
                    var viewport = page.getViewport({
                        scale: pdfState.zoom
                    });

                    console.log(viewport)
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;

                    page.render({
                        canvasContext: ctx,
                        viewport: viewport
                    });
                }
            }, function(reason) {
                console.log(reason);
            });
        }

        function controls() {
            if (document.getElementById('go_previous') &&
                document.getElementById('go_next') &&
                document.getElementById('current_page') &&
                document.getElementById('zoom_in') &&
                document.getElementById('zoom_out')
            ) {
                document.getElementById('go_previous').addEventListener('click', (e) => {
                    if (pdfState.pdf == null || pdfState.currentPage == 1)
                        return;
                    pdfState.currentPage -= 1;
                    document.getElementById("current_page").value = pdfState.currentPage;
                    render();
                });

                document.getElementById('go_next').addEventListener('click', (e) => {
                    if (pdfState.pdf == null || pdfState.currentPage >= pdfState.pdf._pdfInfo.numPages)
                        return;
                    pdfState.currentPage += 1;
                    document.getElementById("current_page").value = pdfState.currentPage;
                    render();
                });

                document.getElementById('current_page').addEventListener('keypress', (e) => {
                    if (pdfState.pdf == null) return;

                    // Get key code
                    let code = (e.keyCode ? e.keyCode : e.which);

                    // If key code matches that of the Enter key
                    if (code == 13) {
                        let desiredPage = document.getElementById('current_page').valueAsNumber;

                        if (desiredPage >= 1 && desiredPage <= pdfState.pdf._pdfInfo.numPages) {
                            pdfState.currentPage = desiredPage;
                            document.getElementById("current_page").value = desiredPage;
                            render();
                        }
                    }
                });

                document.getElementById('zoom_in').addEventListener('click', (e) => {
                    if (pdfState.pdf == null) return;
                    pdfState.zoom += 0.5;
                    render();
                });

                document.getElementById('zoom_out').addEventListener('click', (e) => {
                    if (pdfState.pdf == null) return;
                    pdfState.zoom -= 0.5;
                    render();
                });
            }
        }
    </script>
@endpush
