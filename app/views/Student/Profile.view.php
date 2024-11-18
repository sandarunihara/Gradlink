<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/Student/Fix.css"> 
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/Student/Studentsidebar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/Student/StudentProfile.css">
</head>
<body>
    <?php
        $StudentId = $data['Student'] -> StudentId;
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
                <h1>Profile</h1>
                <div class="d_pro">
                    <div class="d_profile">
                        <i class="fas fa-calendar-alt"></i>
                        <i class="fas fa-bell"></i>
                    </div>
                    <div>
                        <a href="<?=ROOT?>/Student/StudentProfile/Profile">
                            <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($Name)?>.jpg" height="400px" weight="400px" class="logo" />
                            <p><span><?php echo($Name)?></span>Student</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="pro_container">
                <div class="stu_details">
                    <div class="stu_pro">
                        <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($ProfilePicName)?>" height="200px" weight="200px" />
                        <div class="stu_info">
                            <span><?php echo $Name?></span>
                            <p class="mail_no"><?php echo $Email?><br><?php echo $ContactNum?></p>
                            <p><?php echo $StudentId?></p>
                            <p><?php echo $DegreeName?></p>
                            <div class="links">
                                <div class="acc_link">
                                    <a href="https://<?php echo $Linkedin?>" target="_blank">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </div>
                                <div class="acc_link">
                                    <a href="https://<?php echo $Github?>" target="_blank">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div><?php echo($ShortDesc)?></div>
                    <div class="stu_pro_skill">
                        <h2>Skills</h2>
                        <div class="skills">
                            <?php foreach($data['Skills'] as $skill): ?>
                                <p><?php echo($skill -> Skill)?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="stu_pro_exp">
                        <div class="topic1" onclick="toggleSection('experienceContent', 'experienceIcon')">
                            <h2>Experience</h2>
                            <i id="experienceIcon" class="fas fa-chevron-right"></i>
                        </div>
                        <div id="experienceContent" class="toggle-content">
                            <div class="projects">
                                <?php foreach($data['Experiences'] as $experience): ?>
                                    <p><?php echo($experience -> JobTitle)?> at <?php echo($experience -> Company)?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="stu_pro_cetificates">
                        <div class="topic1" onclick="toggleSection('cetificatesContent', 'cetificatesIcon')">
                            <h2>Cetificates</h2>
                            <i id="cetificatesIcon" class="fas fa-chevron-right"></i>
                        </div>
                        <div id="cetificatesContent" class="toggle-content">
                            <div class="cetificates">
                                <?php foreach($data['Certificates'] as $certificate): ?>
                                    <p><a href="<?php echo($certificate -> CredentialUrl)?>"><?php echo($certificate -> Name)?></a></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="stu_pro_exp">
                        <div class="topic1" onclick="toggleSection('qualificationContent', 'qualificationIcon')">
                            <h2>Qualification</h2>
                            <i id="qualificationIcon" class="fas fa-chevron-right"></i>
                        </div>
                        <div id="qualificationContent" class="toggle-content">
                            <div class="projects">
                                <?php foreach($data['Qualifications'] as $qualification): ?>
                                    <p><?php echo($qualification -> Degree)?> in <?php echo($qualification -> FieldOfStudy)?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="profile-edit">
                        <a href="<?=ROOT?>/Student/StudentProfile/ProfileEdit"><button>Edit Profile</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleSection(sectionId, iconId) {
            const section = document.getElementById(sectionId);
            const icon = document.getElementById(iconId);

            if (section.classList.contains('show')) {
                section.style.height = `${section.scrollHeight}px`;
                window.getComputedStyle(section).height;
                section.style.height = '0';
                section.classList.remove('show');
            } else {
                section.style.height = `${section.scrollHeight}px`;
                section.classList.add('show');
            }

            icon.classList.toggle('rotate');
        }
    </script>
</body>
</html>
