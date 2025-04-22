<!DOCTYPE html>
<html lang="en">

<?php if ($Status == 'Ongoing') : ?>

    <head>
        <title>Gradlink</title>
        <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
        <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
        <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Dashboard.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="<?php echo ROOT ?>/assets/js/Cscript.js" defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script src="<?= ROOT ?>/assets/js/company/dashboard.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>
    <!-- $_SESSION['ROUNDID'] -->

    <body class="body">
        <div class="dashboard">
            <div class="side">
                <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
            </div>
            <div id="content" class="content">
                <div class="main">
                    <div class="d">
                        <div class="upper-header">
                            <h1>DashBoard</h1>
                            <span class="round-badge">
                                <span class="round-label">Current Placement Round</span>
                                <span class="round-number"><?= $_SESSION['ROUNDID'] ?></span>
                            </span>
                            <div class="d_pro">
                                <div class="d_profile">
                                    <div class="notification-wrapper">
                                        <div class="notification-icon" onclick="toggleNotifications()">
                                            <i class="fas fa-bell"></i>
                                            <span id="notificationCount" class="badge"></span>
                                        </div>
                                        <div id="notificationDropdown" class="dropdown-content" style="display: none;">
                                            <i class="fas fa-close" onclick="toggleNotifications()"></i>
                                            <div id="notificationsList">
                                                <p>Loading notifications...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overview">
                        <p>Overview</p>
                    </div>
                    <div class="all-content">
                        <div class="full-content">
                            <div class="d_main">
                                <div class="d_allsummery">
                                    <!-- Key Metrics Cards -->
                                    <div class="metrics-grid">
                                        <div class="metric-card" onclick="window.location.href='http://localhost/Gradlink/public/company/Advertisements/dashboard'">
                                            <div class="metric-icon">
                                                <i class="fas fa-bullhorn"></i>
                                            </div>
                                            <div class="metric-info">
                                                <h3>Total Advertisements</h3>
                                                <p class="metric-value"><?php echo $numOfAdvertisements ?></p>
                                                <p class="metric-change positive"><i class="fas fa-bullhorn"></i>Current Month ADs <?php echo $numOfcurrentmothAD; ?></p>
                                            </div>
                                        </div>

                                        <div class="metric-card" onclick="window.location.href='http://localhost/Gradlink/public/company/StudentsRequests/dashboard'">
                                            <div class="metric-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="metric-info">
                                                <h3>Total Student Applied</h3>
                                                <p class="metric-value"><?php echo $numOfStudents; ?></p>
                                                <p class="metric-change positive"><i class="fas fa-users"></i> this month's applicants <?php echo $lastmonthcount; ?></p>
                                            </div>
                                        </div>

                                        <div class="metric-card" onclick="window.location.href='http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard'">
                                            <div class="metric-icon">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                            <div class="metric-info">
                                                <h3>Total Student Shortlisted</h3>
                                                <p class="metric-value"><?php echo $numOfShortlistStudents ?></p>
                                                <p class="metric-change positive"><i class="fas fa-user-check"></i>Click to view </p>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="bottomcontent">
                                    <div class="charts-section">
                                        <div class="chart-card">
                                            <div class="chart-header">
                                                <h3>Student Placement Status</h3>
                                                <div class="chart-legend">
                                                    <button class="chart-toggle active" onclick="toggleChart('studentStatusChart', this)">Placement Status</button>
                                                    <button class="chart-toggle" onclick="toggleChart('applicationtrendschart', this)">Application Trends</button>
                                                </div>
                                            </div>
                                            <div id="studentStatusChart" class="chart-container hh" style="display: block;"></div>
                                            <div id="applicationtrendschart" class="chart-container" style="display: none;"></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="second-content">
                                <div class="calendar-with-schedule-data">
                                    <div class="schedule-topic">
                                        <h3>Interview Schedule</h3>
                                        <a href="http://localhost/Gradlink/public/company/Companydash/calendar" class="view-all">view calendar</a>
                                    </div>
                                    <div class="compact-calendar-header"></div>
                                    <div id="compactCalendar"></div>
                                    <div class="topic-content">
                                        <h4 class="upcommingevent">Upcomming Interview</h4>
                                        <a href="http://localhost/Gradlink/public/company/Schedule/dashboard" class="view-all">view all</a>
                                    </div>
                                    <div id="upcomingEvents" class="upcoming-events-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bottomcontent2">
                            <div class="d_request">
                                <div class="table-header">
                                    <h3>Student Requests</h3>
                                    <a href="../StudentsRequests/dashboard" class="view-all">view all</a>
                                </div>
                                <div class="d_alllist">
                                    <ul>
                                        <li>
                                            <h5>Student Name</h5>
                                            <h5>Position</h5>
                                            <h5>Action</h5>
                                        </li>
                                        <?php
                                        if (empty($data)) {
                                            echo '<li class="no-events">No requests found</li>';
                                        } else {
                                            // Get the first 8 elements from $data
                                            $firstEight = array_slice($data, 0, 6);

                                            foreach ($firstEight as $item) {
                                                $status = $item['Status'];
                                                switch ($status) {
                                                    case 'Recruit':
                                                        $Statusname = 'Recruit';
                                                        $statusClass = 'status Recruit';
                                                        break;
                                                    case 'Reject':
                                                        $Statusname = 'Rejected';
                                                        $statusClass = 'status Reject';
                                                        break;
                                                    case 'Interview Scheduled':
                                                        $Statusname = 'Scheduled';
                                                        $statusClass = 'status Sendemail';
                                                        break;
                                                    case 'Shortlist':
                                                        $Statusname = 'Shortlisted';
                                                        $statusClass = 'status Shortlist';
                                                        break;
                                                    default:
                                                        $Statusname = 'Pending';
                                                        $statusClass = 'status Pending';
                                                        break;
                                                }

                                                echo '<li>';
                                                echo '<span class="role">' . htmlspecialchars($item['Name']) . '</span>';
                                                echo '<span class="role position">' . htmlspecialchars($item['Position']) . '</span>';
                                                echo '<span class="' . $statusClass . '">' . htmlspecialchars(ucfirst($Statusname)) . '</span>';
                                                echo '</li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="ch">
                                <div class="chart-card">
                                    <div class="chart-header">
                                        <h3>Students Status</h3>
                                        <div class="chart-legend">
                                        </div>
                                    </div>
                                    <div id="StudentsStatuschart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleNotifications() {
                const dropdown = document.getElementById("notificationDropdown");
                dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
            }

            async function loadNotifications() {
                try {
                    const response = await fetch('http://localhost/Gradlink/public/company/Messages/getunread');
                    const data = await response.json();

                    const listContainer = document.getElementById("notificationsList");
                    const badge = document.getElementById("notificationCount");

                    listContainer.innerHTML = ''; // Clear previous

                    if (data.length === 0) {
                        listContainer.innerHTML = '<p>No new notifications</p>';
                        badge.style.display = 'none';
                    } else {
                        badge.textContent = data.length;
                        badge.style.display = 'inline-block';

                        data.forEach(item => {
                            const el = document.createElement('div');
                            el.classList.add('notification-item');
                            el.innerHTML = `
                                            <strong>${item.session_name}</strong><br>
                                            <span>${item.session_date} | ${item.time_slot}</span>
                                        `;
                            listContainer.appendChild(el);
                        });
                        console.log(listContainer);

                    }

                } catch (error) {
                    console.error('Error fetching notifications:', error);
                }
            }

            // Load on page load
            document.addEventListener('DOMContentLoaded', loadNotifications);

            document.addEventListener("DOMContentLoaded", () => {
                // Make sure FullCalendar is loaded before initializing
                if (typeof FullCalendar !== 'undefined') {
                    initCompactCalendar();
                } else {
                    console.error('FullCalendar is not loaded');
                }

                function initCompactCalendar() {
                    const calendarEl = document.getElementById('compactCalendar');
                    const upcomingEventsDiv = document.getElementById('upcomingEvents');

                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev',
                            center: 'title',
                            right: 'next'
                        },
                        events: {
                            url: 'http://localhost/Gradlink/public/company/ShortlistedStudents/getInterviewSchedules',
                            method: 'GET',
                            success: function(response) {
                                console.log(response);

                                const today = new Date();
                                today.setHours(0, 0, 0, 0);
                                const futureEvents = response.filter(event => {
                                    const eventDate = new Date(event.start.split('T')[0]);
                                    return eventDate >= today;
                                });
                                displayUpcomingEvents(futureEvents);

                                // Transform the response to ensure allDay is true if you want full-day highlights
                                return response.map(event => {
                                    return {
                                        ...event,
                                        allDay: true, // Force all-day events
                                        start: event.start.split('T')[0], // Remove time portion
                                        end: event.end ? event.end.split('T')[0] : null,
                                        color: '#484eff'
                                    };
                                });
                            },
                            failure: function() {
                                console.error('Failed to fetch interview schedules');
                                upcomingEventsDiv.innerHTML = '<p class="no-events">Error loading schedule</p>';
                            }
                        },
                        eventDisplay: 'background', // This will highlight days with events
                        height: 'auto',
                        contentHeight: 'auto',
                        aspectRatio: 0.8,
                        eventColor: '#484eff',
                        eventTextColor: '#fff',
                        dayMaxEvents: true,
                        dayCellContent: function(arg) {
                            arg.dayNumberText = arg.dayNumberText.replace(/^0+/, '');
                        },
                        eventClick: function(info) {
                            info.jsEvent.preventDefault();
                        }
                    });

                    calendar.render();

                    function displayUpcomingEvents(events) {
                        const sortedEvents = [...events].sort((a, b) =>
                            new Date(a.start) - new Date(b.start));

                        const upcoming = sortedEvents.slice(0, 1);

                        const html = upcoming.length > 0 ?
                            upcoming.map(event => `
                                                <div class="upcoming-event">
                                                    <h4>${event.position}</h4>
                                                    <p><strong>Candidate:</strong> ${event.StudentName}</p>
                                                    <p><strong>Date:</strong> ${formatDate(event.start)}</p>
                                                    <p><strong>Time:</strong> ${formatTime(event.start, event.end)}</p>
                                                    </div>
                                            `).join('') :
                                                        '<p class="no-events">No upcoming interviews</p>';

                        upcomingEventsDiv.innerHTML = html;
                    }

                    function formatDate(dateString) {
                        const options = {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        return new Date(dateString).toLocaleDateString(undefined, options);
                    }

                    function formatTime(start, end) {
                        const startTime = new Date(start).toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        const endTime = new Date(end).toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        return `${startTime} - ${endTime}`;
                    }
                }
            });


            const AdStats = <?php echo json_encode($barchartdata); ?>;
            const AdStatslabels = AdStats.map(item => item.label);
            const AdStatscounts = AdStats.map(item => item.count);
            console.log(AdStatslabels);
            
            var AdStatusOptions = {
                series: [{
                    name: 'Advertisements',
                    data: AdStatscounts
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: false,
                        columnWidth: '40%',
                    },
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical', // Can also use 'horizontal' or 'diagonal'
                        shadeIntensity: 0.5,
                        gradientToColors: ['#7259B6'], // Secondary color
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100]
                    }
                },
                colors: ['#6B6FD5'], // Base color
                xaxis: {
                    categories: AdStatslabels,
                },
                yaxis: {
                    title: {
                        text: 'Number of Advertisements'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Advertisements";
                        }
                    }
                }
            };


            var adStatusChart = new ApexCharts(document.querySelector("#studentStatusChart"), AdStatusOptions);
            adStatusChart.render();

            // Monthly application trends
            const monthlyapply = <?php echo json_encode($monthlyCounts); ?>;
            const monthlyapplyKeys = Object.keys(monthlyapply);
            const monthlyapplyValues = Object.values(monthlyapply);
            var applicationtrendsOptions = {
                series: [{
                    name: 'Students',
                    data: monthlyapplyValues
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 1,
                        horizontal: false,
                        columnWidth: '55%',
                    },
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#1455af'],
                xaxis: {
                    categories: monthlyapplyKeys,
                },
                yaxis: {
                    title: {
                        text: 'Number of Students'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " students"
                        }
                    }
                }
            };

            // var applicationtrendsChart = new ApexCharts(document.querySelector("#applicationtrendschart"), applicationtrendsOptions);
            // applicationtrendsChart.render();

            // student status
            const studentstatuschart = <?php echo json_encode($studentstatuschart); ?>;
            const statuslabels = studentstatuschart.map(item => item.label);
            const statusdata = studentstatuschart.map(item => item.count);

            // Base color per status
            const statusColorsMap = {
                "Shortlist": "#6C63FF",
                "Pending": "#FFB74D",
                "Recruit": "#4DB6AC",
                "Reject": "#EF5350"
            };

            // Deeper gradient color per status
            const gradientToColorsMap = {
                "Shortlist": "#4438D1",
                "Pending": "#F57C00",
                "Recruit": "#00897B",
                "Reject": "#C62828"
            };

            // Build arrays from maps
            const statusColors = statuslabels.map(label => statusColorsMap[label] || '#9E9E9E');
            const gradientToColors = statuslabels.map(label => gradientToColorsMap[label] || '#616161');

            var StudentsStatusOptions = {
                series: statusdata,
                chart: {
                    type: 'pie',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                labels: statuslabels,
                colors: statusColors,
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        type: 'diagonal',
                        shadeIntensity: 0.6,
                        gradientToColors: gradientToColors,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    y: {
                        formatter: val => `${val} students`
                    }
                }
            };

            var StudentsStatusChart = new ApexCharts(document.querySelector("#StudentsStatuschart"), StudentsStatusOptions);
            StudentsStatusChart.render();


            // Toggle functionality
            let appChartRendered = false;

            function toggleChart(chartId, button) {
                // Hide all charts
                document.querySelectorAll('.chart-container').forEach(chart => {
                    chart.style.display = 'none';
                });

                // Remove active class from all buttons
                document.querySelectorAll('.chart-toggle').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Show selected chart
                const chartContainer = document.getElementById(chartId);
                chartContainer.style.display = 'block';

                // Add active class to clicked button
                button.classList.add('active');

                // If switching to the application trends chart and it hasn't been rendered yet
                if (chartId === 'applicationtrendschart' && !appChartRendered) {
                    // Render it now
                    var applicationtrendsChart = new ApexCharts(chartContainer, applicationtrendsOptions);
                    applicationtrendsChart.render();
                    appChartRendered = true;
                }
            }



            // const ctx3 = document.getElementById('totalViewersChart2').getContext('2d');
            // const adstatus = <?php echo json_encode($countedadstatus); ?>;
            // const statusKeys = Object.keys(adstatus);
            // const statusValues = Object.values(adstatus);
        </script>
        <!-- Toast message from session -->
        <?php if (isset($_SESSION['flash'])): ?>
            <script>
                window.__flashMessage = <?php echo json_encode($_SESSION['flash']); ?>;
            </script>
        <?php
            unset($_SESSION['flash']);
        endif;
        ?>
    </body>

<?php elseif ($Status == 'Blocked') : ?>

    <head>
        <title>Gradlink</title>
        <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
        <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            body,
            html {
                font-family: 'Poppins', sans-serif;
                background-color: rgb(206, 230, 255);
                color: #333;
                margin: 0;
                padding: 0;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container {
                width: 90%;
                max-width: 650px;
                background: #fff;
                padding: 40px;
                border-radius: 16px;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            h1 {
                font-size: 30px;
                margin-bottom: 16px;
                color: #0d6efd;
            }

            p {
                font-size: 16px;
                margin: 10px 0;
            }

            .company-info {
                text-align: left;
                margin: 24px 0;
                padding: 16px;
                background: #f8f9fa;
                border-radius: 8px;
            }

            .company-info p {
                margin: 8px 0;
            }

            .company-info strong {
                display: inline-block;
                width: 140px;
            }

            .logout-button {
                margin-top: 30px;
                padding: 12px 24px;
                font-size: 16px;
                color: #fff;
                background-color: #dc3545;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .logout-button:hover {
                background-color: #c82333;
            }

            @media (max-width: 600px) {
                .company-info strong {
                    width: 100px;
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Welcome, <span id="companyName"><?php echo $_SESSION['USER']->Name ?></span> ❌</h1>
            <p>We're sorry, but your account has been <strong>blocked</strong> by the UCSC PDC.</p>
            <p>If you believe this is a mistake or you have questions regarding your account status, please contact PDC for further assistance.</p>
            <p><strong>Note:</strong> You will not be able to access system features until the issue is resolved.</p>
            <p><strong style="color: red;">Blocked Reason:</strong> <?php echo $blockreson ?></p>

            <div class="company-info">
                <p><strong>Company Name:</strong> <?php echo $_SESSION['USER']->Name ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['USER']->Email ?></p>
                <p><strong>Phone:</strong> <?php echo $_SESSION['USER']->ContactNum ?></p>
            </div>

            <form method="post" action="<?php echo ROOT ?>/logout">
                <button class="logout-button" type="submit">Log Out</button>
            </form>
        </div>
    </body>



<?php else : ?>

    <head>
        <title>Gradlink</title>
        <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
        <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            body,
            html {
                font-family: 'Poppins', sans-serif;
                background-color: rgb(206, 230, 255);
                color: #333;
                margin: 0;
                padding: 0;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container {
                width: 90%;
                max-width: 650px;
                background: #fff;
                padding: 40px;
                border-radius: 16px;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            h1 {
                font-size: 30px;
                margin-bottom: 16px;
                color: #0d6efd;
            }

            p {
                font-size: 16px;
                margin: 10px 0;
            }

            .company-info {
                text-align: left;
                margin: 24px 0;
                padding: 16px;
                background: #f8f9fa;
                border-radius: 8px;
            }

            .company-info p {
                margin: 8px 0;
            }

            .company-info strong {
                display: inline-block;
                width: 140px;
            }

            .logout-button {
                margin-top: 30px;
                padding: 12px 24px;
                font-size: 16px;
                color: #fff;
                background-color: #dc3545;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .logout-button:hover {
                background-color: #c82333;
            }

            @media (max-width: 600px) {
                .company-info strong {
                    width: 100px;
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Welcome, <span id="companyName"><?php echo $_SESSION['USER']->Name ?></span> 👋</h1>
            <p>Thank you for registering with us.</p>
            <p>Your account is pending approval by PDC.</p>
            <p><strong>Note:</strong> PDC will immediately review and approve your request. You will be notified once your account is activated.</p>

            <div class="company-info">
                <p><strong>Company Name:</strong> <?php echo $_SESSION['USER']->Name ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['USER']->Email ?></p>
                <p><strong>Phone:</strong> <?php echo $_SESSION['USER']->ContactNum ?></p>
            </div>

            <form method="post" action="<?php echo ROOT ?>/logout">
                <button class="logout-button" type="submit">Log Out</button>
            </form>
        </div>
    </body>




<?php endif ?>



</html>