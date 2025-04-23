<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/dashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorCalendar.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</head>

<body>

    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard") ?>


        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Dashboard</h1>
                </div>
                <div class="header-right">
                    <i class="material-icons notification-icon">notifications</i>
                    <div class="notification-dropdown">
                        <ul>
                            <li>No new notifications</li>
                            <!-- Add more notifications here -->
                        </ul>
                    </div>
                </div>
                <div class="overlay"></div>

            </header>

            <div class='round-type '>1st Round</div>


            <!-- <div class="main-body"> -->
            <?php
            if (!empty($dashboardDetails)):
            ?>
                <div class="main-cards">
                    <div class='card' onclick='navigateToDashboardCompany();'>
                        <div class='card-inner'>
                            <i class="material-icons">business</i>
                            <h3>Companies</h3>
                        </div>
                        <h1><?php echo $dashboardDetails['companyCount'] ?? 0; ?></h1>

                    </div>

                    <div class='card' onclick='navigateToDashboardStudent();'>
                        <div class='card-inner'>
                            <i class="material-icons">school </i>
                            <h3>Students</h3>
                        </div>
                        <h1><?php echo $dashboardDetails['studentCount'] ?? 0; ?></h1>
                    </div>
                    <div class='card' onclick='navigateToDashboardCompany();'>
                        <div class='card-inner'>
                            <i class="material-icons">featured_video</i>
                            <h3>Ongoing Advertisements</h3>
                        </div>
                        <h1><?php echo $dashboardDetails['ongoingAdvertisementCount'] ?? 0; ?></h1>

                    </div>
                </div>
                <div class="analysis-container">
                    <div class="recruitment-analysis">
                        <div class="title">
                            <p>Recruitment Analysis</p>
                        </div>

                        <div class="graphs">
                            <div id="recruitment_CS" style="height: 370px; width: 100%;"></div>
                            <div id="recruitment_IS" style="height: 370px; width: 100%; margin-top: 20px;"></div>
                        </div>
                    </div>

                    <div class="company-performance">
                        <div class="title">
                            <p>Internships Offered by Companies</p>
                        </div>
                        <div id="jobRolesChartContainer" style="width: 100%; height: 370px;"></div>


                        <!-- <div class="company-performance" style="margin-top: 30px;">
                                <div class="title" style="margin-top: 20px;">
                                    <p>Scheduled Tech Talk Sessions</p>
                                </div>


                                <div class="calendar-container">
                                    <div id="calendar">
                                        <div class="calendar-header">
                                            <button class="prev" onclick="changeMonth(-1)">&#10094;</button>
                                            <div id="calendar-month"></div>
                                            <button class="next" onclick="changeMonth(1)">&#10095;</button>
                                        </div>
                                        <div class="calendar-days" id="calendar-days"></div>
                                    </div>
                                </div>

                                <div id="schedule-modal" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal()">&times;</span>
                                        <h2 id="session-title"></h2>
                                        <ul id="session-details"></ul>
                                    </div>
                                </div>


                                <!-- <div id="jobRolesChartContainer" style="width: 100%; height: 370px;"></div> -->
                        <!-- </div> -->


                        <div class="company-performance">
                            <div class="calendar-title">
                                <h2>Scheduled Tech Talk Sessions</h2>
                            </div>

                            <div class="calendar-container">
                                <div id="calendar">
                                    <div class="calendar-header">
                                        <button class="prev" onclick="changeMonth(-1)">&#10094; Previous</button>
                                        <div id="calendar-month">Month Year</div>
                                        <button class="next" onclick="changeMonth(1)">Next &#10095;</button>
                                    </div>

                                    <div class="calendar-days" id="calendar-days"></div>
                                </div>
                            </div>

                            <div id="schedule-modal" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 id="session-title" class="modal-title">Session Details</h2>
                                        <button class="close-btn" onclick="closeModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="session-meta">
                                            <div class="meta-item">
                                                <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                                </svg>
                                                <span id="session-date"></span>
                                            </div>
                                            
                                        </div>
                                        <div class="session-list" id="session-details"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    </div>


                </div>


            <?php else: ?>
                <p>Empty Data</p>
            <?php endif; ?>

            <!-- </div> -->

        </main>


        <script>
            <?php
            if (!empty($applicationAnalysis)):
                $applicationCSGraphPoints = array(
                    array("label" => "Pending", "symbol" => "Pending", "y" => htmlspecialchars($applicationAnalysis['pendingCSCount'] ?? '')),
                    array("label" => "Rejected", "symbol" => "Rejected", "y" => htmlspecialchars($applicationAnalysis['rejectedCSCount'] ?? '')),
                    array("label" => "Recruited", "symbol" => "Recruited", "y" => htmlspecialchars($applicationAnalysis['recruitedCSCount'] ?? '')),
                    array("label" => "Not Applied", "symbol" => "Not Applied", "y" => htmlspecialchars($applicationAnalysis['notAppliedCSCount'] ?? '')),
                );

                $applicationISGraphPoints = array(
                    array("label" => "Pending", "symbol" => "Pending", "y" => htmlspecialchars($applicationAnalysis['pendingISCount'] ?? '')),
                    array("label" => "Rejected", "symbol" => "Rejected", "y" => htmlspecialchars($applicationAnalysis['rejectedISCount'] ?? '')),
                    array("label" => "Recruited", "symbol" => "Recruited", "y" => htmlspecialchars($applicationAnalysis['recruitedISCount'] ?? '')),
                    array("label" => "Not Applied", "symbol" => "Not Applied", "y" => htmlspecialchars($applicationAnalysis['notAppliedISCount'] ?? '')),
                );
            ?>

                var jobRolesData = <?php echo json_encode($InternPositions, JSON_NUMERIC_CHECK); ?>;
                var formattedJobRoles = jobRolesData.map(role => ({
                    y: role.count,
                    label: role.position
                }));

                window.onload = function() {

                    var chart1 = new CanvasJS.Chart("recruitment_CS", {
                        backgroundColor: "#fffafa",
                        theme: "light2",
                        animationEnabled: true,
                        subtitles: [{
                            text: "Computer Science Degree",
                            fontSize: 20,
                        }],
                        data: [{
                            type: "doughnut",
                            radius: "90%",
                            innerRadius: "50%",
                            indexLabel: "{symbol} - {y}",
                            yValueFormatString: "#,##0.0\"%\"",
                            showInLegend: true,
                            legendText: "{label} : {y}",
                            dataPoints: <?php echo json_encode($applicationCSGraphPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });

                    var chart2 = new CanvasJS.Chart("recruitment_IS", {
                        backgroundColor: "#fffafa",
                        theme: "light2",
                        animationEnabled: true,
                        subtitles: [{
                            text: "Information Systems Degree",
                            fontSize: 20,
                        }],
                        data: [{
                            type: "doughnut",
                            radius: "90%",
                            innerRadius: "50%",
                            indexLabel: "{symbol} - {y}",
                            yValueFormatString: "#,##0.0\"%\"",
                            showInLegend: true,
                            legendText: "{label} : {y}",
                            dataPoints: <?php echo json_encode($applicationISGraphPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });

                    var chart3 = new CanvasJS.Chart("jobRolesChartContainer", {
                        backgroundColor: "#fffafa",
                        animationEnabled: true,
                        // title: {
                        //     text: "Job Roles Offered by Companies"
                        // },
                        axisY: {
                            title: "Number of Job Openings",
                            includeZero: true
                        },
                        data: [{
                            type: "bar",
                            indexLabel: "{y}",
                            indexLabelPlacement: "inside",
                            indexLabelFontWeight: "bolder",
                            indexLabelFontColor: "white",
                            dataPoints: formattedJobRoles
                        }]
                    });

                    chart1.render();
                    chart2.render();
                    chart3.render();

                }

            <?php else: ?>
                console.warn("No application analysis data available.");
            <?php endif; ?>
        </script>

        <script src="<?= ROOT ?>/assets/js/script.js"></script>

        <script>
            let currentMonth = new Date();
            const sessionData = <?php echo json_encode($sessions); ?>

            function renderCalendar(month) {
                const firstDayOfMonth = new Date(month.getFullYear(), month.getMonth(), 1);
                const lastDayOfMonth = new Date(month.getFullYear(), month.getMonth() + 1, 0);

                const monthName = month.toLocaleString('default', {
                    month: 'long'
                }) + ' ' + month.getFullYear();
                document.getElementById('calendar-month').innerText = monthName;

                const daysContainer = document.getElementById('calendar-days');
                daysContainer.innerHTML = '';

                const numberOfDays = lastDayOfMonth.getDate();
                const firstDayIndex = firstDayOfMonth.getDay();

                // Blank days for the start of the month
                for (let i = 0; i < firstDayIndex; i++) {
                    const blankCell = document.createElement('div');
                    blankCell.classList.add('calendar-day');
                    daysContainer.appendChild(blankCell);
                }

                // Fill in the days of the month
                for (let day = 1; day <= numberOfDays; day++) {
                    const currentDay = new Date(month.getFullYear(), month.getMonth(), day, 12);
                    const dayString = currentDay.toISOString().split('T')[0]; // format: YYYY-MM-DD
                    const dayCell = document.createElement('div');
                    dayCell.classList.add('calendar-day');
                    dayCell.innerText = day;
                    dayCell.setAttribute('data-date', dayString);

                    // Add session labels if there are sessions on that day
                    if (sessionData[dayString]) {
                        // Add a class to highlight the day if there are sessions
                        dayCell.classList.add('session-day');

                        // Add an onclick event to show session details
                        dayCell.onclick = function() {
                            showSessionDetails(dayString);
                        };
                    }

                    daysContainer.appendChild(dayCell);
                }
            }


            function showSessionDetails(date) {
                const modal = document.getElementById('schedule-modal');
                const sessions = sessionData[date];

                // Format date for display
                const dateObj = new Date(date);
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const formattedDate = dateObj.toLocaleDateString(undefined, options);

                // Set modal content
                document.getElementById('session-title').textContent = 'Session Details';
                document.getElementById('session-date').textContent = formattedDate;

                // Clear previous content
                const detailsContainer = document.getElementById('session-details');
                detailsContainer.innerHTML = '';

                // Add each session
                sessions.forEach(session => {
                    const sessionItem = document.createElement('div');
                    sessionItem.className = 'session-item';
                    sessionItem.innerHTML = `
            <h3 class="session-name">${session.session_name}</h3>
            <p class="session-company">${session.Company}</p>
            <div class="meta-item" style="margin-bottom: 8px;">
                <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>${session.time}</span>
            </div>
            <div class="meta-item">
                <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <span>Hall: ${session.hall}</span>
            </div>
            <p class="session-description">${session.description}</p>
        `;
                    detailsContainer.appendChild(sessionItem);
                });

                // Show modal
                const modal1 = document.getElementById('schedule-modal');
                modal1.style.display = 'flex'; // Force display
                setTimeout(() => {
                    modal1.classList.add('active'); // Add animation class
                }, 10);
            }

            function closeModal() {
                const modal = document.getElementById('schedule-modal');
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300); // Match this with your CSS transition duration
            }

            // Close modal when clicking outside of it
            window.onclick = function(event) {
                const modal = document.getElementById('schedule-modal');
                if (event.target === modal) {
                    closeModal();
                }
            };

            function changeMonth(offset) {
                currentMonth.setMonth(currentMonth.getMonth() + offset);
                renderCalendar(currentMonth);
            }

            // Initial render
            renderCalendar(currentMonth);


            // Notifications
            const notificationIcon = document.querySelector(".notification-icon");
            const notificationDropdown = document.querySelector(".notification-dropdown");
            const overlay = document.querySelector(".overlay");

            notificationIcon.addEventListener("click", function() {
                notificationDropdown.classList.toggle("active");
                overlay.classList.toggle("active"); // Show/hide overlay
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function(event) {
                if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
                    notificationDropdown.classList.remove("active");
                    overlay.classList.remove("active"); // Hide overlay
                }
            });
        </script>



</body>

</html>