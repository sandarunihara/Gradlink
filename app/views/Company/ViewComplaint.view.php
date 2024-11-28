<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/ViewComplaint.css">
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
                <div class="m_main">
                    <div class="complaint-navbar">
                        <div class="headcontainer">
                            <div class="m_content">
                                <a href="http://localhost/Gradlink/public/company/Complaint/dashboard" class="backbtn">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="view-complaint-box">
                        <div class="complaint-description-box">
                            <h2>Complaint Description</h2>
                            <p class="complaint-description">
                            Complaint Description
                            </p>
                        </div>
                        <div class="complaint-description-box">
                            <h2>Coordinator's Response</h2>
                            <p class="complaint-description">
                            Coordinator's Response
                            </p>
                        </div>
                            <a href="<?= ROOT ?>/">
                                <button id="complaintDleteBtn">Delete Complaint</button>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>