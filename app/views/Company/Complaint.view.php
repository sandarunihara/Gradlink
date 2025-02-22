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
                                <a href="<?= ROOT ?>/company/Complaint/addComplaint"><button>+ Add New</button></a>
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
                                            <tr class="complaint-row">
                                                <td class="date">2024-01-10</td>
                                                <td class="topic">Lack of Guidance</td>
                                                <td>
                                                    <!-- status -->
                                                    <button class="reviewed" onclick="location.href='<?= ROOT ?>/company/Complaint/viewComplaint'">
                                                        <span class="status">Reviewed</span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="complaint-row">
                                                <td class="date">2024-01-10</td>
                                                <td class="topic">Lack of Guidance</td>
                                                <td>
                                                    <!-- status -->
                                                    <button class="not-reviewed" onclick="location.href=''">
                                                        <span class="status">Not Reviewed</span>
                                                    </button>
                                                </td>
                                            </tr>
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
</body>

</html>