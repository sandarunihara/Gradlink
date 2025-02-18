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
                    <i class="material-icons">menu</i>
                    <h1>Dashboard</h1>
                </div>


            </header>

            <div class='round-type '>1st Round</div>


            <div class="main-body">
                <?php
                if (!empty($dashboardDetails)):
                    ?>
                    <div class="main-cards">
                        <div class='card' onclick='navigateToDashboardCompany();'>
                            <div class='card-inner'>
                                <i class="material-icons">business</i>
                                <h3>Company</h3>
                            </div>
                            <h1><?php echo $dashboardDetails['companyCount'] ?? 0; ?></h1>

                        </div>

                        <div class='card' onclick='navigateToDashboardStudent();'>
                            <div class='card-inner'>
                                <i class="material-icons">school </i>
                                <h3>Student</h3>
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


                            <div class="company-performance" style="margin-top: 30px;">
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
                            </div>
                        </div>


                    </div>


                <?php else: ?>
                    <p>Empty Data</p>
                <?php endif; ?>

            </div>

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

                window.onload = function () {

                    var chart1 = new CanvasJS.Chart("recruitment_CS", {
                        backgroundColor: "#EEF3F3",
                        theme: "light2",
                        animationEnabled: true,
                        subtitles: [
                            {
                                text: "Computer Science Degree",
                                fontSize: 20,
                            }
                        ],
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
                        backgroundColor: "#EEF3F3",
                        theme: "light2",
                        animationEnabled: true,
                        subtitles: [
                            {
                                text: "Information Systems Degree",
                                fontSize: 20,
                            }
                        ],
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
                        backgroundColor: "#EEF3F3",
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

                const monthName = month.toLocaleString('default', { month: 'long' }) + ' ' + month.getFullYear();
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
                        dayCell.onclick = function () {
                            showSessionDetails(dayString);
                        };
                    }

                    daysContainer.appendChild(dayCell);
                }
            }


            function showSessionDetails(date) {
                const modal = document.getElementById('schedule-modal');
                const title = document.getElementById('session-title');
                const detailsList = document.getElementById('session-details');

                title.innerText = `Sessions on ${date}`;
                detailsList.innerHTML = '';

                sessionData[date].forEach(session => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `
            <div class="session-box">
                <strong>${session.session_name}</strong> (${session.time})<br>
                <em>${session.Company}</em> <br> Hall: ${session.hall}<br><br>
                <p>${session.description}</p>
            </div>
        `;
                    detailsList.appendChild(listItem);
                });

                modal.style.display = 'block';
            }



            function closeModal() {
                const modal = document.getElementById('schedule-modal');
                modal.style.display = 'none';
            }

            // Close modal when clicking outside of it
            window.onclick = function (event) {
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


        </script>
</body>

</html>