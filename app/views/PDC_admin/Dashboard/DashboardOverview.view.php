<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | PDC</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/dashboard/overviewDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        /* Modern Dashboard Styles */

        body{
            font-family: 'Poppins', sans-serif;

        }
        .container {
            display: flex;
            min-height: 100vh;
            background-color: #f5f7fa;
            font-family: 'Poppins', sans-serif;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            margin-left: 5%; 
            width: 95%;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-left h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .breadcrumbs {
            font-size: 0.85rem;
            color: #7f8c8d;
            margin-top: 0.5rem;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .date-time-card {
            background: white;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .current-round {
            background: #3f51b5;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .datetime {
            display: flex;
            flex-direction: column;
            font-size: 0.9rem;
        }

        .datetime #date {
            font-weight: 500;
            color: #2c3e50;
        }

        .datetime #time {
            color: #7f8c8d;
            font-size: 0.85rem;
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notification-btn {
            background: none;
            border: none;
            position: relative;
            cursor: pointer;
            color: #7f8c8d;
            font-size: 1.1rem;
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 600;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e0e0e0;
        }

        /* Filters Section */
        .filters-section {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-group label {
            font-size: 0.9rem;
            color: #7f8c8d;
            white-space: nowrap;
        }

        .filter-select {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
            background: white;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            min-width: 150px;
        }

        .filter-btn {
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .apply-filters {
            background: #3f51b5;
            color: white;
        }

        .apply-filters:hover {
            background: #334296;
        }

        .reset-filters {
            background: white;
            border: 1px solid #e0e0e0;
            color: #7f8c8d;
        }

        .reset-filters:hover {
            background: #f5f5f5;
        }

        /* Metrics Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .metric-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            display: flex;
            gap: 1.25rem;
            transition: transform 0.2s;
        }

        .metric-card:hover {
            transform: translateY(-5px);
        }

        .metric-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        .metric-icon i {
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .metric-card:nth-child(1) .metric-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .metric-card:nth-child(2) .metric-icon {
            background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%);
        }

        .metric-card:nth-child(3) .metric-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .metric-card:nth-child(4) .metric-icon {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .metric-info h3 {
            font-size: 0.95rem;
            color: #7f8c8d;
            margin: 0 0 0.5rem 0;
            font-weight: 500;
        }

        .metric-value {
            font-size: 1.75rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
            line-height: 1;
        }

        .metric-change {
            font-size: 0.75rem;
            margin: 0.5rem 0 0 0;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .metric-change.positive {
            color: #2ecc71;
        }

        .metric-change.negative {
            color: #e74c3c;
        }

        .metric-change.neutral {
            color: #7f8c8d;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 1200px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .chart-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .chart-legend {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }

        .legend-color.recruited {
            background: #4CAF50;
        }

        .legend-color.rejected {
            background: #F44336;
        }

        .legend-color.applied {
            background: #FFC107;
        }

        .legend-color.shortlisted {
            background: #2196F3;
        }

        .legend-color.cs {
            background: #3F51B5;
        }

        .legend-color.is {
            background: #9C27B0;
        }

        /* Data Section */
        .data-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 1200px) {
            .data-section {
                grid-template-columns: 1fr;
            }
        }

        .data-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }

        .data-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .data-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .view-all {
            font-size: 0.85rem;
            color: #3f51b5;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .view-all:hover {
            color: #2c3e50;
            text-decoration: underline;
        }

        .table-container {
            overflow-x: auto;
            padding: 0 1.5rem 1.5rem 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        th {
            text-align: left;
            padding: 0.75rem 1rem;
            color: #7f8c8d;
            font-weight: 500;
            background: #f9fafb;
            white-space: nowrap;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            color: #2c3e50;
            vertical-align: middle;
        }

        .company-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .company-cell img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge.internship {
            background: #e3f2fd;
            color: #1976d2;
        }

        .status-badge.fulltime {
            background: #e8f5e9;
            color: #388e3c;
        }

        .status-badge.parttime {
            background: #fff8e1;
            color: #ffa000;
        }

        .action-btn {
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .view-btn {
            background: #e3f2fd;
            color: #1976d2;
            border: none;
            cursor: pointer;
        }

        .view-btn:hover {
            background: #bbdefb;
        }

        .no-data {
            text-align: center;
            color: #7f8c8d;
            padding: 2rem;
            font-style: italic;
        }

        /* Sidebar Cards */
        .sidebar-cards {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .sidebar-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .card-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .companies-list, .students-list {
            padding: 1rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .company-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .company-item:last-child {
            border-bottom: none;
        }

        .company-item img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }

        .company-info {
            flex: 1;
        }

        .company-info h4 {
            font-size: 0.95rem;
            margin: 0;
            color: #2c3e50;
        }

        .company-info p {
            font-size: 0.8rem;
            margin: 0.25rem 0 0 0;
            color: #7f8c8d;
        }

        .company-item .view-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            color: #7f8c8d;
            text-decoration: none;
            transition: all 0.2s;
        }

        .company-item .view-btn:hover {
            background: #3f51b5;
            color: white;
        }

        .student-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .student-item:last-child {
            border-bottom: none;
        }

        .student-rank {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
            color: #7f8c8d;
        }

        .student-item:nth-child(1) .student-rank {
            background: #ffd700;
            color: white;
        }

        .student-item:nth-child(2) .student-rank {
            background: #c0c0c0;
            color: white;
        }

        .student-item:nth-child(3) .student-rank {
            background: #cd7f32;
            color: white;
        }

        .student-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .student-info h4 {
            font-size: 0.95rem;
            margin: 0;
            color: #2c3e50;
        }

        .student-info p {
            font-size: 0.8rem;
            margin: 0.25rem 0 0 0;
            color: #7f8c8d;
        }

        .student-gpa {
            font-size: 0.9rem;
            font-weight: 600;
            color: #2c3e50;
            margin-left: auto;
        }
    </style>

</head>
<body>

    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        
        <main class="main-content">
            <!-- Header Section -->
            <header class="dashboard-header">
                <div class="header-left">
                    <h1>Dashboard Overview</h1>
                </div>
                <div class="header-right">
                    <div class="date-time-card">
                        <span class="current-round">ROUND <?= $_SESSION['ROUNDID'] ?></span>
                        <div class="datetime">
                            <span id="date"></span>
                            <span id="time"></span>
                        </div>
                    </div>
                    <!-- <div class="user-actions">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="badge">3</span>
                        </button>
                        <div class="user-profile">
                            <img src="<?= ROOT ?>/assets/images/default-profile.png" alt="Admin">
                        </div>
                    </div> -->
                </div>
            </header>

            <!-- Key Metrics Cards -->
            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    
                    <div class="metric-info">
                        <h3>Registered Students</h3>
                        <p class="metric-value"><?= $cards['registeredStdCount'] ?></p>
                        
                        <?php 

                            $latestweek = $weekStd[0];

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
                        <p class="metric-change positive"><i class="fas fa-arrow-up"></i> 15% from last round</p>
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
                            $latestweek = $weeklyAdd[0];

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
            </div>

            <!-- Charts Section -->
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

            <!-- Data Tables Section -->
            <div class="data-section">
                <div class="data-card recent-ads">
                    <div class="data-header">
                        <h3>Recent Advertisements</h3>
                        <a href="<?= ROOT ?>/PDC_admin/advertisements" class="view-all">View All</a>
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
                                            <td>
                                                <div class="company-cell">
                                                    <?= $advertisement['companyName'] ?>
                                                </div>
                                            </td>
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
                    <div class="sidebar-card top-companies">
                        <div class="card-header">
                            <h3>Top Hiring Companies</h3>
                            <a href="<?= ROOT ?>/PDC_admin/companies" class="view-all">View All</a>
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
        // Update date and time
        // function updateDateTime() {
        //     const dateElement = document.getElementById('date');
        //     const timeElement = document.getElementById('time');
            
        //     const now = new Date();
            
        //     // Format date as "Monday, April 15, 2023"
        //     const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        //     const date = now.toLocaleDateString('en-US', dateOptions);
            
        //     // Format time as "HH:MM AM/PM"
        //     const time = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            
        //     dateElement.textContent = date;
        //     timeElement.textContent = time;
        // }

        // setInterval(updateDateTime, 1000);
        // updateDateTime();

        // Student Status Chart (ApexCharts)
        var studentStatusOptions = {
            series: [{
                name: 'Students',
                data: [
                    <?= intval($cards['workingStdCount']) ?>, 
                    <?= intval($cards['rejectedStdCount']) ?>, 
                    <?= intval($cards['appliedStdCount']) ?>, 
                    <?= intval($cards['notAppliedStdCount']) ?>
                ],
                colors: ['#4CAF50', '#F44336', '#FFC107', '#2196F3']
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
                    distributed: true 
                },
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#4CAF50', '#F44336', '#FFC107', '#2196F3'],
            xaxis: {
                categories: ['Recruited', 'Rejected', 'Applied', 'Shortlisted'],
            },
            yaxis: {
                title: {
                    text: 'Number of Students'
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " students"
                    }
                }
            }
        };

        var studentStatusChart = new ApexCharts(document.querySelector("#studentStatusChart"), studentStatusOptions);
        studentStatusChart.render();

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
                toolbar: {
                    show: false
                }
            },
            colors: ['#3F51B5', '#9C27B0'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                categories: ['2019', '2020', '2021', '2022', '2023'],
            },
            yaxis: {
                title: {
                    text: 'Number of Placements'
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " placements"
                    }
                }
            },
            legend: {
                position: 'top'
            }
        };

        var placementTrendChart = new ApexCharts(document.querySelector("#placementTrendChart"), placementTrendOptions);
        placementTrendChart.render();

        // document.querySelector('.apply-filters').addEventListener('click', function() {
        //     console.log('Filters applied');
        // });

        // document.querySelector('.reset-filters').addEventListener('click', function() {
        //     document.getElementById('time-filter').value = '30days';
        //     document.getElementById('department-filter').value = 'all';
        //     console.log('Filters reset');
        // });
    </script>
</body>
</html>