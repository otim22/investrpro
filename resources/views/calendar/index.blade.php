@extends('layouts.master.app')

@section('content')

@push('styles')
    <style>
        .fc-event {
            width: 140px;
            height: 80px;
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
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Calendar / </span>Events overview</h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="card p-4">
                <div wire:ignore id="calendar" style="width: 100%;"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-capitalize fs-5" id="eventModalLabel">Add event</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="eventTitle">
                    <span id="titleError" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-capitalize" id="addBtn">Add event</button>
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
        var events = [];
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,list'
            },
            initialView: 'dayGridMonth',
            timeZone: 'EAT',
            displayEventTime: true,
            events: @json($events),
            eventColor: '#378006',
            displayEventTime: true,
            editable: true,
            selectable: true,
            select: function(data) {
                $('#eventModal').modal('toggle');
                $('#addBtn').click(function() {
                    let title = $('#eventTitle').val();
                    let start_date = data.start.toISOString();
                    let end_date = data.end.toISOString();

                    $.ajax({
                        url: "{{ route('calendar.store') }}",
                        type: "POST",
                        dataType: "json",
                        data: { title, start_date, end_date },
                        success: function(response) {
                            $('#eventModal').modal('hide');
                            swal("Good job!", "Successful deleted event!", "success");
                            location.reload(true);
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                swal("Error!", "Oops... something is wrong!", "error");
                                $('#titleError').html(error.responseJSON.errors.title);
                            }
                        },
                    });
                });
            },
            eventDrop: function(data) {
                let id = data.event.id;
                let title = data.event.title;
                let start_date = data.event.start.toISOString();
                let end_date = data.event.end.toISOString();

                $.ajax({
                    url: "{{ route('calendar.update', '') }}" + "/" + id,
                    type: "PATCH",
                    dataType: "json",
                    data: { id, title, start_date, end_date },
                    success: function(response) {
                        swal("Good job!", "Successful updated event!", "success");
                    },
                    error: function(error) {
                        swal("Failed!", "Oops... Sorry, Didn't update event!", "error");
                    },
                });
            },
            eventClick : function(data) {
                let id = data.event.id;
                
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you'll not be able to recover the event!",
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
                                swal("Good job!", "Successful deleted event!", "success");
                            },
                            error: function(error) {
                                console.log(error);
                                swal("Failed!", "Oops... Sorry, Didn't delete event!", "error");
                            },
                        });
                        swal("Done! Your event has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your event is safe!");
                    }
                });
            }
        });
        
        $('#eventModal').on('hidden.bs.modal', function() {
            $('#addBtn').unbind();
        });

        calendar.render();
     </script>
@endpush