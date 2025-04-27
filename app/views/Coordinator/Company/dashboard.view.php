<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Coordinator Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/dashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Components/coordinatorCalendar.css">

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
                    <p class="welcome-text">Welcome back! Here's what's happening today.</p>
                </div>
                <div class="header-right">
                    <div class="date-display">
                        <i class="material-icons">today</i>
                        <span><?= date('l, F j, Y') ?></span>
                    </div>
                    <div class="round-badge">
                        <span class="round-label">Current Round</span>
                        <span class="round-number"><?= $round->round ?></span>
                    </div>
                </div>
                <div class="overlay"></div>
            </header>

            <?php if (!empty($dashboardDetails)): ?>
                <!-- Quick Stats Section -->
                <div class="quick-stats">
                    <div class="stat-card" onclick="navigateToDashboardCompany();">
                        <div class="stat-icon company">
                            <i class="material-icons">business</i>
                        </div>
                        <div class="stat-content">
                            <h3>Registered Companies</h3>
                            <h1><?= $dashboardDetails['companyCount'] ?? 0 ?></h1>
                            <div class="stat-trend">
                                <i class="material-icons trend-up">trending_up</i>
                                <span>12% from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card" onclick="navigateToDashboardStudent();">
                        <div class="stat-icon student">
                            <i class="material-icons">school</i>
                        </div>
                        <div class="stat-content">
                            <h3>Registered Students</h3>
                            <h1><?= $dashboardDetails['studentCount'] ?? 0 ?></h1>
                            <div class="stat-trend">
                                <i class="material-icons trend-up">trending_up</i>
                                <span>8% from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card" onclick="navigateToDashboardCompany();">
                        <div class="stat-icon ads">
                            <i class="material-icons">featured_video</i>
                        </div>
                        <div class="stat-content">
                            <h3>Ongoing Ads</h3>
                            <h1><?= $dashboardDetails['ongoingAdvertisementCount'] ?? 0 ?></h1>
                            <div class="stat-trend">
                                <i class="material-icons trend-up">trending_up</i>
                                <span>5 new this week</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card" onclick="navigateToComplaints();">
                        <div class="stat-icon complaints">
                            <i class="material-icons">report</i>
                        </div>
                        <div class="stat-content">
                            <h3>Complaints</h3>
                            <h1><?= $dashboardDetails['complaintCount'] ?? 0 ?></h1>
                            <div class="complaint-breakdown">
                                <span class="unread"><?= $dashboardDetails['unreadComplaints'] ?? 0 ?> unread</span>
                                <span class="resolved"><?= $dashboardDetails['resolvedComplaints'] ?? 0 ?> resolved</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="content-grid">
                    <!-- Left Column -->
                    <div class="content-column">
                        <!-- Internships Chart -->
                        <div class="dashboard-card chart-card">
                            <div class="card-header">
                                <h2>Internships Offered by Companies</h2>
                                
                            </div>
                            <div id="jobRolesChartContainer" style="width: 100%; height: 300px;"></div>
                        </div>

                        <!-- Applications Summary -->
                        <div class="dashboard-card applications-card">
                            <div class="card-header">
                                <h2>Applications Summary</h2>
                                <a href="#" class="view-all">View All</a>
                            </div>
                            <div class="applications-stats">
                                <div class="app-stat">
                                    <div class="stat-value"><?= $dashboardDetails['totalApplications'] ?? 0 ?></div>
                                    <div class="stat-label">Total Applications</div>
                                </div>
                                <div class="app-stat">
                                    <div class="stat-value"><?= $dashboardDetails['recruitedStudents'] ?? 0 ?></div>
                                    <div class="stat-label">Recruited</div>
                                </div>
                                <div class="app-stat">
                                    <div class="stat-value"><?= $dashboardDetails['pendingApplications'] ?? 0 ?></div>
                                    <div class="stat-label">Pending</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="content-column">
                        <!-- Calendar Section -->
                        <div class="dashboard-card calendar-card">
                            <div class="card-header">
                                <h2>Scheduled Tech Talks</h2>
                                <div class="calendar-actions">
                                    <button class="btn-icon" onclick="changeMonth(-1)">
                                        <i class="material-icons">chevron_left</i>
                                    </button>
                                    <button class="btn-icon" onclick="changeMonth(1)">
                                        <i class="material-icons">chevron_right</i>
                                    </button>
                                </div>
                            </div>
                            <div id="calendar-month" class="calendar-month"></div>
                            <div class="calendar-days" id="calendar-days"></div>
                        </div>

                        <!-- Upcoming Sessions -->
                        
                    </div>
                </div>

                <!-- Additional Sections -->
                <div class="secondary-grid">
                    <!-- Pending Approvals -->
                    <div class="dashboard-card pending-approvals">
                        <div class="card-header">
                            <h2>Pending Approvals</h2>
                            <span class="badge"><?= $dashboardDetails['pendingApprovals'] ?? 0 ?></span>
                        </div>
                        <div class="approval-items">
                            <div class="approval-item">
                                <div class="approval-type">
                                    <i class="material-icons">description</i>
                                    <span>Advertisements</span>
                                </div>
                                <div class="approval-count"><?= $dashboardDetails['pendingAdvertisements'] ?? 0 ?></div>
                                <button class="btn btn-review" onclick="navigateToPendingAds()">Review</button>
                            </div>
                            <div class="approval-item">
                                <div class="approval-type">
                                    <i class="material-icons">business</i>
                                    <span>Company Registrations</span>
                                </div>
                                <div class="approval-count"><?= $dashboardDetails['pendingCompanies'] ?? 0 ?></div>
                                <button class="btn btn-review" onclick="navigateToPendingCompanies()">Review</button>
                            </div>
                        </div>
                    </div>

                    <!-- Blocked Entities -->
                    <div class="dashboard-card blocked-entities">
                        <div class="card-header">
                            <h2>Blocked Entities</h2>
                        </div>
                        <div class="blocked-stats">
                            <div class="blocked-stat">
                                <div class="stat-value"><?= $dashboardDetails['blockedCompanies'] ?? 0 ?></div>
                                <div class="stat-label">Companies</div>
                            </div>
                            <div class="blocked-stat">
                                <div class="stat-value"><?= $dashboardDetails['blockedStudents'] ?? 0 ?></div>
                                <div class="stat-label">Students</div>
                            </div>
                        </div>
                        <div class="blocked-actions">
                            <button class="btn btn-outline" onclick="navigateToBlockedList('companies')">View Companies</button>
                            <button class="btn btn-outline" onclick="navigateToBlockedList('students')">View Students</button>
                        </div>
                    </div>

                    
                </div>

                <!-- Session Details Modal -->
                <div id="schedule-modal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 id="session-title" class="modal-title">Session Details</h2>
                            <button class="close-btn" onclick="closeModal()">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="session-meta">
                                <div class="meta-item">
                                    <i class="material-icons">event</i>
                                    <span id="session-date"></span>
                                </div>
                            </div>
                            <div class="session-list" id="session-details"></div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="empty-state">
                    <i class="material-icons">info</i>
                    <h3>No Dashboard Data Available</h3>
                    <p>Please check back later or contact support if this persists.</p>
                </div>
            <?php endif; ?>
        </main>
        <script src="<?= ROOT ?>/assets/js/script.js"></script>
        <script>
            var jobRolesData = <?php echo json_encode($InternPositions, JSON_NUMERIC_CHECK); ?>;
            var formattedJobRoles = jobRolesData.map(role => ({
                y: role.count,
                label: role.position
            }));

            window.onload = function() {
                CanvasJS.addColorSet("dashboardColors", [
                    "#3498db", "#2ecc71", "#e74c3c", "#f39c12", "#9b59b6",
                    "#1abc9c", "#d35400", "#34495e", "#16a085", "#c0392b"
                ]);

                var chart = new CanvasJS.Chart("jobRolesChartContainer", {
                    backgroundColor: "#ffffff",
                    colorSet: "dashboardColors",
                    animationEnabled: true,
                    axisY: {
                        title: "Number of Openings",
                        includeZero: true,
                        gridThickness: 0,
                        lineThickness: 1
                    },
                    axisX: {
                        labelAngle: -45,
                        interval: 1
                    },
                    data: [{
                        type: "bar",
                        indexLabel: "{y}",
                        indexLabelPlacement: "inside",
                        indexLabelFontWeight: "bold",
                        indexLabelFontColor: "white",
                        dataPoints: formattedJobRoles
                    }]
                });

                chart.render();

                // Initialize calendar
                renderCalendar(new Date());
            }

            // Calendar functions
            let currentMonth = new Date();
            const sessionData = <?php echo json_encode($sessions); ?>;

            function renderCalendar(month) {
                const firstDayOfMonth = new Date(month.getFullYear(), month.getMonth(), 1);
                const lastDayOfMonth = new Date(month.getFullYear(), month.getMonth() + 1, 0);

                const monthName = month.toLocaleString('default', {
                    month: 'long',
                    year: 'numeric'
                });
                document.getElementById('calendar-month').innerText = monthName;

                const daysContainer = document.getElementById('calendar-days');
                daysContainer.innerHTML = '';

                const numberOfDays = lastDayOfMonth.getDate();
                const firstDayIndex = firstDayOfMonth.getDay();

                // Blank days for the start of the month
                for (let i = 0; i < firstDayIndex; i++) {
                    const blankCell = document.createElement('div');
                    blankCell.classList.add('calendar-day', 'empty');
                    daysContainer.appendChild(blankCell);
                }

                // Fill in the days of the month
                for (let day = 1; day <= numberOfDays; day++) {
                    const currentDay = new Date(month.getFullYear(), month.getMonth(), day);
                    const dayString = currentDay.toISOString().split('T')[0];
                    const dayCell = document.createElement('div');
                    dayCell.classList.add('calendar-day');
                    dayCell.innerText = day;
                    dayCell.setAttribute('data-date', dayString);

                    // Highlight today
                    const today = new Date();
                    if (currentDay.getDate() === today.getDate() && 
                        currentDay.getMonth() === today.getMonth() && 
                        currentDay.getFullYear() === today.getFullYear()) {
                        dayCell.classList.add('today');
                    }

                    // Add session indicator if there are sessions
                    if (sessionData[dayString]) {
                        dayCell.classList.add('has-sessions');
                        const sessionIndicator = document.createElement('div');
                        sessionIndicator.classList.add('session-indicator');
                        dayCell.appendChild(sessionIndicator);
                        
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
                const formattedDate = dateObj.toLocaleDateString(undefined, {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

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
                        <div class="session-meta">
                            <div class="meta-item">
                                <i class="material-icons">schedule</i>
                                <span>${session.time}</span>
                            </div>
                            <div class="meta-item">
                                <i class="material-icons">location_on</i>
                                <span>Hall: ${session.hall}</span>
                            </div>
                        </div>
                        <p class="session-description">${session.description}</p>
                    `;
                    detailsContainer.appendChild(sessionItem);
                });

                // Show modal
                modal.style.display = 'flex';
                setTimeout(() => {
                    modal.classList.add('active');
                }, 10);
            }

            function closeModal() {
                const modal = document.getElementById('schedule-modal');
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            }

            function changeMonth(offset) {
                currentMonth.setMonth(currentMonth.getMonth() + offset);
                renderCalendar(currentMonth);
            }

            // Navigation functions
            // function navigateToDashboardCompany() {
            //     window.location.href = '<?= ROOT ?>/coordinator/companies';
            // }

            // function navigateToDashboardStudent() {
            //     window.location.href = '<?= ROOT ?>/coordinator/students';
            // }

            // function navigateToComplaints() {
            //     window.location.href = '<?= ROOT ?>/coordinator/complaints';
            // }

            // function navigateToPendingAds() {
            //     window.location.href = '<?= ROOT ?>/coordinator/advertisements/pending';
            // }

            // function navigateToPendingCompanies() {
            //     window.location.href = '<?= ROOT ?>/coordinator/companies/pending';
            // }

            // function navigateToBlockedList(type) {
            //     window.location.href = `<?= ROOT ?>/coordinator/${type}/blocked`;
            // }

            // function viewSessionDetails(id) {
            //     window.location.href = `<?= ROOT ?>/coordinator/sessions/view/${id}`;
            // }

            // Close modal when clicking outside
            window.onclick = function(event) {
                const modal = document.getElementById('schedule-modal');
                if (event.target === modal) {
                    closeModal();
                }
            };
        </script>
    </div>
</body>
</html>