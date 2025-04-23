<!DOCTYPE html>
<html lang="en">

<head>
    <title>Students</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/notification/notificationOverview.css?v=<?= time() ?>">
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
        <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <h1>Notifications</h1>
                </div>
            </div>

            <div class="tabs-container">
                <?php $this->renderPDC_adminTabs("notificationTabs", ['activeTab' => $activeTab]); ?>
            </div>


            <div class="tab-content">
                <div class="tab-pane active">
                <section class="company-list">
                    <div class="list-header">
                        <!-- Optional Header Content -->
                    </div>

                    <div class="notification-container">
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $item): ?>
                                <div class="notification-item">
                                    <div class="notification-header">
                                        <div class="notification-title">
                                            <i class="fas fa-building"></i>
                                            <?= htmlspecialchars($item->type) ?> Request
                                        </div>
                                        <div class="notification-meta">
                                            <span class="badge pending-badge">Pending</span>
                                            <span class="notification-date"><?= htmlspecialchars($item->created_at) ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="notification-body">
                                        <p>
                                            <strong><?= htmlspecialchars($item->Name) ?></strong> has requested registration.
                                        </p>
                                    </div>
                                    
                                    <div class="notification-actions">
                                        <button class="action-btn approve" data-id="<?= $item->id ?>" data-type="<?= $item->type ?>">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                        <button class="action-btn reject" data-id="<?= $item->id ?>" data-type="<?= $item->type ?>">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                        <button class="action-btn view" data-id="<?= $item->id ?>">
                                            <i class="fas fa-eye"></i> View Details
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-notifications">
                                <p>No pending notifications</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Show corresponding content
                const tabId = button.getAttribute('data-tab');
                document.querySelector(`.tab-content[data-tab="${tabId}"]`).classList.add('active');
            });
        });

        // Activate first tab by default
        if (tabButtons.length > 0) {
            tabButtons[0].click();
        }
        });


        document.addEventListener('click', function(e) {
        // Check if the clicked element is an approve button or inside one
        const approveBtn = e.target.closest('.approve');
        if (approveBtn) {
            e.preventDefault();
            const id = approveBtn.getAttribute('data-id');
            const type = approveBtn.getAttribute('data-type');
            console.log('Approve clicked:', type, id);
            
            // Example of how to handle different types
            // if(type.includes('advertisement')) {
            //     window.location.href = `<?=ROOT?>/PDC_admin/ViewAdvertisement/activate/${id}/Active`;
            // }
            // Add other type handlers here
        }

        const rejectBtn = e.target.closest('.reject');
        if (rejectBtn) {
            e.preventDefault();
            const id = rejectBtn.getAttribute('data-id');
            const type = rejectBtn.getAttribute('data-type');
            console.log('Reject clicked:', type, id);
            // Handle reject logic
        }

        const viewBtn = e.target.closest('.view');
        if (viewBtn) {
            e.preventDefault();
            const id = viewBtn.getAttribute('data-id');
            console.log('View clicked:', id);
            // Handle view logic
        }

        });

    </script>

    </body>

</html>