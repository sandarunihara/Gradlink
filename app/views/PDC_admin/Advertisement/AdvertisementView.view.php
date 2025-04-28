<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement Details | PDC Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/advertisement/viewAdvertisement.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
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


    <div class="admin-container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        
        <div class="main-content">
            <header class="content-header">
                <div class="header-title">
                    <h1>Advertisement Details</h1>
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
                            <img src="<?php echo ROOT .'/assets/img/Company/advertisements/' .  $data->image; ?>" alt="Advertisement Image" class="advertisement-image">
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
                
                <div class="card-footer">
                    <div class="action-buttons">
                        <?php if ($data->status == 'Active' || $data->status == 'Request'): ?>
                            <button class="btn btn-danger" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>', 'deactivate', '<?= htmlspecialchars($data->Email) ?>')">
                                <i class="fas fa-ban"></i> Deactivate
                            </button>
                        <?php elseif ($data->status == 'Deactive'): ?>
                            <button class="btn btn-success" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>', 'activate', '<?= htmlspecialchars($data->Email) ?>')">
                                <i class="fas fa-check-circle"></i> Activate
                            </button>
                        <?php elseif ($data->status == 'Pending'): ?>
                            <button class="btn btn-success" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>', 'activate', '<?= htmlspecialchars($data->Email) ?>')">
                                <i class="fas fa-check"></i> Approve
                            </button>
                            <button class="btn btn-danger" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>', 'reject', '<?= htmlspecialchars($data->Email) ?>')">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        <?php elseif ($data->status == 'Rejected'): ?>
                            <button class="btn btn-success" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>', 'activate', '<?= htmlspecialchars($data->Email) ?>')">
                                <i class="fas fa-redo"></i> Reactivate
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Confirmation Modal -->
    <div id="actionModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="actionForm" method="POST" action="<?= ROOT ?>/PDC_admin/ViewAdvertisement/handleAction">
                <h3 class="modal-title" id="modalTitle"></h3>
                
                <input type="hidden" name="advertisementId" id="hiddenAdId">
                <input type="hidden" name="action" id="hiddenAction">
                <input type="hidden" name="mail" id="hiddenEmail">
                
                <div id="reasonContainer" class="modal-field">
                    <label for="actionMessage">Reason for this action:</label>
                    <textarea name="reason" id="actionMessage" placeholder="Provide details about this decision..."></textarea>
                </div>

                <div id="confirmationMessage" class="modal-message">
                    <i class="fas fa-info-circle"></i>
                    <span id="messageText">Please confirm this action as it will be communicated to the company.</span>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js?v=<?= time() ?>"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>               

    <script>
        function openModal(adId, action, email) {
            const modal = document.getElementById('actionModal');
            const hiddenAdId = document.getElementById('hiddenAdId');
            const hiddenAction = document.getElementById('hiddenAction');
            const hiddenEmail = document.getElementById('hiddenEmail');
            const modalTitle = document.querySelector('.modal-title');
            const messageText = document.getElementById('messageText');
            const reasonContainer = document.getElementById('reasonContainer');
            const reasonTextarea = document.getElementById('actionMessage');

            hiddenAdId.value = adId;
            hiddenAction.value = action;
            hiddenEmail.value = email;

            switch(action) {
                case 'deactivate':
                    modalTitle.textContent = "Deactivate Advertisement";
                    messageText.textContent = "Are you sure you want to deactivate this advertisement? This action will be communicated to the company.";
                    reasonContainer.style.display = "block";
                    reasonTextarea.required = true;
                    break;

                case 'activate':
                    modalTitle.textContent = "Activate Advertisement";
                    messageText.textContent = "Are you sure you want to activate this advertisement?";
                    reasonContainer.style.display = "none";
                    reasonTextarea.required = false;
                    break;

                case 'reject':
                    modalTitle.textContent = "Reject Advertisement";
                    messageText.textContent = "Are you sure you want to reject this advertisement? Please provide a reason that will be communicated to the company.";
                    reasonContainer.style.display = "block";
                    reasonTextarea.required = true;
                    break;

                default:
                    modalTitle.textContent = "Unknown Action";
                    messageText.textContent = "An unknown action was requested.";
                    reasonContainer.style.display = "none";
                    reasonTextarea.required = false;
                    break;
            }

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('actionModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
        
    </script>
    </body>
</html>