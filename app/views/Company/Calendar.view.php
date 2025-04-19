<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gradlink</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Calendar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Calendar</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="main-container">
                    <a href="http://localhost/Gradlink/public/company/Companydash/Dashboard" class="sc_container">
                        <i class="fas fa-chevron-left"></i>
                        <h3>BACK</h3>
                    </a>
                    <div class="m_main">
                        <div class="calendar-container">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="event-modal" class="modal">
        <div class="modal-content">
            <div id="event-details" class="event-details"></div>
            <div class="modal-buttons">
                <button class="no-btn" onclick="closeeventModal()">Close</button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <!-- Toast message from session -->
    <?php if (isset($_SESSION['flash'])): ?>
        <script>
            window.__flashMessage = <?php echo json_encode($_SESSION['flash']); ?>;
        </script>
    <?php
        unset($_SESSION['flash']);
    endif;
    ?>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <!-- Then load flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                events: {
                    url: 'http://localhost/Gradlink/public/company/ShortlistedStudents/getInterviewSchedules',
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                    },
                    failure: function() {
                        errorToast('Failed to fetch interview schedules');
                    }
                },
                eventClick: function(info) {
                    const msg = `Interview Details\n\n
                Student: ${info.event.extendedProps.StudentName}
                Position: ${info.event.extendedProps.position}
                Date: ${info.event.start.toLocaleDateString()}
                Time: ${info.event.start.toLocaleTimeString()}
                `;
                    openeventModal(msg);
                },
                eventColor: '#3788d8',
                height: 'auto',
                contentHeight: 'auto',
                aspectRatio: 1.35,
            });

            calendar.render();
        });


        function openeventModal(message) {
            const modal = document.getElementById("event-modal");
            document.getElementById('event-details').textContent = message;
            modal.style.display = 'flex';
        }

        function closeeventModal() {
            document.getElementById('event-modal').style.display = 'none';
        }
    </script>


</body>

</html>