<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | PDC</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/dashboard/overviewDashboard.css">

</head>
<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        
        <main class="main-content">
            <!-- Header Section -->
            <header class="header">
                <div class="header-left">
                    <h1>Dashboard Overview</h1>
                </div>
                <div class="header-right">
                    <div class="notification">
                        <i class="fas fa-bell"></i>
                        <span class="dot"></span>
                    </div>

                    <div class="notification-grid">
                        <div class="notification-item">
                            <i class="fas fa-building"></i>
                            <span class="notification-text">New company registration pending</span>
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-user-graduate"></i> 
                            <span class="notification-text">New student registration pending</span>
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-ad"></i> 
                            <span class="notification-text">New advertisement pending</span>
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-ad"></i> 
                            <span class="notification-text">Advertisement deactivate request</span>
                        </div>
                    </div>

                    <div class="round-badge">
                        <span class="round-label">Current Round</span>
                        <span class="round-number"><?= $round->round ?></span>
                    </div>


                    <div class="round-view">
                        <p><?= $round->startDate ?> - <?=$round->endDate?></p>
                    </div>
                </div>
                
            </header>

            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="metric-info">
                        <h3>Registered Students</h3>
                        <p class="metric-value"><?= $cards['registeredStdCount'] ?></p>
                        <?php 
                            if (!empty($weekStd)) {
                                $latestweek = $weekStd[0];

                                if ($latestweek['trend'] == 'up') {
                                    echo "<p class='metric-change positive'><i class='fas fa-arrow-up'></i> {$latestweek['change']}% from last week</p>";
                                } else if ($latestweek['trend'] == 'down') {
                                    echo "<p class='metric-change negative'><i class='fas fa-arrow-down'></i> {$latestweek['change']}% from last week</p>";
                                } else {
                                    echo "<p class='metric-change neutral'><i class='fas fa-minus'></i> No change</p>";
                                }
                            } else {
                                echo "<p class='metric-change neutral'><i class='fas fa-minus'></i> Not enough data</p>";
                            }
                        ?>
                    </div>
                </div>
                
                <div class="metric-card">
                    <div class="metric-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="metric-info">
                        <h3>Registered Companies</h3>
                        <p class="metric-value"><?= $cards['registeredCompCount'] ?></p>
                        <?php 
                            $latestweek = $weekCom[0];
                            if ($latestweek['trend'] == 'up') {
                                echo "<p class='metric-change positive'><i class='fas fa-arrow-up'></i> {$latestweek['change']}% from last week</p>";
                            } else if ($latestweek['trend'] == 'down') {
                                echo "<p class='metric-change negative'><i class='fas fa-arrow-down'></i> {$latestweek['change']}% from last week</p>";
                            } else {
                                echo "<p class='metric-change neutral'><i class='fas fa-minus'></i> No change</p>";
                            }
                        ?>
                    </div>
                </div>
                
                <div class="metric-card">
                    <div class="metric-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="metric-info">
                        <h3>Placements</h3>
                            <p class="metric-value"><?= $cards['workingStdCount'] ?></p>
                            <?php 
                                if (!empty($recuitedStd)) {
                                    $latestweek = $recuitedStd[0];

                                    if ($latestweek['trend'] == 'up') {
                                        echo "<p class='metric-change positive'><i class='fas fa-arrow-up'></i> {$latestweek['change']}% from last week</p>";
                                    } else if ($latestweek['trend'] == 'down') {
                                        echo "<p class='metric-change negative'><i class='fas fa-arrow-down'></i> {$latestweek['change']}% from last week</p>";
                                    } else {
                                        echo "<p class='metric-change neutral'><i class='fas fa-minus'></i> No change</p>";
                                    }
                                } else {
                                    echo "<p class='metric-change neutral'><i class='fas fa-minus'></i> Not enough data</p>";
                                }
                            ?>
                    </div>
                </div>
                
                <div class="metric-card">
                    <div class="metric-icon">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div class="metric-info">
                        <h3>Active Ads</h3>
                        <p class="metric-value"><?= count($table) ?></p>
                        <?php 
                            if (!empty($weeklyAdd)) {
                                $latestweek = $weeklyAdd[0];

                                if ($latestweek['trend'] == 'up') {
                                    echo "<p class='metric-change positive'><i class='fas fa-arrow-up'></i> {$latestweek['change']}% from last week</p>";
                                } else if ($latestweek['trend'] == 'down') {
                                    echo "<p class='metric-change negative'><i class='fas fa-arrow-down'></i> {$latestweek['change']}% from last week</p>";
                                } else {
                                    echo "<p class='metric-change neutral'><i class='fas fa-minus'></i> No change</p>";
                                }
                            } else {
                                echo "<p class='metric-change neutral'><i class='fas fa-minus'></i> Not enough data</p>";
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="charts-section">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Student Placement Status</h3>
                        <div class="chart-legend">
                            <span class="legend-item"><span class="legend-color recruited"></span> Recruited</span>
                            <span class="legend-item"><span class="legend-color rejected"></span> Rejected</span>
                            <span class="legend-item"><span class="legend-color applied"></span> Applied</span>
                            <span class="legend-item"><span class="legend-color shortlisted"></span> Shortlisted</span>
                        </div>
                    </div>
                    <div id="studentStatusChart"></div>
                </div>
                
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Placement Trends (5 Years)</h3>
                        <div class="chart-legend">
                            <span class="legend-item"><span class="legend-color cs"></span> CS</span>
                            <span class="legend-item"><span class="legend-color is"></span> IS</span>
                        </div>
                    </div>
                    <div id="placementTrendChart"></div>
                </div>
            </div>

            <div class="data-section">
                <div class="data-card">
                    <div class="data-header">
                        <h3>Recent Advertisements</h3>
                        <a href="<?= ROOT ?>/PDC_admin/AdminAdvertisementOverview/dashboard" class="view-all">View All</a>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Company</th>
                                    <th>Position</th>
                                    <th>Deadline</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($table)): ?>
                                    <?php foreach($table as $advertisement): ?>
                                        <tr>
                                            <td>#<?= $advertisement['advertisementId'] ?></td>
                                            <td><?= $advertisement['companyName'] ?></td>
                                            <td><?= $advertisement['position'] ?></td>
                                            <td><?= date('M d, Y', strtotime($advertisement['deadline'])) ?></td>
                                            <td><span class="status-badge <?= strtolower($advertisement['workingMode']) ?>"><?= $advertisement['workingMode'] ?></span></td>
                                            <td>
                                                <a href="<?= ROOT ?>/PDC_admin/ViewAdvertisement/show/<?= $advertisement['advertisementId'] ?>" class="action-btn view-btn">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="no-data">No advertisements found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="sidebar-cards">
                    <div class="sidebar-card">
                        <div class="data-header">
                            <h3>Top Hiring Companies</h3>
                            <a href="<?= ROOT ?>/PDC_admin/AdminCompanyOverview/dashboard" class="view-all">View All</a>
                        </div>
                        <div class="companies-list">
                            <?php if (!empty($company)): ?>
                                <?php foreach($company as $comp): ?>
                                    <div class="company-item">
                                        <img src="data:image/jpeg;base64,<?= $comp['profileimg'] ?>" alt="<?= $comp['companyName'] ?>">
                                        <div class="company-info">
                                            <h4><?= $comp['companyName'] ?></h4>
                                            <p><?= $comp['Industry'] ?? 'N/A' ?></p>
                                        </div>
                                        <a href="<?= ROOT ?>/PDC_admin/ViewCompany/show/<?= $comp['CompanyId'] ?>" class="view-btn">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="no-data">No companies found</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Student Status Chart


        document.addEventListener("DOMContentLoaded" , function() {
           
        

        var studentStatusOptions = {
            series: [{
                name: 'Students',
                data: [
                    <?= intval($cards['workingStdCount']) ?>, 
                    <?= intval($cards['rejectedStdCount']) ?>, 
                    <?= intval($cards['appliedStdCount']) ?>, 
                    <?= intval($cards['notAppliedStdCount']) ?>
                ]
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { 
                    show: false 
                },
                background: 'transparent',
                foreColor: '#333'
            },
            plotOptions: {
                bar: {
                    borderRadius: 6,
                    horizontal: false,
                    columnWidth: '65%',
                    distributed: true,
                    endingShape: 'rounded',
                    dataLabels: {
                        position: 'top'
                    }
                },
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#333"]
                }
            },
            colors: ['rgba(76, 175, 80, 0.85)', 'rgba(244, 67, 54, 0.85)', 'rgba(255, 193, 7, 0.85)', 'rgba(33, 150, 243, 0.85)'],
            xaxis: {
                categories: ['Recruited', 'Rejected', 'Applied', 'Shortlisted'],
                axisBorder: {
                    show: true,
                    color: '#e0e0e0'
                },
                axisTicks: {
                    show: true,
                    color: '#e0e0e0'
                }
            },
            yaxis: {
                title: { 
                    text: 'Number of Students',
                    style: {
                        color: '#333',
                        fontSize: '14px'
                    }
                },
                min: 0,
                tickAmount: 5,
                labels: {
                    formatter: function(val) {
                        return Math.floor(val);
                    }
                },
                axisBorder: {
                    show: true,
                    color: '#e0e0e0'
                }
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 3,
                position: 'back',
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " students";
                    }
                },
                style: {
                    fontSize: '14px'
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'darken',
                        value: 0.7
                    }
                }
            }
        };

        var studentStatusChart = new ApexCharts(document.querySelector("#studentStatusChart"), studentStatusOptions);
        studentStatusChart.render();

        // Placement Trend Chart
        var placementTrendOptions = {
            series: [{
                name: 'Computer Science',
                data: [200, 250, 350, 450, 500]
            }, {
                name: 'Information Systems',
                data: [180, 200, 300, 400, 450]
            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: { show: false }
            },
            colors: ['#3F51B5', '#9C27B0'],
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                categories: ['2019', '2020', '2021', '2022', '2023'],
            },
            yaxis: {
                title: { text: 'Number of Placements' }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " placements"
                    }
                }
            },
            legend: { position: 'top' }
        };

        var placementTrendChart = new ApexCharts(document.querySelector("#placementTrendChart"), placementTrendOptions);
        placementTrendChart.render();


        const roundbtn = document.querySelector('.round-badge');
        const round = document.querySelector('.round-view');

        roundbtn.addEventListener('mouseover' , () =>{
            round.style.display = 'block';
        });

        roundbtn.addEventListener('mouseout' , () =>{
            round.style.display = 'none';
        });

        const notification = document.querySelector('.notification');
        const dot = document.querySelector('.dot');
 
        const companypending = <?php echo json_encode($pendingCom); ?>;

        // console.log(companypending);

        function updateNotificationDot(){
            if(companypending > 0){
                dot.style.display = 'block';
            }
            else{
                dot.style.display = 'none';
            }
        }

        updateNotificationDot();
        
    });

    </script>
</body>
</html>