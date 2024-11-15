<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Studentsidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Complaint.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <?php
        $Name = $data['Student'] -> Name;

    ?>
    <div class="side">
        <?php $this->renderComponent("studentsidebar")  ?>
    </div>
    <div id="content">
            <div class="main">
                <div class="d">
                    <div >
                        <h1>Complaints</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <i class="fas fa-calendar-alt"></i>
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <a href="<?=ROOT?>/Student/StudentProfile/Profile">
                            <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($Name)?>.jpg" height ="400px" weight="400px"class="logo" />
                            <p><span><?php echo($Name)?></span>Student</p>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- content of the page -->
                <div class="c_main">
                    <div class="c_search">
                        <div class = "add-complaint">
                            <a href="<?=ROOT?>/Student/StudentComplaint/newComplaint"><button>+ Add New</button></a>
                        </div>
                        <div class="c_filter-container">
                            <i class="fas fa-filter"></i>
                            <select class="status-select">
                                <option value="all">All</option>
                                <option value="reviewed">Reviewed</option>
                                <option value="notReviewed">Not Reviewed</option>
                            </select> 
                        </div>
                    </div>
                    <div class="c_t">
                        <div class="c_table">
                            <!-- Table -->
                            <div>
                                <table class="complaint-table">
                                    <thead class="c_table_t">
                                        <th>
                                            <h5>Date</h5>
                                        </th>
                                        <th>
                                            <h5>Topic</h5>
                                        <th>
                                            <h5>Status</h5>
                                        </th>
                                        <th>
                                            <h5>View</h5>
                                        </th>
                                        <th>
                                            <h5>Delete</h5>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($data) && !empty($data)): ?>
                                            <?php foreach ($data['Complaints'] as $complaint): ?>
                                                <?php
                                                $status = $complaint -> Status;
                                                $statusClass = ($status == 'reviewed') ? 'reviewed' : 'notReviewed';
                                                $statusText = ($status == 'reviewed') ? 'Reviewed' : 'Not Reviewed';
                                                ?>
                                                <tr class="c_row">
                                                    <td class="date"><?php echo htmlspecialchars($complaint -> Date); ?></td>
                                                    <td class="topic"><?php echo htmlspecialchars($complaint -> Topic); ?></td>
                                                    <td>    
                                                        <div class="<?php echo $statusClass; ?>">
                                                            <span class="status"><?php echo $statusText; ?></span>
                                                        </div>
                                                    </td>
                                                    <td><a href=""><button class="view-complaint-btn">View Complaint</button></a></td>
                                                    <td><a href=""><button class="delete-complaint-btn">Delete Complaint</button></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5">No Complaints found</td>
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
    <script>
        document.querySelector('.status-select').addEventListener('change', filterTable);

        function filterTable() {
            const selectedComplaints = document.querySelector('.status-select').value.toLowerCase().replace(/\s+/g, "");
            const rows = document.querySelectorAll('.c_row');

            rows.forEach(row => {
                    const date = row.querySelector('.date').textContent;
                    const topic = row.querySelector('.topic').textContent.toLowerCase().replace(/\s+/g, ""); // Position
                    const status = row.querySelector('.status').textContent.toLowerCase().replace(/\s+/g, ""); // Adjusted to get text directly from the div


                    const matchedComplaints = (selectedComplaints === "all" || status === selectedComplaints.toLowerCase());

                    // Show row if it matches search, role filter, and status filter
                    if (matchedComplaints) {
                        row.style.display = ''; // Show the row
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                });
            }
    </script>
</body>
</html>

