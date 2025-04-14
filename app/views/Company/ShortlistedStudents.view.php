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
                        <h1>Shortlisted Students</h1>
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
                                <option value="Quality Assurance">Quality Assurance</option>
                                <option value="Software Engineer">Software Engineer</option>
                                <option value="Web Developer">Web Developer</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Machine Learning">Machine Learning</option>
                                <option value="Data Analyst">Data Analyst</option>
                                <option value="Full Stack Developer">Full Stack Developer</option>
                                <option value="Backend Developer">Backend Developer</option>
                                <option value="Frontend Developer">Frontend Developer</option>
                                <option value="DevOps Engineer">DevOps Engineer</option>
                                <option value="Cloud Architect">Cloud Architect</option>
                                <option value="Cybersecurity Analyst">Cybersecurity Analyst</option>
                                <option value="AI Engineer">AI Engineer</option>
                                <option value="Mobile App Developer">Mobile App Developer</option>
                                <option value="Blockchain Developer">Blockchain Developer</option>
                                <option value="Game Developer">Game Developer</option>
                                <option value="UI/UX Designer">UI/UX Designer</option>
                                <option value="Product Manager">Product Manager</option>
                                <option value="System Administrator">System Administrator</option>
                                <option value="Network Engineer">Network Engineer</option>
                                <option value="Technical Support Engineer">Technical Support Engineer</option>
                                <option value="Embedded Systems Engineer">Embedded Systems Engineer</option>
                                <option value="Cloud Engineer">Cloud Engineer</option>
                                <option value="Software Architect">Software Architect</option>
                                <option value="Solutions Architect">Solutions Architect</option>
                                <option value="IT Consultant">IT Consultant</option>
                                <option value="Quality Engineer">Quality Engineer</option>
                                <option value="Business Intelligence Analyst">Business Intelligence Analyst</option>
                                <option value="RPA Developer">RPA Developer</option>
                                <option value="ERP Consultant">ERP Consultant</option>
                                <option value="Salesforce Developer">Salesforce Developer</option>
                                <option value="SAP Consultant">SAP Consultant</option>
                            </select>
                        </div>
                    </div>
                    <div class="sr_t">
                        <div class="sr_table">
                            <!-- Table -->
                            <div>


                                <table class="student-table">
                                    <thead class="sr_table_t">
                                        <th>
                                            <h5>Student Name</h5>
                                        </th>
                                        <th>
                                            <h5>Student Degree</h5>
                                        </th>
                                        <th>
                                            <h5>Position</h5>
                                        </th>
                                        <th>
                                            <h5>Action</h5>
                                        </th>
                                        <th>
                                            <h5>View</h5>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($data) && !empty($data)): ?>
                                            <?php foreach ($data as $student): ?>

                                                <?php
                                                $status = $student['Action'];
                                                switch ($status) {
                                                    case 'Recruit':
                                                        $statusText = 'Recruit';
                                                        $statusClass = 'Recruit';
                                                        break;
                                                    case 'Reject':
                                                        $statusText = 'Rejected';
                                                        $statusClass = 'Reject';
                                                        break;
                                                    case 'Interview Scheduled':
                                                        $statusText = 'Interview Scheduled';
                                                        $statusClass = 'Sendemail';
                                                        break;
                                                    case 'Interview Expired':
                                                        $statusText = 'Interview Expired';
                                                        $statusClass = 'Sendemail';
                                                        break;
                                                    default:
                                                        $statusText = 'Awaiting';
                                                        $statusClass = 'Pending';
                                                        break;
                                                }
                                                ?>

                                                <tr class="sr_row">
                                                    <td class="name"><?php echo htmlspecialchars($student['Student Name']); ?></td>
                                                    <td class="degree"><?php echo htmlspecialchars($student['Student Degree']); ?></td>
                                                    <td class="position"><?php echo htmlspecialchars($student['Position']); ?></td>
                                                    <td>
                                                        <div class="<?php echo $statusClass; ?>">
                                                            <span class="action"><?php echo $statusText; ?></span>
                                                        </div>
                                                    </td>
                                                    <td><a href="../ShortlistedStudents/studentprofile/<?php echo $student["AdvertisementId"]; ?>/<?php echo $student["StudentId"]; ?>"><button class="view-profile-btn">View Profile</button></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5">No students found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>



                            </div>
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
            const rows = document.querySelectorAll('.sr_row');

            rows.forEach(row => {
                const studentName = row.querySelector('.name').textContent.toLowerCase();
                const studentPosition = row.querySelector('.position').textContent.toLowerCase(); // Position

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