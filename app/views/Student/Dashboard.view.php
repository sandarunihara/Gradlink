<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/dashboard.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="side">
        <?php $this->renderComponent("studentSidebar")  ?>
    </div>
    <div class="content">
        <div class="header">
            <?php $this->renderComponent("studentHeader")  ?>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>Welcome, <?php echo $_SESSION['USER']->Name?></h1>
            </div>
            <div class="dashboard-cards">
                <div class="card">
                    <h3>Current Applications</h3>
                    <?php if ($data['numOfAppliedCompanies'] == 0): ?>
                        <p>You have no active applications.</p>
                    <?php else: ?>
                        <p>You have <?php echo htmlspecialchars($data['numOfAppliedCompanies'])?> active applications.</p>
                    <?php endif; ?>
                    <button onclick="location.href='<?=ROOT?>/Student/StudentAppliedCompanies/AppliedCompanies';">View Applications</button>
                </div>
                <div class="card">
                    <h3>Upcoming Interviews</h3>
                    <?php if (empty($data['interview_time_slot'])): ?>
                        <p>You have no upcoming interviews.</p>
                    <?php else: ?>
                        <p>Your next interview is on 
                            <?php 
                                echo (htmlspecialchars($data['day']) . " ");
                                echo (htmlspecialchars($data['monthName']) .".");
                            ?>
                        </p>
                    <?php endif; ?>
                    <button onclick="location.href='<?=ROOT?>/Student/StudentScheduleInterview/Interview';">View Interview</button>
                </div>
            </div>
            <div class="recent-activity">
                <h3>Recent Activity</h3>
                <ul>
                    <li>Applied for Software Developer at XYZ Corp</li>
                    <li>Updated your Profile</li>
                    <li>Scheduled an interview with ABC Ltd.</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>