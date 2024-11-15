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
        $UserId = $data['Student'] -> StudentId;
        $Name = $data['Student'] -> Name;
        $DegreeName = $data['Student'] -> DegreeName;
        $Email = $data['Student'] -> Email;
        $ContactNum = $data['Student'] -> ContactNum;
        $Github = $data['Student'] -> Github;
        $Linkedin = $data['Student'] -> Linkedin;
        $ShortDesc = $data['Student'] -> ShortDesc;


        $ProfilePicName = $data['studentProfilePic'] -> ProfilePicName;
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
                            <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($ProfilePicName)?>" class="logo" />
                            <p><span><?php echo($Name)?></span>Student</p>
                        </a>
                    </div>
                </div>
            </div>
        
        
            <div>
                <h1>Profile picture</h1>
                <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($ProfilePicName)?>" height ="200px" weight="200px" />
            </div>
            <div>
                <h1>interested areas</h1>
                <?php foreach($data['Skills'] as $skill): ?>
                    <p><?php echo($skill -> Skill)?></p>
                <?php endforeach; ?>
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
                <!-- <h2>Degree:</h2><?php echo($QualificationDegree)?>
                <h2>Start Date:</h2><?php echo($QualificationStartDate)?>
                <h2>End Date:</h2><?php echo($QualificationEndDate)?>
                <h2>Field of Study:</h2><?php echo($QualificationFieldOfStudy)?>
                <h2>Short Description:</h2><?php echo($QualificationShortDesc)?> -->
            </div>
            <div>
                <h1>Experience</h1>
                <!-- <h2>Job Title:</h2><?php echo($ExperienceJobTitle)?>
                <h2>Company:</h2><?php echo($ExPerienceCompany)?>
                <h2>Location:</h2><?php echo($ExperienceLocation)?>
                <h2>Employment Type:</h2><?php echo($ExperienceEmploymentType)?>
                <h2>Start Date:</h2><?php echo($ExperienceStartDate)?>
                <h2>End Date:</h2><?php echo($ExperienceEndDate)?>
                <h2>Short Description:</h2><?php echo($ExperienceShortDesc)?> -->

            </div>
            <div>
                <h1>Certifications</h1>
                <!-- <h2>Name:</h2><?php echo($CertificateName)?>
                <h2>Organization:</h2><?php echo($CertificateOrganization)?>
                <h2>Issue Date:</h2><?php echo($CertificateIssueDate)?>
                <h2>Expiration Date:</h2><?php echo($CertificateExpirationDate)?>
                <h2>Short Description:</h2><?php echo($CertificateShortDesc)?> -->

            </div>
            <a href="<?=ROOT?>/Student/StudentProfile/ProfileEdit">Edit Profile</a>
        </div>
    </div>
</body>
</html>