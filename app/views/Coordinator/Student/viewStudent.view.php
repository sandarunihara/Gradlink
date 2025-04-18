<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Student/viewStudent.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <?php
    if (isset($_SESSION['flash_message'])):
        $message = htmlspecialchars($_SESSION['flash_message']['message']);
        $type = htmlspecialchars($_SESSION['flash_message']['type']);
        unset($_SESSION['flash_message']);
    ?>
        <script>
            window.__flashMessage = {
                message: "<?= $message ?>",
                type: "<?= $type ?>"
            };
        </script>
    <?php endif; ?>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard") ?>

        <main class="content">
            <div class="profile-header">
                <img src="<?= ROOT ?>/assets/images/default-profile.png" alt="Profile Image" class="profile-image">
                <div class="profile-title">
                    <h1><?= htmlspecialchars($data['Name']) ?></h1>
                    <span class="status <?= $data['Status'] === 'Blocked' ? 'status-blocked' : ($data['Status'] === 'Pending' ? 'status-pending' : 'status-active') ?>">
                        <i class="fas fa-<?= $data['Status'] === 'Blocked' ? 'ban' : ($data['Status'] === 'Pending' ? 'clock' : 'check-circle') ?>"></i>
                        <?= htmlspecialchars($data['Status']) ?>
                    </span>
                </div>
            </div>

            <div class="student-details">
                <div class="detail-card">
                    <h3><i class="fas fa-id-card"></i> Basic Information</h3>
                    <div class="detail-item">
                        <span class="detail-label">Registration Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['StudentId']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">NIC Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['NIC']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Degree Program</span>
                        <div class="detail-value"><?= htmlspecialchars($data['DegreeName']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Contact Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['ContactNum']) ?></div>
                    </div>
                </div>

                <div class="detail-card">
                    <h3><i class="fas fa-envelope"></i> Contact Information</h3>
                    <div class="detail-item">
                        <span class="detail-label">Email Address</span>
                        <div class="detail-value"><?= htmlspecialchars($data['Email']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Professional Links</span>
                        <div class="social-links">
                            <?php if (!empty($data['Github'])): ?>
                                <a href="<?= htmlspecialchars($data['Github']) ?>" target="_blank" class="social-link">
                                    <i class="fab fa-github"></i> GitHub
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($data['Linkedin'])): ?>
                                <a href="<?= htmlspecialchars($data['Linkedin']) ?>" target="_blank" class="social-link">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Applications Count</span>
                        <div class="detail-value"><?= htmlspecialchars($data['noOfAppliedAds']) ?> applications</div>
                    </div>
                </div>
            </div>

            <?php if (!empty($data['ShortDesc'])): ?>
                <div class="detail-card">
                    <h3><i class="fas fa-file-alt"></i> Student Description</h3>
                    <p><?= htmlspecialchars($data['ShortDesc']) ?></p>
                </div>
            <?php endif; ?>

            <div class="applications-section">
                <h3 class="section-title"><i class="fas fa-briefcase"></i> Applied Companies</h3>

                <?php if (empty($data['applications'])): ?>
                    <div class="no-applications">No companies applied yet</div>
                <?php else: ?>
                    <div class="applications-grid">
                        <?php foreach ($data['applications'] as $application): ?>
                            <div class="application-card">
                                <div class="application-header">
                                    <img src="data:image/jpeg;base64,<?= htmlspecialchars($application['CompanyLogo']) ?>" alt="Company Logo" class="company-logo">
                                    <div class="company-info">
                                        <div class="company-name"><?= htmlspecialchars($application['ComName']) ?></div>
                                        <span class="application-status 
                                            <?= strtolower(str_replace(' ', '-', htmlspecialchars($application['Jobstatus']))) ?>">
                                            <?= htmlspecialchars($application['Jobstatus']) ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="application-body">
                                    <div class="application-detail">
                                        <strong>Position:</strong> <?= htmlspecialchars($application['position']) ?>
                                    </div>
                                    <div class="application-detail">
                                        <strong>Applied On:</strong> <?= htmlspecialchars($application['CreatedAt']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="action-buttons">
                <button class="btn btn-back" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                
            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>