<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');

      // Initialize the calendar
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        editable: true,
        events: []
      });

      // Render the calendar
      calendar.render();

      // Handle form submission
      document.getElementById('event-form').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent form from reloading the page

        // Get form data
        var title = document.getElementById('title').value;
        var start = document.getElementById('start').value;
        var end = document.getElementById('end').value;

        // Add event to calendar
        calendar.addEvent({
          title: title,
          start: start,
          end: end || start // Use the same date for 'end' if not provided
        });

        // Clear the form
        e.target.reset();
      });
    });
  </script>
</head>
<body>

  <!-- Form to add events -->
  <form id="event-form">
    <label for="title">Event Title:</label>
    <input type="text" id="title" name="title" required><br><br>

    <label for="start">Start Date:</label>
    <input type="date" id="start" name="start" required><br><br>

    <label for="end">End Date:</label>
    <input type="date" id="end" name="end"><br><br>

    <button type="submit">Add Event</button>
  </form>

  <!-- Calendar container -->
  <div id="calendar"></div>

</body>
</html>
