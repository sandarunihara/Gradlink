<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notifications - PDC Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/notification/notificationRead.css?v=<?= time() ?>">
</head>

<body>
    <?php if (isset($_SESSION['flash_message'])): ?>
        <?php 
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
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Notifications</h1>
                </div>
            </header>

            <!-- Notification Type Tabs -->
            <nav class="tabs-container">
                <?php $this->renderPDC_adminTabs("notificationTabs", ['activeTab' => $activeTab]); ?>
            </nav>

            <!-- Notification Content Area -->
            <div class="tab-content">
                <div class="tab-pane active">
                    <section class="notification-list">
                        <div class="notification-container">
                            <?php if (!empty($data)): ?>
                                <!-- Coordinator Requests Section -->
                                <div class="notification-type-section">

                                    <?php foreach ($data as $item): ?>
                                        <?php if($item->type == 'coordinator_request'): ?>
                                            <article class="notification-item <?= strtolower($item->status) ?>">
                                                <div class="notification-header">
                                                    <h3 class="notification-title">Coordinator Access Request</h3>
                                                    <div class="notification-meta">
                                                        <span class="badge <?= strtolower($item->status) ?>-badge">
                                                            <?= htmlspecialchars($item->status) ?>
                                                        </span>
                                                        <time class="notification-date"><?= htmlspecialchars($item->created_at) ?></time>
                                                    </div>
                                                </div>
                                                
                                                <div class="notification-body">
                                                    <?php
                                                        $type = '';
                                                        $targetId = '';
                                                        if (!empty($item->student_id)) {
                                                            $type = 'student';
                                                            $targetId = $item->student_id;
                                                        } elseif (!empty($item->company_id)) {
                                                            $type = 'company';
                                                            $targetId = $item->company_id;
                                                        } elseif (!empty($item->advertisement_id)) {
                                                            $type = 'advertisement';
                                                            $targetId = $item->advertisement_id;
                                                        }
                                                    ?>

                                                    <?php if ($type && $targetId): ?>
                                                        <p><strong>Target:</strong> <?= ucfirst($type) ?> (ID: <?= htmlspecialchars($targetId) ?>)</p>

                                                        <?php if (!empty($item->reason)): ?>
                                                            <p><strong>Reason:</strong> <?= htmlspecialchars($item->reason) ?></p>
                                                        <?php endif; ?>

                                                        <div class="notification-actions">
                                                            <form method="post" action="<?= ROOT ?>/PDC_admin/AdminNotificationOverview/updateAndRedirect">
                                                                <input type="hidden" name="type" value="<?= $type ?>">
                                                                <input type="hidden" name="id" value="<?= $targetId ?>">
                                                                <input type="hidden" name="notification_id" value="<?= $item->id ?>">
                                                                <button type="submit" class="action-btn view">
                                                                    <i class="fas fa-eye"></i> View Details
                                                                </button>
                                                            </form>
                                                        </div>
                                                    <?php else: ?>
                                                        <p>Invalid notification data</p>
                                                    <?php endif; ?>
                                                </div>
                                            </article>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Deactivation Requests Section -->
                                <div class="notification-type-section">
                                    <?php foreach ($data as $item): ?>
                                        <?php if($item->type == 'deactivation_request'): ?>
                                            <article class="notification-item <?= strtolower($item->status) ?>">
                                                <div class="notification-header">
                                                    <h3 class="notification-title">Advertisement Deactivation Request</h3>
                                                    <div class="notification-meta">
                                                        <span class="badge <?= strtolower($item->status) ?>-badge">
                                                            <?= htmlspecialchars($item->status) ?>
                                                        </span>
                                                        <time class="notification-date"><?= htmlspecialchars($item->created_at) ?></time>
                                                    </div>
                                                </div>
                                                
                                                <div class="notification-body">
                                                    <p><strong>Requested by:</strong> <?= htmlspecialchars($item->company_id) ?></p>
                                                    <p><strong>Advertisement:</strong> <?= htmlspecialchars($item->advertisement_id) ?></p>
                                                

                                                    <div class="notification-actions">
                                                        <form method="post" action="<?= ROOT ?>/PDC_admin/AdminNotificationOverview/updateAndRedirect">
                                                            <input type="hidden" name="type" value="deactivation">
                                                            <input type="hidden" name="id" value="<?= $item->requested_by_id ?>">
                                                            <input type="hidden" name="notification_id" value="<?= $item->id ?>">
                                                            <button type="submit" class="action-btn view">
                                                                <i class="fas fa-eye"></i> View Account
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="no-notifications">
                                    <p>No pending notifications</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    
                    button.classList.add('active');
                    
                    const tabId = button.getAttribute('data-tab');
                    document.querySelector(`.tab-content[data-tab="${tabId}"]`).classList.add('active');
                });
            });

            // Activate first tab by default
            if (tabButtons.length > 0) {
                tabButtons[0].click();
            }

            // Show flash message if exists
            if (window.__flashMessage) {
                showToast(window.__flashMessage.message, window.__flashMessage.type);
            }
        });
    </script>
</body>
</html>