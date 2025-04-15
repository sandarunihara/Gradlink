<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Complaint.css">
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
                        <h1>Complaints</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="main-container">
                    <div class="m_main">
                        <div class="complaint-navbar">
                            <div class="headcontainer">
                                <div class="m_content">
                                    <a href="http://localhost/Gradlink/public/company/Companydash/dashboard" class="backbtn">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </div>
                                <div class="complaint-filter-container">
                                    <i class="fas fa-filter"></i>
                                    <select class="status-select">
                                        <option value="all">All</option>
                                        <option value="reviewed">Reviewed</option>
                                        <option value="notReviewed">Not Reviewed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="add-complaint">
                                <a href="<?= ROOT ?>/company/CComplaint/addComplaint"><button>+ Add New</button></a>
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
                                                <?php foreach ($data as $Complaint): ?>
                                                    <tr class="complaint-row">
                                                        <td class="date"><?php echo $Complaint->CreatedAt ?></td>
                                                        <td class="topic"><?php echo $Complaint->Topic ?></td>
                                                        <td>
                                                            <!-- status -->
                                                            <button class="reviewed" onclick="location.href=`<?= ROOT ?>/company/CComplaint/viewComplaint/<?php echo $Complaint->ComplaintId ?>`">
                                                                <span class="status"><?php echo $Complaint->Status ?></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5">No Old Complaints found</td>
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