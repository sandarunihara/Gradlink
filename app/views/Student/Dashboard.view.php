<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/allPages.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Student/studentSidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Student/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <script src="<?php echo ROOT ?>/assets/js/student/toast.js"></script> 
</head>

<body>
    <?php $this->renderComponent("studentHeader", ["title" => "Dashboard"])  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
        <div class="header">
            <h1>Welcome, <?php echo $_SESSION['USER']->Name ?></h1>
        </div>
        <div class="dashboard-cards">
            <div class="card">
                <h3>Current Applications</h3>
                <?php if ($data['numOfAppliedCompanies'] == 0): ?>
                    <p>You have no active applications.</p>
                <?php else: ?>
                    <p>You have <?php echo htmlspecialchars($data['numOfAppliedCompanies']) ?> active applications.</p>
                <?php endif; ?>
                <button onclick="location.href='<?= ROOT ?>/Student/StudentAppliedCompanies/AppliedCompanies';">View Applications</button>
            </div>
            <div class="card">
                <h3>Upcoming Interviews</h3>
                <?php if (empty($data['interview_time_slot'])): ?>
                    <p>You have no upcoming interviews.</p>
                <?php else: ?>
                    <p>Your next interview is on
                        <?php
                        echo (htmlspecialchars($data['day']) . " ");
                        echo (htmlspecialchars($data['monthName']) . ".");
                        ?>
                    </p>
                <?php endif; ?>
                <button onclick="location.href='<?= ROOT ?>/Student/StudentScheduleInterview/Interview';">View Interview</button>
            </div>
            <div class="card">
                <h3>Internship Offers</h3>
                <?php if ($data['intenshipOffers'] == 0): ?>
                    <p>You have no internship offers.</p>
                <?php else: ?>
                    <?php if ($data['intenshipOffers'] == 1 ): ?>
                        <p>You have <?php echo htmlspecialchars($data['intenshipOffers']) ?> internship offer.</p>
                    <?php else: ?>
                        <p>You have <?php echo htmlspecialchars($data['intenshipOffers']) ?> internship offers.</p>
                    <?php endif; ?> 
                <?php endif; ?>
                <button onclick="location.href='<?= ROOT ?>/Student/StudentAppliedCompanies/InternshipOffers';">View Offers</button>
            </div>
        </div>
<!-- Toast -->
<div id="toast-container" class="toast-container"></div>

<?php if(array_key_exists('success', $_SESSION)){ ?>
        <script>
            successToast("<?= $_SESSION['success'] ?>");
        </script>
    <?php unset($_SESSION['success']);?>
<?php }?>

<?php if(array_key_exists('errors', $_SESSION)){ ?>
        <script>
            errorToast("<?= $_SESSION['errors'] ?>");
        </script>
    <?php unset($_SESSION['errors']);?>
<?php }?>
        <div class="activity-calendar-container">
        <div class="activity-container">
            <div class="recent-activity">
                <h3>Recent Activity</h3>
                <?php if (empty($data['student_activities'])): ?>
                    <p>You have no recent activity.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($data['student_activities'] as $activity): ?>
                            <li><?php echo htmlspecialchars($activity->ActivityDescription) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <div class="calendar-container">
            <div class="calendar-header">
                <div class="calendar-title" id="calendar-month-year">June 2023</div>
                <div class="calendar-nav">
                    <button id="prev-month"><i class="fas fa-chevron-left"></i></button>
                    <button id="next-month"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <div class="calendar-weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>

            <div class="calendar-days" id="calendar-days">
                <!-- Calendar days will be populated by JavaScript -->
            </div>
        </div>
        </div>

        <!-- Event Details Modal -->
        <div class="modal" id="event-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="modal-date">June 15, 2023</div>
                    <button class="close-modal" id="close-modal">&times;</button>
                </div>
                <div id="event-list">
                    <!-- Events will be populated dynamically -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const interviewData = <?php echo json_encode($interviewData); ?>;
            const sessionData = <?php echo json_encode($sessionData); ?>;

            const events = {};

            interviewData.forEach(interview => {
                const date = new Date(interview.InterviewDate);
                const dateStr = formatDateForCalendar(date);
                const timeStr = formatTime(interview.StartTime);

                if (!events[dateStr]) {
                    events[dateStr] = [];
                }

                events[dateStr].push({
                    type: 'interview',
                    title: interview.CompanyName || 'Interview',
                    time: timeStr
                });
            });

            sessionData.forEach(session => {
                const date = new Date(session.session_date);
                const dateStr = formatDateForCalendar(date);
                const timeStr = session.time_slot;

                if (!events[dateStr]) {
                    events[dateStr] = [];
                }

                events[dateStr].push({
                    type: 'session',
                    title: session.session_name || 'Session',
                    time: timeStr
                });
            });

            let currentDate = new Date();
            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();

            // DOM elements
            const calendarDays = document.getElementById('calendar-days');
            const calendarTitle = document.getElementById('calendar-month-year');
            const prevMonthBtn = document.getElementById('prev-month');
            const nextMonthBtn = document.getElementById('next-month');
            const eventModal = document.getElementById('event-modal');
            const modalDate = document.getElementById('modal-date');
            const eventList = document.getElementById('event-list');
            const closeModal = document.getElementById('close-modal');

            function formatDateForCalendar(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            function formatTime(time) {
                const [hours, minutes] = time.split(':').map(Number);
                const ampm = hours >= 12 ? 'PM' : 'AM';
                const formattedHours = hours % 12 || 12; // Convert to 12-hour format
                return `${String(formattedHours).padStart(2, '0')}:${String(minutes).padStart(2, '0')} ${ampm}`;
            }

            // Render calendar
            function renderCalendar() {
                // Clear previous calendar days
                calendarDays.innerHTML = '';

                // Set calendar title
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                calendarTitle.textContent = `${monthNames[currentMonth]} ${currentYear}`;

                // Get first day of month and total days in month
                const firstDay = new Date(currentYear, currentMonth, 1).getDay();
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

                // Get days from previous month
                const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();

                // Get today's date for comparison
                const today = new Date();
                const isCurrentMonth = currentMonth === today.getMonth() && currentYear === today.getFullYear();

                // Add days from previous month
                for (let i = 0; i < firstDay; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day other-month';
                    dayElement.textContent = prevMonthDays - firstDay + i + 1;
                    calendarDays.appendChild(dayElement);
                }

                // Add days from current month
                for (let i = 1; i <= daysInMonth; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day current-month';
                    dayElement.textContent = i;

                    // Check if this is today
                    if (isCurrentMonth && i === today.getDate()) {
                        dayElement.classList.add('today');
                    }

                    // Check if this day has events
                    const dateStr = formatDateForCalendar(new Date(currentYear, currentMonth, i));
                    if (events[dateStr]) {
                        dayElement.classList.add('has-event');

                        // Add click event to show modal
                        dayElement.addEventListener('click', function() {
                            showEventsModal(dateStr, i);
                        });
                    } else {
                        // Add click event for days without events
                        dayElement.addEventListener('click', function() {
                            showNoEventsModal(dateStr, i);
                        });
                    }

                    calendarDays.appendChild(dayElement);
                }

                // Calculate remaining days to fill the grid (next month)
                const totalCells = firstDay + daysInMonth;
                const remainingCells = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);

                // Add days from next month
                for (let i = 1; i <= remainingCells; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day other-month';
                    dayElement.textContent = i;
                    calendarDays.appendChild(dayElement);
                }
            }
            
            function showEventsModal(dateStr, day) {
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                modalDate.textContent = `${monthNames[currentMonth]} ${day}, ${currentYear}`;

                // Clear previous events
                eventList.innerHTML = '';

                // Add events to modal
                if (events[dateStr]) {
                    events[dateStr].forEach(event => {
                        const eventItem = document.createElement('div');
                        eventItem.className = 'event-item';

                        const eventTypeClass = event.type === 'interview' ? 'interview' : 'session';

                        eventItem.innerHTML = `
                            <div>
                                <span class="event-time">${event.time}</span>
                                <span class="event-type ${eventTypeClass}">${event.type.charAt(0).toUpperCase() + event.type.slice(1)}</span>
                            </div>
                            <div>${event.title}</div>
                        `;

                        eventList.appendChild(eventItem);
                    });
                }

                // Show modal
                eventModal.style.display = 'flex';
            }

            // Show modal for days with no events
            function showNoEventsModal(dateStr, day) {
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                modalDate.textContent = `${monthNames[currentMonth]} ${day}, ${currentYear}`;

                eventList.innerHTML = '<p style="color: #718096; text-align: center; padding: 20px 0;">No events scheduled for this day.</p>';

                eventModal.style.display = 'flex';
            }

            // Event listeners
            prevMonthBtn.addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                renderCalendar();
            });

            nextMonthBtn.addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                renderCalendar();
            });

            closeModal.addEventListener('click', function() {
                eventModal.style.display = 'none';
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === eventModal) {
                    eventModal.style.display = 'none';
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    eventModal.style.display = 'none';
                }
            });

            // Initial render
            renderCalendar();
        });
    </script>
</body>

</html>