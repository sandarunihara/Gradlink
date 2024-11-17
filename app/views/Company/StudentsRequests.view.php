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
            <?php $this->renderComponent("companysidebar")  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Students Requests</h1>
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
                <div class="sr_main">
                    <div class="sr_search">
                        <div class="sr_search-container">
                            <input id="searchInput" type="text" placeholder="Search Student">
                            <i class="fas fa-search"></i>
                        </div>
                        <select class="role-select">
                            <option value="all">All</option>
                            <option value="Software Engineer">Software Engineer</option>
                            <option value="qa">QA</option>
                            <option value="Web Development">Web Development</option>
                        </select>
                        <div class="sr_filter-container">
                            <i class="fas fa-filter"></i>
                            <select class="status-select">
                                <option value="all">All</option>
                                <option value="Shortlisted">Shortlisted</option>
                                <option value="rejected">Rejected</option>
                                <option value="pending">Pending</option>
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
                                                $statusClass = ($status == 'Shortlist') ? 'Shortlist' : (($status == 'Reject') ? 'Reject' : 'Pending');
                                                $statusText = ($status == 'Shortlist') ? 'Shortlisted' : (($status == 'Reject') ? 'Rejected' : 'Pending');
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
                                                    <td><a href="../StudentsRequests/studentprofile/<?php echo $student["AdvertisementId"]; ?>/<?php echo $student["StudentId"]; ?>"><button class="view-profile-btn">View Profile</button></a></td>
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

    

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        document.getElementById('searchInput').addEventListener('input', filterTable);
        document.querySelector('.role-select').addEventListener('change', filterTable);
        document.querySelector('.status-select').addEventListener('change', filterTable);

        function filterTable() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const selectedRole = document.querySelector('.role-select').value.toLowerCase();
            const selectedStatus = document.querySelector('.status-select').value.toLowerCase();
            const rows = document.querySelectorAll('.sr_row');

            rows.forEach(row => {
                const studentName = row.querySelector('.name').textContent.toLowerCase();
                const studentPosition = row.querySelector('.position').textContent.toLowerCase(); // Position
                const studentStatus = row.querySelector('.action').textContent.toLowerCase(); // Adjusted to get text directly from the div

                const matchesSearch = studentName.includes(searchValue);
                const matchesRole = (selectedRole === "all" || studentPosition.toLowerCase() === selectedRole);
                const matchesStatus = (selectedStatus === "all" || studentStatus === selectedStatus.toLowerCase());

                // Show row if it matches search, role filter, and status filter
                if (matchesSearch && matchesRole && matchesStatus) {
                    row.style.display = ''; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });
        }
    </script>



</body>

</html>