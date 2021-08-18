<div>
  <div id='calendar-container' wire:ignore>
    <div id='calendar'></div>
  </div>
</div>
 
@section('scripts')
@parent
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

     
    <script>
        //document.addEventListener('livewire:load', function() {
        //});
        document.addEventListener('DOMContentLoaded', function() {
            //var Calendar = FullCalendar.Calendar;
            //var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            //var checkbox = document.getElementById('drop-remove');
            var data =   @this.events;
            //alert(data);
            var calendar = new FullCalendar.Calendar(calendarEl, {
            events: JSON.parse(data),
            eventTimeFormat: {
                hour:'2-digit',
                minute: '2-digit',
                meridiem: false
            },
            firstDay: 1,
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            eventDisplay: 'block',
            buttonText: {
                today:    'Aujourd\'hui',
                month:    'Mois',
                week:     'Semaine',
                list:     'Liste',
            },
            //themeSystem: 'bootstrap',
            locale: 'fr',
            /*dateClick(info)  {
               var title = prompt('Enter Event Title');
               var date = new Date(info.dateStr + 'T00:00:00');
               if(title != null && title != ''){
                 calendar.addEvent({
                    title: title,
                    start: date,
                    allDay: true
                  });
                 var eventAdd = {title: title,start: date};
                 @this.addevent(eventAdd);
                 alert('Great. Now, update your database...');
               }else{
                alert('Event Title Is Required');
               }
            },*/
            //editable: true,
            editable: false,
            selectable: true,
            displayEventTime: true,
            droppable: true, // this allows things to be dropped onto the calendar
            /*drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                // if so, remove the element from the "Draggable Events" list
                info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
            loading: function(isLoading) {
                    if (!isLoading) {
                        // Reset custom events
                        this.getEvents().forEach(function(e){
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
            }*/
            });
            calendar.render();
            @this.on(`refreshCalendar`, () => {
                calendar.refetchEvents()
            });
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endsection
