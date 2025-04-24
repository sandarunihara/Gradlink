<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/StudentsR.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Recruit Students</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="sr_mainR">
                    <div class="sr_search">
                        <div class="filterbar">
                            <div class="sr_search-container">
                                <input id="searchInput" type="text" placeholder="Search Student">
                                <i class="fas fa-search"></i>
                            </div>
                            <!-- <select class="role-select">
                                <option value="all">All</option>
                                <option value="1">Not Review</option>
                                <option value="">Reviewed</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="filter-toggle" role="tablist" aria-label="Recruit or Accept List">
                        <button class="filter-btn active" id="acceptlist" role="tab" onclick="showacceptlist()">Accept List</button>
                        <button class="filter-btn " id="recruitlist" role="tab"  onclick="showrecruitlist()">Recruit List</button>
                    </div>
                    <div class="sub-container">
                        <div class="recruit-student-list" id="recruit-student-list">
                            <h4>Recruit List</h4>
                            <?php if (isset($data) && !empty($data)): ?>
                                <?php foreach ($data as $student): ?>
                                    <?php if($student['Action']=='Recruit'): ?>
                                    <a href="../RecruitStudents/studentprofile/<?php echo $student["AdvertisementId"]; ?>/<?php echo $student["StudentId"]; ?>" class="stu-profile">
                                        <div class="profile-photo">
                                            <?php if (!empty($student['ProfilePic'])) : ?>
                                                <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo $student['ProfilePic'] ?>" />
                                            <?php else: ?>
                                                <img src="<?php echo ROOT ?>/assets/img/Company/pro.jpg" />
                                            <?php endif ?>
                                        </div>
                                        <div class="student-details">
                                            <div class="name-container">
                                                <p class="name-detail"><?php echo htmlspecialchars($student['Student Name']); ?></p>
                                                <p class="position-detail">Intern <?php echo htmlspecialchars($student['Position']); ?></p>
                                            </div>
                                            <div class="report-one">
                                                <p class="notreeviewedstatus" style="display: none;"><?php echo htmlspecialchars($student["NotReviewedstatus"]); ?></p>
                                                <?php if ($student["NotReviewedstatus"] == true): ?>
                                                    <div class="green-dot"></div>
                                                    <p class="report-message">New unread Report Available</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="no-events">No students Recruit yet</p>
                            <?php endif; ?>
                        </div>
                        <div class="Accept-student-list" id="Accept-student-list">
                            <h4>Accepted List</h4>
                            <?php if (isset($data) && !empty($data)): ?>
                                <?php foreach ($data as $student): ?>
                                    <?php if($student['Action']=='Accept'): ?>
                                    <a href="../RecruitStudents/studentprofile/<?php echo $student["AdvertisementId"]; ?>/<?php echo $student["StudentId"]; ?>" class="stu-profile">
                                        <div class="profile-photo">
                                            <?php if (!empty($student['ProfilePic'])) : ?>
                                                <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo $student['ProfilePic'] ?>" />
                                            <?php else: ?>
                                                <img src="<?php echo ROOT ?>/assets/img/Company/pro.jpg" />
                                            <?php endif ?>
                                        </div>
                                        <div class="student-details">
                                            <div class="name-container">
                                                <p class="name-detail"><?php echo htmlspecialchars($student['Student Name']); ?></p>
                                                <p class="position-detail"><?php echo htmlspecialchars($student['Position']); ?></p>
                                            </div>
                                            <div class="report-one">
                                                <p class="notreeviewedstatus" style="display: none;"><?php echo htmlspecialchars($student["NotReviewedstatus"]); ?></p>
                                                <?php if ($student["NotReviewedstatus"] == true): ?>
                                                    <div class="green-dot"></div>
                                                    <p class="report-message">New unread Report Available</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="no-events">No students Recruit yet</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        document.getElementById('searchInput').addEventListener('input', filterTable);
        document.querySelector('.role-select').addEventListener('change', filterTable);

        function filterTable() {
            

            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const selectedRole = document.querySelector('.role-select').value.toLowerCase();
            const rows = document.querySelectorAll('.name-container');

            rows.forEach(row => {
                const studentName = row.querySelector('.name-detail').textContent.toLowerCase();
                const studentPosition = row.querySelector('.notreeviewedstatus').textContent.toLowerCase(); // Position

                const matchesSearch = studentName.includes(searchValue);
                const matchesRole = (selectedRole === "all" || studentPosition.toLowerCase() === selectedRole);

                // Show row if it matches search, role filter, and status filter
                if (matchesSearch && matchesRole) {
                    row.style.display = ''; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });
        }

        // const buttons = document.querySelectorAll('.filter-btn');
        // console.log(buttons);
        
        // buttons.forEach(btn => {
        //     btn.addEventListener('click', () => {
        //         buttons.forEach(b => b.classList.remove('active'));
        //         btn.classList.add('active');
        //     });
        // });

        function showrecruitlist(){
            // event.preventdefault();
            document.getElementById('acceptlist').classList.remove('active');
            document.getElementById('recruitlist').classList.add('active');
            document.querySelector('.recruit-student-list').style.display='flex';
            document.querySelector('.Accept-student-list').style.display='none';
        }
        function showacceptlist(){
            // event.preventdefault();
            document.getElementById('acceptlist').classList.add('active');
            document.getElementById('recruitlist').classList.remove('active');
            document.querySelector('.recruit-student-list').style.display='none';
            document.querySelector('.Accept-student-list').style.display='flex';
        }
    </script>

    <!-- Toast message from session -->
    <?php if (isset($_SESSION['flash'])): ?>
        <script>
            window.__flashMessage = <?php echo json_encode($_SESSION['flash']); ?>;
        </script>
    <?php
        unset($_SESSION['flash']);
    endif;
    ?>

</body>

</html>