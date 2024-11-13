<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Studentpro.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar")  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Students Profile</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <i class="fas fa-calendar-alt"></i>
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <a href='../Profile/dashboard'>
                                <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="logo" />
                                <p><span>WSO2</span>Company</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pro_container">
                    <a href="../dashboard" class="backreq">
                        <i class="fas fa-chevron-left"></i>
                        <h3>back</h3>
                    </a>
                    <div class="stu_details">
                        <div class="stu_pro">
                            <img src="<?php echo ROOT ?>/assets/img/Company/pro.jpg" />
                            <div class="stu_info">
                                <span><?php echo $data[0]->Name ?></span>
                                <p class="mail_no"><?php echo $data[0]->Email ?><br>
                                    0<?php echo $data[0]->ContactNum ?></p>
                                <div class="links">
                                    <div class="acc_link">
                                        <i class="fab fa-linkedin"></i>
                                        <a href="<?php echo $data[0]->Linkedin ?>"><?php echo $data[0]->Linkedin ?></a>
                                    </div>
                                    <div class="acc_link">
                                        <i class="fab fa-github"></i>
                                        <a href="<?php echo $data[0]->Github ?>"><?php echo $data[0]->Github ?></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="stu_pro_skill">
                            <h2>Skills</h2>
                            <div class="skills">
                                <p>Java</p>
                                <p>C++</p>
                                <p>C</p>
                                <p>Python</p>
                                <p>JavaScript</p>
                                <p>React</p>
                                <p>Angular</p>
                                <p>Node.js</p>
                                <p>Ruby</p>
                                <p>Kotlin</p>
                                <p>Express.js</p>
                                <p>HTML</p>
                                <p>CSS</p>
                            </div>
                        </div>
                        <div class="stu_pro_exp">
                            <div class="topic1" onclick="toggleSection('experienceContent', 'experienceIcon')">
                                <h2>Experience</h2>
                                <i id="experienceIcon" class="fas fa-chevron-right"></i>
                            </div>
                            <div id="experienceContent" class="toggle-content">
                                <div class="projects">
                                    <p>1.Hands-On Learning: Emphasize that students will gain real-world experience through practical projects, internships, or industry collaborations.</p>
                                    <p>2.Mentorship and Support: Describe access to faculty mentors, career advisors, and peer support groups.Flexible Learning Options: Mention any online, hybrid, or part-time study options available for students who may need flexibility.</p>
                                    <p>3.Student Life and Community: Showcase the vibrant campus life or online community, clubs, and events that help students connect with peers.</p>
                                    <p>4.Career Development Opportunities: Talk about workshops, resume reviews, interview prep sessions, and other career services available.</p>
                                    <p>5.Success Stories: Feature testimonials or stories from alumni to show potential career paths and achievements</p>
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
                                    <p>Project Showcase"See the creative and innovative projects completed by our students."<br><a href="#">https://asdasfas.com/c/6724d8f4-0ee0-8001-ae1f-e5c4c7096a6d#</a></p>
                                    <p>Internship Experiences"Hear about our students' hands-on learning experiences with top companies."<br><a href="#">https://asdasfas.com/c/6724d8f4-0ee0-8001-ae1f-e5c4c7096a6d#</a></p>
                                    <p>Alumni Achievements"Discover the paths our alumni have taken and where they are now."<br><a href="#">https://asdasfas.com/c/6724d8f4-0ee0-8001-ae1f-e5c4c7096a6d#</a></p>
                                    <p>Awards and Recognition"Learn about the awards and honors received by our outstanding students."<br><a href="#">https://asdasfas.com/c/6724d8f4-0ee0-8001-ae1f-e5c4c7096a6d#</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="stu_pro_cv">
                            <h2>Curriculum Vitae(CV)</h2>
                            <div class="cv">
                                <i class="fas fa-file-pdf"></i>
                                <a href="your-pdf-link.pdf" target="_blank">Download here</a>
                            </div>
                        </div>
                        <div class="all_ar">
                            <div class="acce_rej" id="ShortlistSection">
                                <h3>Action :</h3>
                                <div class="btn">
                                    <button onclick="openrejectModal()" class="reject">Reject</button>
                                    <button onclick="openconfirmModal()" class="accept">Shortlist</button>
                                </div>
                            </div>

                            <div class="acce_rej" id="RecruitSection">
                                <h3>Action :</h3>
                                <div class="btn">
                                    <button onclick="openrejectModal()" class="reject">Reject</button>
                                    <button onclick="openconfirmModal()" class="accept">Recruit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- confirmation-modal -->
    <div id="accept-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Shortlist this Student?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmModal()">No</button>
            </div>
        </div>
    </div>

    <div id="reject-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Reject this Student?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="">Yes</button>
                <button class="updateno-btn" onclick="closerejectModal()">No</button>
            </div>
        </div>
    </div>


    <script>
        function toggleSection(sectionId, iconId) {
            const section = document.getElementById(sectionId);
            const icon = document.getElementById(iconId);

            if (section.classList.contains('show')) {
                // If open, collapse it
                section.style.height = `${section.scrollHeight}px`; // Set to full height initially
                window.getComputedStyle(section).height; // Trigger a reflow, flushing the CSS changes
                section.style.height = '0'; // Set back to 0 to animate closing
                section.classList.remove('show');
            } else {
                // If closed, expand it
                section.style.height = `${section.scrollHeight}px`; // Set to full height to expand
                section.classList.add('show');
            }

            // Toggle icon rotation
            icon.classList.toggle('rotate');
        }

        // Get the modal
        function openconfirmModal() {
            document.getElementById('accept-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmModal() {
            document.getElementById('accept-modal').style.display = 'none';
        }



        function openrejectModal() {
            document.getElementById('reject-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closerejectModal() {
            document.getElementById('reject-modal').style.display = 'none';
        }
    </script>


    <script>
        // Get the current URL
        const currentUrl = window.location.href;

        // Check if the URL contains "ShortlistedStudents/studentprofile"
        if (currentUrl.includes("ShortlistedStudents/studentprofile")) {
            // Show action section, hide nope section
            document.getElementById("RecruitSection").style.display = "block";
            document.getElementById("ShortlistSection").style.display = "none";
        }
        // Check if the URL contains "StudentsRequests/studentprofile"
        else if (currentUrl.includes("StudentsRequests/studentprofile")) {
            // Show nope section, hide action section
            document.getElementById("RecruitSection").style.display = "none";
            document.getElementById("ShortlistSection").style.display = "block";
        } else {
            // Default behavior: hide both sections (optional)
            document.getElementById("ShortlistSection").style.display = "none";
            document.getElementById("RecruitSection").style.display = "none";
        }
    </script>


</body>

</html>