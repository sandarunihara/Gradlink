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
                            <div class="stat-card" onclick="window.location.href='http://localhost/Gradlink/public/company/Advertisements/dashboard'">
                                <div>
                                    <h2>Total Advertisements</h2>
                                    <p><?php echo $numOfAdvertisements ?></p>
                                </div>
                                <div class="chart1">
                                    <canvas id="totalViewersChart2"></canvas>
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

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx1 = document.getElementById('myChart').getContext('2d');
        const AdStats = <?php echo json_encode($barchartdata); ?>;
        console.log(AdStats);
        const labels = AdStats.map(label => label.label);
        const data = AdStats.map(data => data.count);
        const myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Applications per position',
                    data:data,
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
        const myChartfortrends = new Chart(ctx4, {
            type: 'line',
            data: {
                labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                datasets: [{
                    label: 'Student Course Engagement',
                    data: [0, 1, 3, 2, 5, 4, 6, 5, 4, 3, 5, 6],
                    backgroundColor: 'rgba(58, 106, 255, 0.2)',
                    borderColor: 'rgba(58, 106, 255, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });


        const ctx2 = document.getElementById('totalViewersChart').getContext('2d');
        const totalViewersChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Shortlist', 'Reject', 'Pending', 'Recruit'],
                datasets: [{
                    data: [513, 441, 621, 100],
                    backgroundColor: ['#0056b3', '#db4437', '#f4b400', '#0f9d58'],
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

        const ctx3 = document.getElementById('totalViewersChart2').getContext('2d');
        const totalViewersChart2 = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: ['Active', 'Deactive', 'Pending'],
                datasets: [{
                    data: [5, 4, 6],
                    backgroundColor: ['#0f9d58', '#db4437', '#f4b400'],
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