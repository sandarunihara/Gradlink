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
                        <h1>Sorted List</h1>
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
                                <?php foreach ($ad_data as $ad): ?>
                                    <option value="<?php echo $ad->id ?>"><?php echo $ad->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div>
                            </div>
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
                                            <h5>Position</h5>
                                        </th>
                                        <th>
                                            <h5>Action</h5>
                                        </th>
                                        <th>
                                            <h5>Interview Mark</h5>
                                        </th>
                                        <th>
                                            <h5>View</h5>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($data) && !empty($data)): ?>
                                            <?php foreach ($data as $student): ?>
                                                <?php
                                                $status = $student->Jobstatus;
                                                switch ($status) {
                                                    case 'Recruit':
                                                        $statusText = 'Recruit';
                                                        $statusClass = 'Recruit';
                                                        break;
                                                    case 'Accept':
                                                        $statusText = 'Accept';
                                                        $statusClass = 'Accept';
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
                                                        $statusClass = 'SendemailExpired';
                                                        break;
                                                    case 'Interview Marked':
                                                        $statusText = 'Interview Marked';
                                                        $statusClass = 'InterviewMarked';
                                                        break;
                                                    default:
                                                        $statusText = 'Awaiting';
                                                        $statusClass = 'Pending';
                                                        break;
                                                }
                                                ?>

                                                <tr class="sr_row">
                                                    <td class="name"><?php echo htmlspecialchars($student->StudentName); ?></td>
                                                    <td class="position"><?php echo htmlspecialchars($student->position); ?></td>
                                                    <td class="AdvertisementIdfil" style="display: none;"><?php echo htmlspecialchars($student->AdvertisementId); ?></td>
                                                    <td>
                                                        <div class="<?php echo $statusClass; ?>">
                                                            <span class="action"><?php echo $statusText; ?></span>
                                                        </div>
                                                    </td>
                                                    <td class="degree"><?php echo htmlspecialchars($student->Interview_mark); ?></td>
                                                    <td><a href="../ShortlistedStudents/studentprofile/<?php echo $student->AdvertisementId; ?>/<?php echo $student->StudentId; ?>"><button class="view-profile-btn">View Profile</button></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="no-events">No students found</td>
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
                const studentPosition = row.querySelector('.AdvertisementIdfil').textContent.toLowerCase(); // Position

                const matchesSearch = studentName.includes(searchValue);
                const matchesRole = (studentPosition.toLowerCase() === selectedRole);

                // Show row if it matches search, role filter, and status filter
                if (matchesSearch && matchesRole) {
                    row.style.display = ''; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            filterTable();
        });
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