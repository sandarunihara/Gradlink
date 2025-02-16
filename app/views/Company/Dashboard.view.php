<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="<?php echo ROOT ?>/assets/js/Cscript.js" defer></script>
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content" class="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>DashBoard</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="d_main">
                    <div class="d_allsummery">
                        <div class="stats">
                            <div class="stat-card" onclick="window.location.href='http://localhost/Gradlink/public/company/Advertisements/dashboard'">
                                <div>
                                    <h2>Total Advertisements</h2>
                                    <p><?php echo $numOfAdvertisements ?></p>
                                </div>
                                <div class="chart1">
                                    <canvas id="totalViewersChart2"></canvas>
                                </div>
                            </div>
                            <div class="stat-card" onclick="window.location.href='http://localhost/Gradlink/public/company/StudentsRequests/dashboard'">
                                <div>
                                    <h2>Total Student Applied</h2>
                                    <p><?php echo $numOfStudents; ?></p>
                                </div>
                                <div class="chart1">
                                    <canvas id="totalViewersChart"></canvas>
                                </div>
                            </div>
                            <div class="stat-card" onclick="window.location.href='http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard'">
                                <div>
                                    <h2>Total Student Shortlisted</h2>
                                    <p><?php echo $numOfShortlistStudents ?></p>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottomcontent">
                        <div class="d_chart">
                            <h3>Applications by Job Position</h3>
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="d_chart">
                            <h3>Monthly application trends</h3>
                            <canvas id="myChartfortrends"></canvas>
                        </div>
                    </div>
                    <div class="bottomcontent2">
                        <div class="d_request">
                            <h3>Student Requests</h3>
                            <div class="d_alllist">
                                <ul>
                                    <?php
                                    if (empty($data)) {
                                        echo '<li>No requests found</li>';
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
                            <div class="d_view_all">
                                <a href="../StudentsRequests/dashboard">
                                    View All
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="d_chart">
                            <h3>Students Status</h3>
                            <canvas id="studentstatus"></canvas>
                        </div>

                        <!-- <div class="d_2com">
                            <div class="d_messaage"> -->
                                <div class="d_msglist">
                                    <h3>Messages</h3>
                                    <?php
                                    $details = [
                                        "Tech Talk" => "../Messages/TechTalk",
                                        "Intern Call" => "../Messages/pdc_message",
                                    ];

                                    $data = [
                                        ["name" => "PDC", "detail" => "Tech Talk", "time" => "7:34 PM"],
                                        ["name" => "PDC", "detail" => "Intern Call", "time" => "7:34 PM"],
                                    ];
                                    ?>

                                    <?php foreach ($data as $item): ?>
                                        <?php
                                        $detail = $item['detail'];
                                        $link = isset($details[$detail]) ? $details[$detail] : "#";
                                        ?>
                                        <a href="<?php echo $link; ?>" class="m_container">
                                            <div class="m_de">
                                                <img src="<?php echo ROOT ?>/assets/img/company/pdcphoto.jpg" width="40" height="40" />
                                                <div class="m_content">
                                                    <span class="m_name"><?php echo $item['name']; ?></span>
                                                    <span class="m_detail"><?php echo $detail; ?></span>
                                                    <span class="m_time"><?php echo $item['time']; ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <!-- <div class="d_view_all">
                                    <a href="../Messages/dashboard">
                                        View All
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div> -->
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx1 = document.getElementById('myChart').getContext('2d');
        const AdStats = <?php echo json_encode($barchartdata); ?>;
        const labels = AdStats.map(label => label.label);
        const data = AdStats.map(data => data.count);
        const myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Applications per position',
                    data: data,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)', // Teal
                        'rgba(255, 159, 64, 0.8)', // Orange
                        'rgba(255, 99, 132, 0.8)', // Red
                        'rgba(54, 162, 235, 0.8)', // Blue
                        'rgba(153, 102, 255, 0.8)', // Purple
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx4 = document.getElementById('myChartfortrends').getContext('2d');
        const monthlyapply= <?php echo json_encode($monthlyCounts); ?>;
        const monthlyapplyKeys = Object.keys(monthlyapply); 
        const monthlyapplyValues = Object.values(monthlyapply); 
        
        const myChartfortrends = new Chart(ctx4, {
            type: 'line',
            data: {
                labels: monthlyapplyKeys,
                datasets: [{
                    label: 'Monthly Internship Applications',
                    data: monthlyapplyValues,
                    backgroundColor: 'rgba(58, 106, 255, 0.2)',
                    borderColor: 'rgba(58, 106, 255, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });



        const ctx5 = document.getElementById('studentstatus').getContext('2d');
        const studentstatuschart = <?php echo json_encode($studentstatuschart); ?>;
        const statuslabels = studentstatuschart.map(label => label.label);
        const statusdata = studentstatuschart.map(data => data.count);
        
        const studentstatus = new Chart(ctx5, {
            type: 'pie',
            data: {
                labels: statuslabels,
                datasets: [{
                    data: statusdata,
                    backgroundColor: ['#0056b3','#f4b400','#0f9d58','#db4437',],
                    borderWidth: 0.5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        // display: false // Hide the legend
                    },
                    tooltip: {
                        // enabled: true // Hide tooltips on hover
                    }
                }
            }
        });

        const ctx3 = document.getElementById('totalViewersChart2').getContext('2d');
        const adstatus= <?php echo json_encode($countedadstatus); ?>;
        // console.log(adstatus);
        const statusKeys = Object.keys(adstatus); 
        const statusValues = Object.values(adstatus); 
        const totalViewersChart2 = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: statusKeys,
                datasets: [{
                    data: statusValues,
                    backgroundColor: [ '#db4437','#0f9d58', '#f4b400','#0056b3'],
                    borderWidth: 0.5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Hide the legend
                    },
                    tooltip: {
                        enabled: true // Hide tooltips on hover
                    }
                }
            }
        });
    </script>
</body>

</html>