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
                    <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Calendar / </span>Calendar view</h5>
                    <div>
                        <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('investments.create') }}" aria-haspopup="true" aria-expanded="false">
                            <i class='me-2 bx bx-plus'></i>
                            Add meeting
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <div class="card p-4">
                    <div id="calendar" style="width: 100%;height:100vh;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
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
                right: 'dayGridMonth,timeGridWeek'
            },
            initialView: 'dayGridMonth',
            timeZone: 'EAT',
            displayEventTime: true,
            events: '/schedules',
            editable: true,
            selectable: true,
            selectHelper: true,

            eventContent: function(info) {
                var meeting = {};
                var slug = meeting.slug
                var eventTitle = info.event.title;
                var eventId = info.event.id;
                var eventElement = document.createElement('div');
                eventElement.innerHTML = '<span class="fw-bold" > ' + eventTitle + '</span>';
                var modalHeading= document.getElementById('eventModalHeader');
                var modalBody = document.getElementById('eventModalBody');
                var start = info.event.start;
                var end = info.event.end;

                eventElement.querySelector('span').addEventListener('click', function() {
                    $.ajax({
                        method: 'GET',
                        url: `/meeting/${eventId}`,
                        success: function(response) {
                            meeting = response
                            console.log(meeting)
                            $('#meetingModalLabel').text(`Created by ${meeting.user_id}`);
                            $('#responseSpan').text(meeting.meeting_link);
                            var link = document.getElementById('responseSpan');
                            link.href =`${meeting.meeting_link}`;
                        },
                        error: function(error) {
                            console.error('Error searching events:', error);
                        }
                    });
                    modalBody.innerHTML = 
                    '<div><div class="mb-3>span class="fw-bold text-capitalize">Meeting Name:</span><span class="fw-bold text-capitalize">' + info.event.title + 
                    '</span></div><div class="mb-3><span class="fw-bold text-capitalize">Starts On:</span><span class="fw-bold text-capitalize">' + start + 
                    '</span></div><div class="mb-3><span class="fw-bold text-capitalize">Ends On:</span><span class="fw-bold text-capitalize">' + end + 
                    '</span></div><div class="mb-3><span class="fw-bold text-capitalize">Link:</span><a class="fw-bold" id="responseSpan">'
                    '</a></div></div>'
                    
                    $('#eventDetailsModal').modal('show');
                });
                
                return {
                    domNodes: [eventElement]
                };
            },
        });

        calendar.render();

        function getMeeting(id) {
            $.ajax({
                method: 'GET',
                url: `/meeting/${id}`,
                success: function(response) {
                    console.log(response)
                },
                error: function(error) {
                    console.error('Error searching events:', error);
                }
            });
        }
     </script>
@endpush