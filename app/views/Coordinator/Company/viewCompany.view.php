<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/viewCompany.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <?php if (isset($_SESSION['flash_message'])): ?>
        <script>
            window.__flashMessage = {
                message: <?= json_encode($_SESSION['flash_message']['message']) ?>,
                type: <?= json_encode($_SESSION['flash_message']['type']) ?>
            };
            window.__flashClearUrl = '/clear-flash'; // Your endpoint
        </script>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>

        <a href="<?= ROOT ?>/PDC_coordinator/dashboardCompany" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <main class="content">
            <div class="company-header">
                <div class="cover-image" style="background-image: url('<?= ROOT ?>/<?= !empty($companyData->coverimg) ? htmlspecialchars($companyData->coverimg) : 'assets/images/default-cover.jpg' ?>')">
                    <div class="company-logo" style="background-image: url('<?= ROOT ?>/<?= !empty($companyData->profileimg) ? htmlspecialchars($companyData->profileimg) : 'assets/images/default-profile.png' ?>')">
                        <?php if (empty($companyData->profileimg)): ?>
                            <div class="initials"><?= substr(htmlspecialchars($companyData->Name), 0, 1) ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="company-title">
                    <h1><?= htmlspecialchars($companyData->Name) ?></h1>
                    <span class="company-status <?= $companyData->Status === 'Blocked' ? 'status-blocked' : 'status-active' ?>">
                        <i class="fas fa-<?= $companyData->Status === 'Blocked' ? 'ban' : 'check-circle' ?>"></i>
                        <?= htmlspecialchars($companyData->Status) ?>
                    </span>
                </div>
            </div>

            <!-- Company Information Cards -->
            <div class="company-info-container">
                <!-- Basic Information Card -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-building"></i>
                        <h2>Company Information</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Company ID</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->CompanyId) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Contact Person</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->ContactPerson) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->Email) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->ContactNum) ?></div>
                        </div>
                    </div>
                </div>

                <!-- Address Information Card -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-map-marker-alt"></i>
                        <h2>Address</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Street No</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->No) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Street Lane</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->Lane) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">City</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->City) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">District</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->District) ?></div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Card -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-info-circle"></i>
                        <h2>Additional Details</h2>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Description</span>
                        <div class="info-value" style="border-bottom: none; padding-bottom: 0;"><?= htmlspecialchars($companyData->ShortDesc) ?></div>
                    </div>
                </div>

                <!-- Social Media Card -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-share-alt"></i>
                        <h2>Social Media</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Website</span>
                            <div class="info-value">
                                <?php if (!empty($companyData->Website)): ?>
                                    <a href="<?= htmlspecialchars($companyData->Website) ?>" target="_blank">Visit Website</a>
                                <?php else: ?>
                                    Not provided
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">LinkedIn</span>
                            <div class="info-value">
                                <?php if (!empty($companyData->Linkedin)): ?>
                                    <a href="<?= htmlspecialchars($companyData->Linkedin) ?>" target="_blank">View Profile</a>
                                <?php else: ?>
                                    Not provided
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
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