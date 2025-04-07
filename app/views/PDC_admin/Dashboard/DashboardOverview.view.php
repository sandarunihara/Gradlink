<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/dashboard/overviewDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <div class="container">
    <?php $this->renderComponent("pdc_adminsidebar") ?>
        <div class="content">
            <div class="left">
                <div class="header">
                    <div>
                        <h1>Dashboard</h1>
                    </div>
                    <div class="icons">
                        <i class="fas fa-bell"></i>
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <i class="fas fa-user-graduate" style="font-size: 24px; color:rgb(19, 22, 25);"></i>
                        <h3>Registered Students</h3>
                        <p><?= $cards['registeredStdCount'];?></p>
                    </div>
                    <div class="card">
                        <i class="fas fa-building" style="font-size: 24px; color:rgb(18, 46, 25);"></i>
                        <h3>Registered Companies</h3>
                        <p><?= $cards['registeredCompCount'];?></p>
                    </div>
                    <div class="card">
                        <i class="fas fa-clipboard-list" style="font-size: 24px; color:rgb(52, 45, 25);"></i>
                        <h3>Total Placements</h3>
                        <p><?= $cards['workingStdCount'];?></p>
                    </div>
                </div>
                <div class="graphs">
                    <div class="chart-container">
                        <h3 id="chartHeading">Student Status</h3>
                        <canvas id="studentChart"></canvas>
                    </div>

                    <div class="chart-container">
                        <h3>Placement Trends (Last 5 Years)</h3>
                        <canvas id="placementChart"></canvas>
                    </div>
                </div>
                <div class="orders-table">
                    <h3>Recent Advertisements</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>Position</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th> <!-- Changed to a more meaningful column name -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($table)): ?>
                            <?php foreach($table as $advertisement): ?>
                                <tr>
                                    <td><?= $advertisement['advertisementId'];?></td>
                                    <td><?= $advertisement['companyName'];?></td>
                                    <td><?= $advertisement['position'];?></td>
                                    <td><?= $advertisement['deadline'];?></td>
                                    <td><?= $advertisement['workingMode'];?></td>
                                    <td>
                                        <a href="<?= ROOT ?>/PDC_admin/ViewAdvertisement/show/<?= $advertisement['advertisementId'] ?>">
                                            <button class="view-btn" title="Click to view details">View</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <td colspan="6">No advertisements found</td>
                        <?php endif; ?>
                            
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="right">
            <div class="date-time">
                <span class="round"><?= $cards['round'] ?></span>
                <div class="datetime-container">
                    <span id="date"></span> | <span id="time"></span>
                </div>
            </div>
            

            
            <div class="top-company">
                <h3>Top Companies</h3>
                
                    <div class='cards'>
                        <?php if (!empty($company)): ?>
                            <?php foreach($company as $comp): ?>
                                <div class="company-card">
                                    <img src="data:image/jpeg;base64,<?= $comp['profileimg'] ?>" alt="logo">
                                    <span><?= $comp['Name'];?></span>
                                    <a href="<?= ROOT ?>/PDC_admin/ViewCompany/show/<?= $comp['CompanyId'] ?>">
                                        <button class="view-btn" href='<?= ROOT ?>/'>View</button>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No companies found</p>
                        <?php endif; ?>
                    </div>
                    
            </div>
            <div class="top-student">
                <h3>Top 5 Students (GPA)</h3>
                <ol class="student-list">
                    <li>
                        <span class="student-name">John Doe</span>
                        <span class="gpa">9.8</span>
                    </li>
                    <li>
                        <span class="student-name">Jane Smith</span>
                        <span class="gpa">9.7</span>
                    </li>
                    <li>
                        <span class="student-name">Mike Johnson</span>
                        <span class="gpa">9.6</span>
                    </li>
                    <li>
                        <span class="student-name">Sarah Lee</span>
                        <span class="gpa">9.5</span>
                    </li>
                    <li>
                        <span class="student-name">Chris Evans</span>
                        <span class="gpa">9.4</span>
                    </li>
                </ol>
            </div>

            </div>
        </div>
    </div>
    <script>

const studentChartCtx = document.getElementById('studentChart').getContext('2d');
const studentChart = new Chart(studentChartCtx, {
    type: 'bar',
    data: {
        labels: ['Recruited', 'Rejected', 'Applied', 'Shortlisted'],
        datasets: [{
            data: [
                <?= intval($cards['workingStdCount']); ?>, 
                <?= intval($cards['rejectedStdCount']); ?>, 
                <?= intval($cards['appliedStdCount']); ?>, 
                <?= intval($cards['notAppliedStdCount']); ?>
            ], 
            backgroundColor: ['#a4abf0', '#f3917c', '#e7eeb0', '#a6ed8d'], 
            borderColor: ['#a4abf0', '#f3917c', '#e7eeb0', '#a6ed8d'], 
            borderWidth: 1, 
            hoverBackgroundColor: ['#8c95e8', '#f2704c', '#d3e18b', '#84dd65'], 
            hoverBorderColor: ['#8c95e8', '#f2704c', '#d3e18b', '#84dd65'], 
            hoverBorderWidth: 2,
            barPercentage: 0.5, 
            categoryPercentage: 0.6,
            borderSkipped: false // Ensures bars display correctly
        }]
    },
    options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 100 }
                    }
                },
            }
});


        const placementChartCtx = document.getElementById('placementChart').getContext('2d');
    new Chart(placementChartCtx, {
        type: 'line',
        data: {
            labels: ['2019', '2020', '2021', '2022', '2023'],
            datasets: [
                {
                    label: 'CS Placements',
                    data: [200, 250, 350, 450, 500], // Sample CS placement data
                    borderColor: '#2196F3',
                    backgroundColor: 'rgba(33, 150, 243, 0.2)',
                    fill: true
                },
                {
                    label: 'IS Placements',
                    data: [180, 200, 300, 400, 450], // Sample IS placement data
                    borderColor: '#FF5733',
                    backgroundColor: 'rgba(255, 87, 51, 0.2)',
                    fill: true
                }
            ]
        },
        options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 100 }
                    }
                },
            }
    });

        function updateDateTime() {
            const dateElement = document.getElementById('date');
            const timeElement = document.getElementById('time');
            
            const now = new Date();
            
            
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const date = now.toLocaleDateString('en-US', options);
            
            
            const time = now.toLocaleTimeString('en-US');
            
            dateElement.textContent = date;
            timeElement.textContent = time;
        }

        setInterval(updateDateTime, 1000);

        updateDateTime();

    </script>
</body>
</html>
