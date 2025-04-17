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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                        <div>
                            <h3>Overview</h3>
                        </div>
                        <div class="d_allsummery">
                            <!-- Key Metrics Cards -->
                            <div class="metrics-grid">
                                <div class="metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <div class="metric-info">
                                        <h3>Total Advertisements</h3>
                                        <p class="metric-value"><?php echo $numOfAdvertisements ?></p>
                                        <p class="metric-change positive"><i class="fas fa-bullhorn"></i> 12% from last month</p>
                                    </div>
                                </div>

                                <div class="metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="metric-info">
                                        <h3>Total Student Applied</h3>
                                        <p class="metric-value"><?php echo $numOfStudents; ?></p>
                                        <p class="metric-change positive"><i class="fas fa-users"></i> 8% from last month</p>
                                    </div>
                                </div>

                                <div class="metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <div class="metric-info">
                                        <h3>Total Student Shortlisted</h3>
                                        <p class="metric-value"><?php echo $numOfShortlistStudents ?></p>
                                        <p class="metric-change positive"><i class="fas fa-user-check"></i> 15% from last round</p>
                                    </div>
                                </div>

                                <div class="metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-file-contract"></i>
                                    </div>
                                    <div class="metric-info">
                                        <h3>Active Ads</h3>
                                        <p class="metric-value">dsa</p>
                                        <p class="metric-change neutral"><i class="fas fa-minus"></i> No change</p>
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
                                        </div>
                                    </div>
                                    <div id="studentStatusChart"></div>
                                </div>
                                <div class="chart-card">
                                    <div class="chart-header">
                                        <h3>Monthly application trends</h3>
                                        <div class="chart-legend">
                                        </div>
                                    </div>
                                    <div id="applicationtrendschart"></div>
                                </div>
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
                            <div>
                                <div class="chart-card">
                                    <div class="chart-header">
                                        <h3>Students Status</h3>
                                        <div class="chart-legend">
                                        </div>
                                    </div>
                                    <div id="StudentsStatuschart"></div>
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
            const AdStats = <?php echo json_encode($barchartdata); ?>;
            const AdStatslabels = AdStats.map(item => item.label);
            const AdStatscounts = AdStats.map(item => item.count);
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
                        columnWidth: '55%',
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

            var applicationtrendsChart = new ApexCharts(document.querySelector("#applicationtrendschart"), applicationtrendsOptions);
            applicationtrendsChart.render();

            // student status
            const studentstatuschart = <?php echo json_encode($studentstatuschart); ?>;
            const statuslabels = studentstatuschart.map(item => item.label);
            const statusdata = studentstatuschart.map(item => item.count);

            // Define color mapping based on status
            const statusColorsMap = {
                "Shortlist": "#6C63FF", // soft violet-blue (matches your side icons)
                "Pending": "#FFB74D", // warm amber-orange (less harsh than pure amber)
                "Recruit": "#4DB6AC", // teal (cool, modern accent)
                "Reject": "#EF5350" // soft red (not too aggressive, fits UI style)
            };


            // Generate color array based on label order
            const statusColors = statuslabels.map(label => statusColorsMap[label] || '#9E9E9E'); // fallback gray

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
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " students";
                        }
                    }
                }
            };


            var StudentsStatusChart = new ApexCharts(document.querySelector("#StudentsStatuschart"), StudentsStatusOptions);
            StudentsStatusChart.render();

            // const ctx1 = document.getElementById('myChart').getContext('2d');
            // console.log(AdStats);

            // const labels = AdStats.map(label => label.label);
            // const data = AdStats.map(data => data.count);
            // const myChart = new Chart(ctx1, {
            //     type: 'bar',
            //     data: {
            //         labels: labels,
            //         datasets: [{
            //             label: 'Applications per position',
            //             data: data,
            //             backgroundColor: [
            //                 'rgba(75, 192, 192, 0.8)', // Teal
            //                 'rgba(255, 159, 64, 0.8)', // Orange
            //                 'rgba(255, 99, 132, 0.8)', // Red
            //                 'rgba(54, 162, 235, 0.8)', // Blue
            //                 'rgba(153, 102, 255, 0.8)', // Purple
            //             ],
            //             borderColor: [
            //                 'rgba(75, 192, 192, 1)',
            //                 'rgba(255, 159, 64, 1)',
            //                 'rgba(255, 99, 132, 1)',
            //                 'rgba(54, 162, 235, 1)',
            //                 'rgba(153, 102, 255, 1)',
            //             ],
            //             borderWidth: 1
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         scales: {
            //             y: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });

            // const ctx4 = document.getElementById('myChartfortrends').getContext('2d');


            // const myChartfortrends = new Chart(ctx4, {
            //     type: 'line',
            //     data: {
            //         labels: monthlyapplyKeys,
            //         datasets: [{
            //             label: 'Monthly Internship Applications',
            //             data: monthlyapplyValues,
            //             backgroundColor: 'rgba(58, 106, 255, 0.2)',
            //             borderColor: 'rgba(58, 106, 255, 1)',
            //             borderWidth: 2,
            //             fill: true
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         scales: {
            //             y: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });



            const ctx5 = document.getElementById('studentstatus').getContext('2d');


            const studentstatus = new Chart(ctx5, {
                type: 'pie',
                data: {
                    labels: statuslabels,
                    datasets: [{
                        data: statusdata,
                        backgroundColor: ['#0056b3', '#f4b400', '#0f9d58', '#db4437', ],
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

            // const ctx3 = document.getElementById('totalViewersChart2').getContext('2d');
            // const adstatus = <?php echo json_encode($countedadstatus); ?>;
            // // console.log(adstatus);
            // const statusKeys = Object.keys(adstatus);
            // const statusValues = Object.values(adstatus);
            // const totalViewersChart2 = new Chart(ctx3, {
            //     type: 'pie',
            //     data: {
            //         labels: statusKeys,
            //         datasets: [{
            //             data: statusValues,
            //             backgroundColor: ['#db4437', '#0f9d58', '#f4b400', '#0056b3'],
            //             borderWidth: 0.5
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         plugins: {
            //             legend: {
            //                 display: false // Hide the legend
            //             },
            //             tooltip: {
            //                 enabled: true // Hide tooltips on hover
            //             }
            //         }
            //     }
            // });
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