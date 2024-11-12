function toggleDropdown() {
    var dropdown = document.getElementById("notificationDropdown");
    if (dropdown.style.display === "none") {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
    }
}


function toggleclose() {
    var dropdown = document.getElementById("notificationDropdown");
    dropdown.style.display = "none";
}

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendarDropdown');

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

  function togglecalendardown() {
    var dropdown = document.getElementById("calendarDropdown");
    if (dropdown.style.display === "none") {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
    }
}