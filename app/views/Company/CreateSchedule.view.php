<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Schedulecreate.css">
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
                        <h1>Students Profile/Interview Schedule</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="sc_main">
                    <div class="sc">
                        <div class="calendar-container">
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <form id="schedule-form" class="sc_background" method="post">
                        <div class="sc_iner">
                            <a href="http://localhost/Gradlink/public/company/ShortlistedStudents/studentprofile/<?php echo $addata[0]->advertisementId  ?>/<?php echo $data[0]->StudentId  ?>" class="sc_container">
                                <i class="fas fa-chevron-left"></i>
                                <h3>BACK</h3>
                            </a>
                            <div class="sc_con">
                                <div class="is_con1">
                                    <div class="sc_pos">
                                        <h4><span class="starmark">*</span>Position:</h4>
                                        <input type="text" id="position" name="position" value="<?php echo $addata[0]->position ?>" readonly />
                                    </div>
                                    <div class="sc_dateNdur">
                                        <div class="sc_date">
                                            <h4><span class="starmark">*</span>Student Name :</h4>
                                            <input type="text" id="name" name="name" value="<?php echo $data[0]->Name ?>" readonly />
                                        </div>
                                    </div>
                                    <div class="sc_dateNdur">
                                        <div class="sc_date">
                                            <h4><span class="starmark">*</span>Date :</h4>
                                            <input type="date" id="date" name="date" required />
                                        </div>
                                    </div>
                                    <div class="sc_time">
                                        <h4><span class="starmark">*</span>Select Time Period</h4>
                                        <div id="time-slots-container" class="sc_time-slots">
                                            <div class="time-slot">
                                                <input type="time" id="starttime" name="starttime" required>
                                                <p>-</p>
                                                <input type="time" id="endtime" name="endtime" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="is_con2">
                                    <div class="sc_dateNdur2">
                                        <div class="additional_info">
                                            <h4>Additional Information </h4>
                                            <textarea id="message" name="message" cols="70" rows="8" placeholder="Enter your message..."></textarea>
                                        </div>
                                        <div class="sc_btn">
                                            <button type="submit" class="sc_btn" onclick="validateAndShowModal(event)">
                                                Schedule Interview
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to send the schedule?</p>
            <div class="modal-buttons">
                <button class="yes-btn" onclick="submitForm()">Yes</button>
                <button class="no-btn" onclick="closeConfirmationModal()">No</button>
            </div>
        </div>
    </div>



    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <!-- Then load flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const unavailableDates = <?php echo json_encode($unavailable_date); ?>;
            
            // Initialize date picker
            flatpickr("#date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: unavailableDates.map(date => new Date(date))
            });
            
            // Initialize FullCalendar
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: {
                    url: 'http://localhost/Gradlink/public/company/ShortlistedStudents/getInterviewSchedules',
                    method: 'GET',
                    failure: function() {
                        errorToast('Failed to fetch interview schedules');
                    }
                },
                eventClick: function(info) {
                    alert(
                        'Interview Details\n\n' +
                        'Student: ' + info.event.extendedProps.StudentName + '\n' +
                        'Position: ' + info.event.extendedProps.position + '\n' +
                        'Date: ' + info.event.start.toLocaleDateString() + '\n' +
                        'Time: ' + info.event.start.toLocaleTimeString() + ' - ' + 
                        (info.event.end ? info.event.end.toLocaleTimeString() : '')
                    );
                },
                dateClick: function(info) {
                    document.getElementById('date').value = info.dateStr;
                },
                eventColor: '#3788d8'
            });
            console.log(calendar);
            
            calendar.render();

            // Refresh calendar after form submission
            document.getElementById('schedule-form').addEventListener('submit', function() {
                setTimeout(() => {
                    calendar.refetchEvents();
                }, 1000);
            });
        });
        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const date = document.getElementById('date').value;
            const name = document.getElementById('name').value;
            const starttime = document.getElementById('starttime').value;
            const endtime = document.getElementById('endtime').value;

            if (!position || !date || !name || !starttime || !endtime) {
                errorToast("Please fill in all required fields.");
                return;
            }

            // Show confirmation modal if form is valid
            openConfirmationModal();
        }

        function openConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'block';
            const modal = document.getElementById("confirmation-modal");
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }

        function submitForm() {
            document.getElementById('schedule-form').submit();
        }
    </script>
</body>

</html>