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
    <?php
        $UserId = $data['Student'] -> UserId;
        $Name = $data['Student'] -> Name;
        $ShortDesc = $data['Student'] -> ShortDesc;
        $DegreeName = $data['Student'] -> DegreeName;
        $Email = $data['Email'] -> Email;
        $ContactNum = $data['ContactNum'] -> ContactNum;
        $InterestedArea = $data['InterestedArea'] -> InterestedArea;
        $Github = $data['Github'] -> Github;
        $Linkedin = $data['Linkedin'] -> Linkedin;
        $ProfilePic = $data['ProfilePic'] -> ProfilePic;
    ?>
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
                        <a href="<?=ROOT?>/Student/StudentProfile/Profile">
                            <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($ProfilePic)?>" height ="400px" weight="400px"class="logo" />
                            <p><span><?php echo($Name)?></span>Student</p>
                        </a>
                    </div>
                </div>
            </div>
        
        
            <div>
                <h1>Profile picture</h1>
            </div>
            <div>
                <h1>interested areas</h1><?php echo($InterestedArea)?>
            </div>
            <div>
                <h1>short description</h1><?php echo($ShortDesc)?>
            </div>
            <div>
                <h1>User details</h1>
                <h2>Full Name:</h2><?php echo($Name)?>
                <h2>Email:</h2><?php echo($Email)?>
                <h2>Degree Name:</h2><?php echo($DegreeName)?>
                <h2>Registration Number:</h2><?php echo($UserId)?>
                <h2>Contact Number:</h2><?php echo($ContactNum)?>
                <h2>Likedin Profile:</h2><?php echo($Linkedin)?>
                <h2>Github Profile:</h2><?php echo($Github)?>
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
        </div>
    </div>
</body>
</html>