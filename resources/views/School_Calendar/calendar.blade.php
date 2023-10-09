<html>

<head>
    <title>Laravel Fullcalender Add/Update/Delete Event Example Tutorial - NiceSnippets.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"
        integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>

<style>
body{
    background-color: #CCEEBC;
    width: 100%;
}
.heading{
    background-color: #004225;
    padding: 0;
    text-align: center;
    font-size: 50px;
    color: white;
}
#calendar{
    width: 100%;
    height: 100%;
    margin-top: 10px;
}
</style>

<body>
    <div class="heading white-heading sticky-top" style="width: 100%;">
        Calendars
    </div>
    <div class="container">
        <div class="response alert alert-success mt-2" style="display: none;">HUHUHU</div>
        <div id='calendar'></div>
    </div>
</body>
<script>
    $(document).ready(function() {
        var SITEURL = "{{ url('/') }}";

        // Set up CSRF token in AJAX headers
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            events: {
                url: SITEURL + "/school-calendar",
                method: "GET",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var formattedEvents = [];
                    $.each(data, function(index, event) {
                        formattedEvents.push({
                            title: event.events,
                            description: event.events_description,
                            start: event.events_started,
                            end: event.events_end
                        });
                    });

                    // Clear existing events and add the formatted events to the FullCalendar
                    calendar.fullCalendar('removeEvents');
                    calendar.fullCalendar('addEventSource', formattedEvents);
                }
            },
            displayEventTime: true,
            editable: false,
            eventRender: function(event, element, view) {
                // Display both title and description in the event element
                element.find('.fc-title').html(event.title + ': ' + event.description);

                // Corrected comparison to check if event.allDay is a boolean
                if (event.allDay === true) {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            }
        });
    });
</script>

</html>
