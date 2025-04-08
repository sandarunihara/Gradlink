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
                <div class="sr_main">
                    <div class="sr_search">
                        <div class="filterbar">
                            <div class="sr_search-container">
                                <input id="searchInput" type="text" placeholder="Search Student">
                                <i class="fas fa-search"></i>
                            </div>
                            <select class="role-select">
                                <option value="all">All</option>
                                <option value="1">Not Review</option>
                                <option value="">Reviewed</option>
                            </select>
                        </div>
                    </div>
                    <div class="recruit-student-list">
                        <?php if (isset($data) && !empty($data)): ?>
                            <?php foreach ($data as $student): ?>
                                <a href="../RecruitStudents/studentprofile/<?php echo $student["AdvertisementId"]; ?>/<?php echo $student["StudentId"]; ?>" class="stu-profile">
                                    <div class="profile-photo">
                                        <img src="<?= ROOT ?>/assets/img/Student/Sandeepa.jpg" />
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
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No students Recruit yet</p>
                        <?php endif; ?>
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
            const rows = document.querySelectorAll('.stu-profile');

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