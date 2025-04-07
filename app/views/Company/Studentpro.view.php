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
        <div>
            <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Students Profile</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="pro_container">
                    <a href="<?php echo htmlspecialchars($url) ?>" class="backreq">
                        <i class="fas fa-chevron-left"></i>
                        <h3>back</h3>
                    </a>
                    <div class="stu_details">
                        <div class="stu_pro">
                            <img src="<?php echo ROOT ?>/assets/img/Company/pro.jpg" />
                            <div class="stu_info">
                                <span><?php echo $data[0]->Name ?></span>
                                <p class="mail_no"><?php echo $data[0]->Email ?><br>
                                    <?php echo $data[0]->ContactNum ?></p>
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
                                <?php
                                $skills = explode(', ', $data[0]->Skills); // Convert comma-separated string to array
                                foreach ($skills as $skill) {
                                    echo "<p>" . htmlspecialchars($skill) . "</p>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="stu_pro_exp">
                            <div class="topic1" onclick="toggleSection('experienceContent', 'experienceIcon')">
                                <h2>Description</h2>
                                <i id="experienceIcon" class="fas fa-chevron-right"></i>
                            </div>
                            <div id="experienceContent" class="toggle-content">
                                <div class="projects">
                                    <p><?php echo $data[0]->ShortDesc ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="stu_pro_exp">
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
                        </div> -->
                        <!-- <div class="stu_pro_cetificates">
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
                        </div> -->
                        <div class="stu_pro_cv">
                            <h2>Curriculum Vitae(CV)</h2>
                            <div class="cv">
                                <i class="fas fa-file-pdf"></i>
                                <a href="pdf-link.pdf" target="_blank">Download here</a>
                            </div>
                        </div>
                        <div class="progress-report-container" id="progress-report-container">
                            <h2>Progress Reports</h2>
                            <div class="reports">
                                <div class="unread-report">
                                    <?php if(!empty($notReviewed)): ?>
                                    <h3>Unread Reports</h3>
                                    <?php foreach($notReviewed as $notReviewedreport): ?>
                                    <div class="report-con">
                                        <h4><?php echo $notReviewedreport->SubmissionDate ?></h4>
                                        <div>
                                            <i class="fas fa-file-pdf"></i>
                                            <a href="<?php echo '/Gradlink/public/assets/uploads/progress_docs/' . $notReviewedreport->Name; ?>" target="_blank">View here</a>
                                        </div>
                                        <div class="report-button">
                                            <button class="approve-report" onclick="openreportapproveModal(event,'<?php echo $notReviewedreport->	DocumentId; ?>')">Approve</button>
                                            <button class="reject-report" onclick="openreportrejectModal(event,'<?php echo $notReviewedreport->	DocumentId; ?>')">Reject</button>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="read-report">
                                <?php if(!empty($Reviewed)): ?>
                                    <h3>Read Reports</h3>
                                    <?php foreach($Reviewed as $Reviewedreport): ?>
                                    <div class="report-con">
                                        <h4><?php echo $Reviewedreport->SubmissionDate ?></h4>
                                        <div>
                                            <i class="fas fa-file-pdf"></i>
                                            <a href="<?php echo '/Gradlink/public/assets/uploads/progress_docs/' . $Reviewedreport->Name; ?>" target="_blank">View here</a>
                                        </div>
                                        <p><?php echo $Reviewedreport->Status ?></p>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="all_ar">
                            <form id="actionForm" method="post" action="">
                                <input type="hidden" name="submit_action" id="actionInput" value="">
                                <div class="acce_rej" id="ShortlistSection">
                                    <h3>Action :</h3>
                                    <div class="btn">
                                        <button type="button" value="reject" onclick="openRejectModal(event)" class="reject">Reject</button>
                                        <button type="button" value="shortlist" onclick="openShortlistConfirmModal(event)" class="accept">Shortlist</button>
                                    </div>
                                </div>

                                <div class="acce_rej" id="RecruitSection">
                                    <h3>Action :</h3>
                                    <div class="btn">
                                        <button type="button" onclick="openRejectModal(event)" class="reject">Reject</button>
                                        <?php if ($interviewschedule == 0): ?>
                                            <a class="view-profile-btn" href="<?php echo ROOT ?>/company/ShortlistedStudents/interviewschedule/<?php echo $data[0]->StudentId; ?>/<?php echo $adId ?>">Schedule Interview</a>
                                        <?php elseif ($interviewschedule == 1): ?>
                                            <button type="button" value="recruit" onclick="openRecruitConfirmModal(event)" class="accept">Recruit</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Shortlist Confirmation Modal -->
    <div id="Shortlist-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Shortlist this Student?</p>
            <div class="updatemodal-buttons">
                <button type="submit" name="shortlist" value="shortlist" class="updateyes-btn" onclick="confirmAction('Shortlist')">Yes</button>
                <button class="updateno-btn" onclick="closeShortlistConfirmModal()">No</button>
            </div>
        </div>
    </div>

    <!-- Recruit Confirmation Modal -->
    <div id="Recruit-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Recruit this Student?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmAction('Recruit')">Yes</button>
                <button class="updateno-btn" onclick="closeRecruitConfirmModal()">No</button>
            </div>
        </div>
    </div>

    <!-- Reject Confirmation Modal -->
    <div id="reject-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Reject this Student?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmAction('Reject')">Yes</button>
                <button class="updateno-btn" onclick="closeRejectModal()">No</button>
            </div>
        </div>
    </div>


    <!-- ***************** progress report status update modal ***************** -->

    <div id="report-approve-modal" class="report-updatemodal">
        <div class="reportupdatemodal-content">
            <form method="post" class="report-form" id="report-form">
                <h2>Topic</h2>
                <input type="hidden" name="DocumentId" id="DocumentId1" value="">
                <input type="hidden" name="report_submit_action" id="reportactionInput" value="Approved">
                <div class="input-field">
                    <label for="report-comment">Additional comments (optional):</label>
                    <textarea id="report-comment" name="report-comment" rows="4" placeholder="Enter comments..."></textarea>
                </div>
            </form>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmreportaction()">Confirm</button>
                <button class="updateno-btn" onclick="closeapproveModal()">Cancel</button>
            </div>
        </div>
    </div>


    <div id="report-reject-modal" class="report-updatemodal">
        <div class="reportupdatemodal-content">
            <form method="post" class="report-form" id="report-reject-form">
                <h2>Topic</h2>
                <input type="hidden" name="DocumentId" id="DocumentId2" value="">
                <input type="hidden" name="report_submit_action" id="reportactionInput" value="Rejected">
                <div class="input-field">
                    <label for="report-comment">Reason for rejection:</label>
                    <textarea required id="report-comment" name="report-comment" rows="4" placeholder="Enter comments..."></textarea>
                </div>
            </form>
            <div class="updatemodal-buttons">
                <button type="submit" class="updateyes-btn" onclick="confirmrejectreportaction()">Confirm</button>
                <button class="updateno-btn" onclick="closearejectModal()">Cancel</button>
            </div>
        </div>
    </div>



    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>



    <script>
        <?php if (!empty($error)) : ?>
            errorToast("<?php echo addslashes($error); ?>");
        <?php endif; ?>
        <?php if (!empty($success)) : ?>
            successToast("<?php echo addslashes($success); ?>");
        <?php endif; ?>




        // To open and close the modals and confirm actions
        function openShortlistConfirmModal(event) {
            event.preventDefault(); // Prevents the form from submitting immediately
            document.getElementById('Shortlist-modal').style.display = 'flex';
        }

        function closeShortlistConfirmModal() {
            document.getElementById('Shortlist-modal').style.display = 'none';
        }

        function openRecruitConfirmModal(event) {
            event.preventDefault();
            document.getElementById('Recruit-modal').style.display = 'flex';
        }

        function closeRecruitConfirmModal() {
            document.getElementById('Recruit-modal').style.display = 'none';
        }

        function openRejectModal(event) {
            event.preventDefault();
            document.getElementById('reject-modal').style.display = 'flex';
        }

        function closeRejectModal() {
            document.getElementById('reject-modal').style.display = 'none';
        }



        // Submits the form after confirmation
        function confirmAction(action) {
            // console.log('Action:', action);

            document.getElementById('actionInput').value = action;
            // Close the modal
            closeAllModals();

            // Submit the form
            document.getElementById('actionForm').submit();
        }

        function closeAllModals() {
            document.getElementById('Shortlist-modal').style.display = 'none';
            document.getElementById('Recruit-modal').style.display = 'none';
            document.getElementById('reject-modal').style.display = 'none';
        }







        // for progress report
        function openreportapproveModal(event,DocumentId) {
            event.preventDefault();
            document.getElementById('report-approve-modal').style.display = 'flex';
            document.getElementById('DocumentId1').value=DocumentId;
            
            
        }

        function closeapproveModal() {
            let modal = document.getElementById("report-approve-modal");
            if (modal) {
                modal.style.display = "none";
            }
        }

        function confirmreportaction() {
            closeapproveModal();
            document.getElementById('report-form').submit();
        }

        // report reject modals
        function openreportrejectModal(event,DocumentId) {
            event.preventDefault();
            document.getElementById('report-reject-modal').style.display = 'flex';
            document.getElementById('DocumentId2').value=DocumentId;
        }

        function closearejectModal() {
            let modal = document.getElementById("report-reject-modal");
            if (modal) {
                modal.style.display = "none";
            }
        }


        function confirmrejectreportaction() {
            closearejectModal();
            document.getElementById('report-reject-form').submit();
        }
    </script>


    <script>
        const currentUrl = window.location.href;

        // Ensure PHP outputs a valid JSON value
        const studentJobstatus = <?php echo json_encode($studentJobstatus, JSON_HEX_TAG); ?>;

        // Check if the URL contains "ShortlistedStudents/studentprofile"
        if (currentUrl.includes("ShortlistedStudents/studentprofile")) {
            // Show action section, hide nope section
            document.getElementById("RecruitSection").style.display = "block";
            document.getElementById("ShortlistSection").style.display = "none";
            document.getElementById("progress-report-container").style.display = "none";
        }
        // Check if the URL contains "StudentsRequests/studentprofile"
        else if (currentUrl.includes("StudentsRequests/studentprofile")) {
            if (studentJobstatus === 'Pending') {
                // Show nope section, hide action section
                document.getElementById("RecruitSection").style.display = "none";
                document.getElementById("ShortlistSection").style.display = "block";
                document.getElementById("progress-report-container").style.display = "none";
            } else {
                // Show action section, hide nope section
                document.getElementById("RecruitSection").style.display = "none";
                document.getElementById("ShortlistSection").style.display = "none";
                document.getElementById("progress-report-container").style.display = "none";
            }
        } else if (currentUrl.includes("RecruitStudents/studentprofile")) {
            document.getElementById("progress-report-container").style.display = "block";
            document.getElementById("RecruitSection").style.display = "none";
            document.getElementById("ShortlistSection").style.display = "none";
        } else {
            // Default behavior: hide both sections (optional)
            document.getElementById("ShortlistSection").style.display = "none";
            document.getElementById("RecruitSection").style.display = "none";
            document.getElementById("progress-report-container").style.display = "none";
        }
    </script>



</body>

</html>



<!-- // function toggleSection(sectionId, iconId) {
        //     const section = document.getElementById(sectionId);
        //     const icon = document.getElementById(iconId);

        //     if (section.classList.contains('show')) {
        //         // Collapse section
        //         section.style.height = `${section.scrollHeight}px`; // Set to full height initially
        //         window.getComputedStyle(section).height; // Trigger a reflow, flushing the CSS changes
        //         section.style.height = '0'; // Set height to 0 to animate closing
        //         section.classList.remove('show');
        //     } else {
        //         // Expand section
        //         section.style.height = `${section.scrollHeight}px`; // Set to full height to expand
        //         section.classList.add('show');
        //         section.addEventListener('transitionend', () => {
        //             // Remove inline height after animation completes
        //             section.style.height = 'auto';
        //         }, {
        //             once: true
        //         });
        //     }

        //     // Toggle icon rotation
        //     icon.classList.toggle('rotate');
        // } -->