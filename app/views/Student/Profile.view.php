<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/profile.css"> 
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
        <div class="page-header">
            <h1>Profile</h1>
        </div>
        <div class="main-content">
            <div class="student-profile">
                <!-- Profile Header -->
                <div class="student-profile-header">
                    <!-- Profile Picture -->
                    <div class="student-profile-picture">
                        <img src="<?=ROOT?>/assets/img/Student/Sandeepa.jpg" alt="Profile Picture">
                    </div>
                    
                    <!-- Profile Info (Name & Major) -->
                    <div class="student-profile-info-1">
                        <h2>Sandeepa Kumar</h2>
                        <p class="student-major">Computer Science</p>
                    </div>

                    <!-- Student Info (Email, ID, Contact) -->
                    <div class="student-profile-info-2">
                        <p><span>2022/CS/179</span></p>
                        <p><span>Sandeepakumar@gmial.com</span></p>
                        <p><span>0710102456</span></p>
                    </div>

                    <!-- Links (LinkedIn, GitHub) -->
                    <div class="student-profile-info-3">
                        <p><a href=""><i class="fab fa-linkedin"></i></a></p>
                        <p><a href=""><i class="fab fa-github"></i></a></p>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="student-profile-content">
                    <!-- Skills Section -->
                    <div class="student-skill">
                        <div class="skills">
                            <p>JavaScript</p>
                            <p>Node.js</p>
                            <p>Python</p>
                        </div>
                    </div>

                    <!-- Short Description Section -->
                    <div class="student-short-description">
                        <p>
                            I am a highly motivated and self-driven individual passionate about software development. A quick learner and a team player, always ready to take on new challenges. I am proficient in JavaScript, Node.js, and Python.
                        </p>
                    </div>
                </div>

                <!-- Footer Section -->
                <div class="student-profile-footer">
                    <!-- CV Section -->
                    <div class="student-cv">
                        <a href="<?=ROOT?>/assets/cvs/Sandeepa_CV.pdf" class="cv-link" target="_blank">View CV
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                    <div class="student-edit">
                        <a href="<?=ROOT?>/Student/StudentProfile/ProfileEdit"><button>Update Profile</button></a>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</body>
</html>

