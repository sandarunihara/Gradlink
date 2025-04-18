<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Advertisement/viewAdvertisement.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
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
        <?php $this->renderComponent("coordinatorDashboard")  ?>

        <main class="main-content">
            <!-- <a href="<?= ROOT ?>/PDC_coordinator/dashboardAdvertisement/active" class="back-button">
                <i class="fas fa-arrow-left"></i>
            </a> -->

            <header class="content-header">
                <div class="header-title">
                    <h1>Advertisement Details</h1>
                    <p class="breadcrumb">Dashboard / Advertisements / #<?= htmlspecialchars($data->advertisementId) ?></p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline" onclick="history.back()">
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                </div>
            </header>
            
            
            <div class="advertisement-card">
                <div class="card-header">
                    <div class="advertisement-meta">
                        <span class="status-badge <?= strtolower(htmlspecialchars($data->status)) ?>">
                            <?= htmlspecialchars($data->status) ?>
                        </span>
                        <span class="post-date">
                            <i class="far fa-calendar-alt"></i> Posted: <?= date('M d, Y', strtotime(htmlspecialchars($data->startdate))) ?>
                        </span>
                    </div>
                    <h2 class="position-title"><?= htmlspecialchars($data->position) ?></h2>
                    <p class="company-name">
                        <i class="far fa-building"></i> <?= htmlspecialchars($data->Name) ?>
                    </p>
                </div>
                
                <div class="card-body">
                    <div class="advertisement-media">
                        <div class="media-container">
                            <img src="data:image/jpeg;base64,<?= htmlspecialchars($data->image) ?>" alt="Advertisement Image" class="advertisement-image">
                        </div>
                    </div>
                    
                    <div class="advertisement-details">
                        <div class="detail-section">
                            <h3 class="section-title">Position Details</h3>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <label>Working Mode</label>
                                    <p><?= htmlspecialchars($data->workingMode) ?></p>
                                </div>
                                <div class="detail-item">
                                    <label>Interns Required</label>
                                    <p><?= htmlspecialchars($data->numOfInterns) ?></p>
                                </div>
                                <div class="detail-item">
                                    <label>Start Date</label>
                                    <p><?= date('M d, Y', strtotime(htmlspecialchars($data->startdate))) ?></p>
                                </div>
                                <div class="detail-item">
                                    <label>End Date</label>
                                    <p><?= date('M d, Y', strtotime(htmlspecialchars($data->deadline))) ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-section">
                            <h3 class="section-title">Description</h3>
                            <div class="description-content">
                                <?= nl2br(htmlspecialchars($data->description)) ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>

        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>