<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/complaint.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="side">
        <?php $this->renderComponent("studentSidebar")  ?>
    </div>
    <div class="content">
        <div class="header">
            <?php $this->renderComponent("studentHeader")  ?>
        </div>
        <div class="main-content">
            <div class="complaint-navbar">
                <div class="complaint-filter-container">
                    <i class="fas fa-filter"></i>
                    <select class="status-select">
                        <option value="all">All</option>
                        <option value="reviewed">Reviewed</option>
                        <option value="notReviewed">Not Reviewed</option>
                    </select> 
                </div>
                <div class = "add-complaint">
                    <a href="<?=ROOT?>/Student/StudentComplaint/newComplaint"><button>+ Add New</button></a>
                </div>
            </div>
            <div class="compliant-table-div">
                <div class="complaint-table-background">
                    <!-- Table -->
                    <div>
                        <table class="complaint-table">
                            <thead class="complaint-table-headings">
                                <th>
                                    <h5>Date</h5>
                                </th>
                                <th>
                                    <h5>Topic</h5>
                                <th>
                                    <h5>Status</h5>
                                </th>
                            </thead>
                            <tbody>
                                <?php if (isset($data) && !empty($data)): ?>
                                    <?php foreach ($data['Complaints'] as $complaint): ?>
                                        <?php
                                        $status = $complaint -> Status;
                                        $statusClass = ($status == 'reviewed') ? 'reviewed' : 'not-reviewed';
                                        $statusText = ($status == 'reviewed') ? 'Reviewed' : 'Not Reviewed';
                                        ?>
                                        <tr class="complaint-row">
                                            <td class="date"><?php echo htmlspecialchars($complaint -> Date); ?></td>
                                            <td class="topic"><?php echo htmlspecialchars($complaint -> Topic); ?></td>
                                            <td>
                                                <div class="<?php echo $statusClass; ?>">
                                                    <a href="<?=ROOT?>/Student/StudentComplaint/viewComplaint/<?php echo $complaint -> ComplaintId?>">    
                                                        <span class="status"><?php echo $statusText; ?></span>
                                                    </a>
                                                </div>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">No Complaints found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.status-select').addEventListener('change', filterTable);

        function filterTable() {
            const selectedComplaints = document.querySelector('.status-select').value.toLowerCase().replace(/\s+/g, "");
            const rows = document.querySelectorAll('.complaint-row');

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