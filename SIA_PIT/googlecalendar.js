document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    // Initialize FullCalendar
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: function(fetchInfo, successCallback, failureCallback) {
            fetch('fetch.php')
                .then(response => response.json())
                .then(data => successCallback(data))
                .catch(error => failureCallback(error));
        }
    });

    calendar.render();
});
