<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/Fix.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/Studentsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/Internship.css">
 
</head>
<body>
    <?php
        $Name = $data['Student'] -> Name;

    ?>
    <div class="side">
        <?php $this->renderComponent("studentsidebar")  ?>
    </div>
    <div id="content">
        <div class="main">
            <div class="d">
                <div >
                    <h1>Advertisements</h1>
                </div>
                <div class="d_pro">
                    <div class="d_profile">
                        <i class="fas fa-calendar-alt"></i>
                        <i class="fas fa-bell"></i>
                    </div>
                    <div>
                        <a href="<?=ROOT?>/Student/StudentProfile/Profile">
                            <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($Name)?>.jpg" height ="400px" weight="400px"class="logo" />
                            <p><span><?php echo($Name)?></span>Student</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="advertisement-main">
                <div class="allpost">
                    <div class="postcard" data-status="Active">
                        <div class="image">
                            <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                            <a href="<?=ROOT?>/Student/StudentAd/advertisementView" class="top-left-link">View</a>
                        </div>
                        <div class="postdetails">
                            <p>Position:<span class="position">Software Engineer</span></p>
                            <p>Working Mode:<span>Remote</span></p>
                            <p>No of interns:<span>5</span></p>
                            <p>Deadline:<span>2024-12-31</span></p>
                        </div>
                    </div>
                    <div class="postcard" data-status="Inactive">
                        <div class="image">
                            <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                            <a href="<?=ROOT?>/Student/StudentAd/advertisementView" class="top-left-link">View</a>
                        </div>
                        <div class="postdetails">
                            <p>Position:<span class="position">Data Analyst</span></p>
                            <p>Working Mode:<span>Hybrid</span></p>
                            <p>No of interns:<span>3</span></p>
                            <p>Deadline:<span>2024-11-30</span></p>
                        </div>
                    </div>
                    <!-- Add more advertisements as needed -->
                </div>

            </div>
        </div>
    </div>
</body>
</html>