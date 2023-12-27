<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            @include('messages.flash')
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold py-1 text-capitalize"><span class="text-muted fw-light">Calendar / </span>Event view</h5>
                <div>
                    <a class="btn btn-sm btn-outline-primary text-capitalize" type="button" href="{{ route('investments.create') }}" aria-haspopup="true" aria-expanded="false">
                        <i class='me-2 bx bx-plus'></i>
                        Add Event
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
            Launch demo modal
        </button>
        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
            <div class="card p-4">
                <div wire:ignore id="calendar" style="width: 100%;"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade {{ $isOpen ? 'show' : '' }}" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="{{ $isOpen ? 'fasle' : 'true' }}" aria-modal="{{ $isOpen ? 'true' : 'false' }}" style="{{$isOpen ? 'display: block;' : '' }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="eventModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Body here</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
    <script>
        document.addEventListener('livewire:initialized', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,list'
                },
                initialView: 'dayGridMonth',
                timeZone: 'EAT',
                displayEventTime: true,
                editable: true,
                selectable: true,
                events: @json($events),
                eventColor: '#378006',
                select: function(data) {
                    var event_name = prompt('Event name:');
                    var eventModal = document.getElementById('eventModal');
                    @this.openModal()
                    console.log(eventModal);
                    eventModal.modal(open);
                    Livewire.on('showModal', (e) => {
                        let modal = Modal.getOrCreateInstance(modalsElement)
                        modal.show();

                    });
                    if (!event_name) {
                        return;
                    }
                    @this.newEvent(event_name, data.start.toISOString(), data.end.toISOString())
                        .then(function (id) {
                            calendar.addEvent({
                                id: id,
                                title: event_name,
                                start: data.startStr,
                                end: data.endStr,
                            }),
                            calendar.unselect()
                        }
                    );
                },
                eventDrop: function (data) {
                    @this.updateEvent(
                        data.event.id,
                        data.event.name,
                        data.event.start.toISOString(),
                        data.event.end.toISOString()
                    ).then(function () {
                        alert('Moved');
                    })
                },
                eventClick : function(info) {
                    if (info.event.id) {
                        var event = calendar.getEventById(info.event.id);
                        event.remove();
                    }

                }
            })
            calendar.render();
        })
    </script>
@endpush