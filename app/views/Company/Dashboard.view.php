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
            <?php $this->renderComponent("companysidebar")  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>DashBoard</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <a href="../companydash/calendar">
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                            <div class="notification-wrapper">
                                <div class="notification-icon" onclick="toggleDropdown()">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <div id="notificationDropdown" class="dropdown-content">
                                    <i class="fas fa-close" onclick="toggleclose()"></i>
                                    <p>No new notifications</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href='../Profile/dashboard'>
                                <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="logo" />
                                <p><span>WSO2</span>Company</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d_main">
                    <div class="d_allsummery">
                        <div class="stats">
                            <div class="stat-card">
                                <h2>Total Student Applied</h2>
                                <p><?php echo $numOfStudents; ?></p>
                            </div>
                            <div class="stat-card">
                                <h2>Total Student Shortlisted</h2>
                                <p><?php echo $numOfShortlistStudents ?></p>
                            </div>
                            <div class="stat-card">
                                <h2>Total Advertisements</h2>
                                <p><?php echo $numOfAdvertisements ?></p>
                            </div>
                        </div>
                        <div class="d_request">
                            <h3>Student Requests</h3>
                            <div class="d_alllist">
                                <ul>
                                    <?php
                                    if (empty($data)) {
                                        echo '<li>No requests found</li>';
                                    }else{
                                        // Get the first 8 elements from $data
                                        $firstEight = array_slice($data, 0, 8);
                                        

                                        // Loop through the first 8 items and display them
                                        foreach ($firstEight as $item) {
                                            $statusClass = ($item['Status'] === 'Pending') ? 'status pending' : (($item['Status'] === 'Shortlist') ? 'status shortlist' : 'status reject');
                                            
                                            echo '<li>';
                                            echo '<span class="role">' . htmlspecialchars($item['Name']) . '</span>';
                                            echo '<span class="role position">' . htmlspecialchars($item['Position']) . '</span>';
                                            echo '<span class="' . $statusClass . '">' . htmlspecialchars(ucfirst($item['Status'])) . '</span>';
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
                    </div>
                    <div class="d_infor">
                        <img src="<?php echo ROOT ?>/assets/img/company_dashboard.png" width="350" height="200" />
                        <div class="d_intr">
                            <div>
                                <h4>Simplified Management</h4>
                                <img src="<?php echo ROOT ?>/assets/img/company_dashboard2.png" width="300" height="170" />
                                <p>Easily manage internships with our intuitive system. Post opportunities, review applications, and track progress—all in one place.
                                    Our platform makes recruitment quick and efficient, helping you find the right talent effortlessly.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>