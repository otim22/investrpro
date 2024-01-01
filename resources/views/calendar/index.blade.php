@extends('layouts.master.app')

@section('content')

@push('styles')
    <style>
        .fc-event {
            height: 100%;
            padding-left: 8px;
            display: flex;
            flex-wrap: wrap;
        }
    </style>
@endpush

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h5 class="fw-bold text-capitalize"><span class="text-muted fw-light">Calendar / </span>Meeting overview</h5>
                </div>
                <div>
                    <span class="btn btn-sm btn-secondary text-capitalize"> (Click or drag calendar to add meeting)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="card p-4">
                <div id="calendar" style="width: 100%;"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="meetingModal" tabindex="-1" aria-labelledby="meetingModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-capitalize fs-5" id="meetingModalLabel">Add meeting</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="meetingTitle">
                    <span id="titleError" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-capitalize" id="addBtn">Add meeting</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            timeZone: 'EAT',
            displayEventTime: true,
            events: @json($meetings),
            eventColor: '#3d914b',
            displayEventTime: true,
            editable: true,
            selectable: true,
            select: function(data) {
                $('#meetingModal').modal('toggle');
                $('#addBtn').click(function() {
                    let title = $('#meetingTitle').val();
                    let start = data.start.toISOString();
                    let end = data.end.toISOString();

                    $.ajax({
                        url: "{{ route('calendar.store') }}",
                        type: "POST",
                        dataType: "json",
                        data: { title, start, end },
                        success: function(response) {
                            $('#meetingModal').modal('hide');
                            swal("Good job!", "Successful deleted meeting!", "success");
                            location.reload(true);
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                swal("Error!", "Oops... something went wrong!", "error");
                                $('#titleError').html(error.responseJSON.errors.title);
                            }
                        },
                    });
                });
            },
            eventDrop: function(data) {
                let id = data.event.id;
                let title = data.event.title;
                let start = data.event.start.toISOString();
                let end = data.event.end.toISOString();

                $.ajax({
                    url: "{{ route('calendar.update', '') }}" + "/" + id,
                    type: "PATCH",
                    dataType: "json",
                    data: { id, title, start, end },
                    success: function(response) {
                        swal("Good job!", "Successful updated meeting!", "success");
                    },
                    error: function(error) {
                        swal("Failed!", "Oops... Didn't update meeting!", "error");
                    },
                });
            },
            eventClick : function(data) {
                let id = data.event.id;
                
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you'll not be able to recover the it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('calendar.destroy', '') }}" + "/" + id,
                            type: "DELETE",
                            dataType: "json",
                            success: function(response) {
                                location.reload(true);
                                swal("Good job!", "Successful deleted meeting!", "success");
                            },
                            error: function(error) {
                                console.log(error);
                                swal("Failed!", "Oops... Didn't delete meeting!", "error");
                            },
                        });
                        swal("Done! Your meeting has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your meeting is safe!");
                    }
                });
            }
        });
        
        $('#meetingModal').on('hidden.bs.modal', function() {
            $('#addBtn').unbind();
        });

        calendar.render();
     </script>
@endpush