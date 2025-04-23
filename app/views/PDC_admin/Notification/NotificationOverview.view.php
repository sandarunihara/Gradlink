<!DOCTYPE html>
<html lang="en">

<head>
    <title>Students</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/overviewStudent.css?v=<?= time() ?>">
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

                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $item): ?>
                            <div class="notification-item pending">
                                <div class="notification-header">
                                    <div class="notification-type">
                                        <i class="fas fa-building"></i>
                                        <span><?= htmlspecialchars($item->type) ?></span>
                                    </div>
                                    <div class="notification-meta">
                                        <span class="notification-status badge pending"><?= htmlspecialchars($item->status) ?></span>
                                        <span class="notification-date"><?= htmlspecialchars($item->created_at) ?></span>
                                    </div>
                                </div>

                                <div class="notification-body">
                                    <p>
                                        <?= htmlspecialchars($item->type) ?>
                                        <strong><?= htmlspecialchars($item->Name) ?></strong> has requested registration.
                                    </p>
                                </div>

                                <div class="notification-actions">
                                    <button class="action-btn approve">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button class="action-btn reject">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                    <button class="action-btn view">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-notifications">
                            <p>No notifications available.</p>
                        </div>
                    <?php endif; ?>
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


        const approveBtn = document.querySelector('.approve');
        const rejectBtn = document.querySelector('.reject');
        const viewBtn = document.querySelector('.view');

        const type = document.querySelector('.notification-type span').textContent;

        if(type == 'advertisement_request'){
            approveBtn.addEventListener('click', function() {
                window.location.href = "<?=ROOT?>/PDC_admin/ViewAdvertisement/activate/<?=$data->advertisement_id?>/Active";
            });

            rejectBtn.addEventListener('click', function() {
                // Handle reject action
                console.log('Rejected');
            });

            viewBtn.addEventListener('click', function() {
                // Handle view details action
                console.log('View Details');
            });
        }

    </script>

    </body>

</html>