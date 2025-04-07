<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Overview</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/application/viewApplication.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/style.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>

        <main class="content">
            <header class="header">
                <h1>Application Overview</h1>
            </header>

            <div class="tabs">
                <button class="tab-btn active" onclick="openTab(event, 'studentDetails')">Student Details</button>
                <button class="tab-btn" onclick="openTab(event, 'adDetails')">Advertisement Details</button>
                <button class="tab-btn" onclick="openTab(event, 'companyDetails')">Company Details</button>
            </div>

            <div class="tab-content" id="studentDetails">
                <?php if (!empty($application)) : ?>
                    <div class="card">
                        <h2>Student Details</h2>
                        <p><strong>Student ID:</strong> <?= $application['StudentId'] ?></p>
                        <p><strong>Name:</strong> <?= $application['StudentName'] ?></p>
                        <p><strong>Email:</strong> <?= $application['Email'] ?></p>
                        <p><strong>Contact:</strong> <?= $application['ContactNum'] ?></p>
                        <p><strong>Degree:</strong> <?= $application['DegreeName'] ?></p>
                        <p><strong>Status:</strong> <?= $application['Status'] ?></p>
                        <a href="<?= ROOT ?>/PDC_admin/ViewStudent/show/<?= $application['StudentId'] ?>" class="btn">View Full Profile</a>
                    </div>
                <?php else : ?>
                    <p>No student data available</p>
                <?php endif; ?>
            </div>

            <div class="tab-content" id="adDetails" style="display:none;">
                <?php if (!empty($application)) : ?>
                    <div class="card">
                        <h2>Advertisement Details</h2>
                        <p><strong>Position:</strong> <?= $application['position'] ?></p>
                        <p><strong>Status:</strong> <?= $application['status'] ?></p>
                        <p><strong>Number of Interns:</strong> <?= $application['numOfInterns'] ?></p>
                        <p><strong>Start Date:</strong> <?= $application['startdate'] ?></p>
                        <p><strong>Deadline:</strong> <?= $application['deadline'] ?></p>
                        <a href="<?= ROOT ?>/PDC_admin/ViewAdvertisement/show/<?= $application['advertisementId'] ?>" class="btn">View Advertisement</a>
                    </div>
                <?php else : ?>
                    <p>No advertisement data available</p>
                <?php endif; ?>
            </div>

            <div class="tab-content" id="companyDetails" style="display:none;">
                <?php if (!empty($application)) : ?>
                    <div class="card">
                        <h2>Company Details</h2>
                        <p><strong>Company Name:</strong> <?= $application['CompanyName'] ?></p>
                        <p><strong>Description:</strong> <?= $application['ShortDesc'] ?></p>
                        <a href="<?= $application['Linkedin'] ?>" target="_blank" class="btn">View LinkedIn</a>
                        <a href="<?= ROOT ?>/PDC_admin/ViewCompany/show/<?= $application['CompanyId'] ?>" class="btn">View Company</a>
                    </div>
                <?php else : ?>
                    <p>No company data available</p>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
</body>

</html>
