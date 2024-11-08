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
        <h1>Profile picture</h1>
    </div>
    <div>
        <h1>interested areas</h1>
    </div>
    <div>
        <h1>short description</h1>
    </div>
    <div>
        <h1>User details</h1>
        <h2>Full Name:</h2>
        <h2>Email:</h2>
        <h2>Degree Name:</h2>
        <h2>Registration Name:</h2>
        <h2>Contact Number:</h2>
        <h2>Likedin Profile:</h2>
        <h2>Github Profile:</h2>
    </div>
    <div>
        <h1>Qualifications</h1>
    </div>
    <div>
        <h1>Experience</h1>
    </div>
    <div>
        <h1>Certifications</h1>
    </div>
    <button>Edit</button>
    <button>Delete profile</button>
</body>
</html>