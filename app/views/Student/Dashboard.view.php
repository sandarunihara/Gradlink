<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Fix.css"> 
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Studentsidebar.css"> 
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Dashboard.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="side">
            <?php $this->renderComponent("studentsidebar")  ?>
    </div>
    <div id="content">
            <div class="main">
                <div class="d">
                    <div >
                        <h1>DashBoard</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <i class="fas fa-calendar-alt"></i>
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <a href='../Profile/dashboard'>
                            <img src="<?php echo ROOT ?>/assets/img/" class="logo" />
                            <p><span>Nayana</span>Student</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d_main">
                    <div class="d_allsummery">
                        <div class="stats">
                            <div class="stat-card">
                                <h2>Applied Comapanies</h2>
                                <p>5</p>
                            </div>
                            <div class="stat-card">
                                <h2>Schedule Interviews</h2>
                                <p>3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>