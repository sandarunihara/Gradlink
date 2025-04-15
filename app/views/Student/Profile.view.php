<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/profile.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <script src="<?php echo ROOT ?>/assets/js/student/toast.js"></script> 
</head>
<body>
    <?php $this->renderComponent("studentHeader", ["title" => "Profile"])  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
        <div class="student-profile">
            <!-- Profile Header -->
            <div class="student-profile-header">
                <!-- Profile Picture -->
                <div class="student-profile-picture">
                    <i class="fas fa-pen"></i>
                    <img src="<?=ROOT?>/assets/img/Student/<?php echo htmlspecialchars($data['Student'] -> ProfilePic)?>" alt="Profile Picture">
                </div>
                
                <!-- Profile Info (Name & Major) -->
                <div class="student-profile-info-1">
                    <h2><?php echo $data['Student'] -> Name?></h2>
                    <p class="student-major"><?php echo htmlspecialchars($data['Student'] -> DegreeName)?></p>
                </div>

                <!-- Student Info (Email, ID, Contact) -->
                <div class="student-profile-info-2">
                    <p><span><?php
                        $studentId = $data['Student'] -> StudentId;
                        $part1 = substr($studentId, 0, 4);                            
                        $part2 = strtoupper(substr($studentId, 4, 2));                           
                        $part3 = substr($studentId, 6);                            
                        $studentId = "$part1/$part2/$part3";
                        echo htmlspecialchars($studentId);
                    ?></span></p>
                    <p><span><?php echo htmlspecialchars($data['Student'] -> Email)?></span></p>
                    <p><span><?php echo htmlspecialchars($data['Student'] -> ContactNum)?></span></p>
                </div>

                <!-- Links (LinkedIn, GitHub) -->
                <?php
                    $linkedinURL = $data['Student'] -> Linkedin;
                    $githubURL = $data['Student'] -> Github;
                    if (!preg_match('/^https?:\/\//', $linkedinURL) ) {
                        $linkedinURL = 'https://' . $linkedinURL;
                    }
                    if (!preg_match('/^https?:\/\//', $githubURL) ) {
                        $githubURL = 'https://' . $githubURL;
                    }
                ?>
                <div class="student-profile-info-3">
                    <p><a href="<?php echo htmlspecialchars($linkedinURL); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></p>
                    <p><a href="<?php echo htmlspecialchars($githubURL); ?>" target="_blank"><i class="fab fa-github"></i></a></p>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="student-profile-content">
                <!-- Skills Section -->
                <div class="student-skill">
                    <div class="skills">
                        <?php
                            if($data['Skills'] == 0){
                                echo "<p>No skills added</p>";
                            }else{
                                for ($i = 0; $i < count($data['Skills']); $i++) {
                                    echo "<p>" . htmlspecialchars($data['Skills'][$i] -> Skill) . "</p>";
                                }
                            }
                        ?>
                    </div>
                </div>

                <!-- Short Description Section -->
                <div class="student-short-description">
                    <p>
                        <?php echo htmlspecialchars($data['Student'] -> ShortDesc)?>
                    </p>
                </div>
            </div>
            <!-- Footer Section -->
            <div class="student-profile-footer">
                <div class="student-edit">
                    <button onclick="location.href='<?=ROOT?>/Student/StudentProfile/ProfileEdit';">Update Profile</button>
                </div>
                <div class="cv-download">
                    <a href="<?=ROOT?>/assets/uploads/cv/ <?php echo htmlspecialchars($data['Student'] -> cv)?>" target="_blank">
                        <button>
                            <i class="fas fa-file-arrow-down"></i> 
                            <span>Download Resume</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>   
    <!-- Toast -->
    <div id="toast-container" class="toast-container"></div>

    <?php if(array_key_exists('isUpdate', $_SESSION)){ ?>
        <?php if($_SESSION['isUpdate'] === 1){?>
            <script>
                successToast("Profile updated successfully");
            </script>
        <?php }else{ ?>
            <script>
                errorToast("Failed to update profile");
            </script>
        <?php } ?>
        <?php unset($_SESSION['isUpdate']);?>
    <?php }?>
</body>
</html>

