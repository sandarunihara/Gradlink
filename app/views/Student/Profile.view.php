<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Fix.css"> 
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Studentsidebar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
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
                            <a href="../StudentProfile/dashboard">
                            <img src="<?php echo ROOT ?>/assets/img/Student/nayana.jpg" height ="400px" weight="400px"class="logo" />
                            <p><span>Nayana</span>Student</p>
                            </a>
                        </div>
                    </div>
                </div>
            <div>
    <div>
    <div>
        Profile picture
    </div>
    <div>
        interested areas
    </div>
    <div>
        short description
    </div>
    <div>
        User details
        <h1>Full Name:</h1>
        <h1>Email:</h1>
        <h1>Degree Name:</h1>
        <h1>Registration Name:</h1>
        <h1>Contact Number:</h1>
        <h1>Likedin Profile:</h1>
        <h1>Github Profile:</h1>
    </div>
    <div>
        Qualifications
    </div>
    <div>
        Experience
    </div>
    <div>
        Certifications
    </div>
    <button>Edit</button>
    <button>Delete profile</button>
</body>
</html>