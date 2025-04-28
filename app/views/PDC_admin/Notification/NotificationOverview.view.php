<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - PDC Admin</title>
    
    <!-- CSS Links -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/notification/notificationOverview.css?v=<?= time() ?>">
</head>

<body>
    <!-- Flash Message Handling -->
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

            <!-- Tabs Navigation -->
            <nav class="tabs-container">
                <?php $this->renderPDC_adminTabs("notificationTabs", ['activeTab' => $activeTab]); ?>
            </nav>

            <!-- Tab Content -->
            <div class="tab-content">
                <div class="tab-pane active">
                    <section class="notification-list">
                        <div class="list-header"></div>

                        <div class="notification-container">
                            <?php if (!empty($data)): ?>
                                <?php foreach ($data as $item): ?>
                                    <?php if($item->type == 'coordinator_request'): ?>                                        
                                        <article class="notification-item <?= strtolower($item->status) ?>">
                                            <div class="notification-header">
                                                <h2 class="notification-title">
                                                    <i class="fas fa-user-tie" aria-hidden="true"></i>
                                                    Coordinator Request
                                                </h2>
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
                                                    <p><strong><?= ucfirst($type) ?> ID: <?= htmlspecialchars($targetId) ?></strong></p>

                                                    <?php if (!empty($item->reason)): ?>
                                                        <p><?= htmlspecialchars($item->reason) ?></p>
                                                    <?php else: ?>
                                                        <p>No reason provided</p>
                                                    <?php endif; ?>

                                                    <div class="notification-actions">
                                                        <form method="post" action="<?= ROOT ?>/PDC_admin/AdminNotificationOverview/updateAndRedirect">
                                                            <input type="hidden" name="type" value="<?= $type ?>">
                                                            <input type="hidden" name="id" value="<?= $targetId ?>">
                                                            <input type="hidden" name="notification_id" value="<?= $item->id ?>">
                                                            <button type="submit" class="action-btn view">
                                                                <i class="fas fa-eye" aria-hidden="true"></i> View
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php else: ?>
                                                    <p>Unknown notification type.</p>
                                                <?php endif; ?>
                                            </div>
                                        </article>

                                    <?php elseif($item->type == 'deactivation_request'): ?>
                                        <article class="notification-item <?= strtolower($item->status) ?>">
                                            <div class="notification-header">
                                                <h2 class="notification-title">
                                                    <i class="fas fa-power-off" aria-hidden="true"></i>
                                                    Deactivation Request
                                                </h2>
                                                <div class="notification-meta">
                                                    <span class="badge <?= strtolower($item->status) ?>-badge">
                                                        <?= htmlspecialchars($item->status) ?>
                                                    </span>
                                                    <time class="notification-date"><?= htmlspecialchars($item->created_at) ?></time>
                                                </div>
                                            </div>
                                            
                                            <div class="notification-body">
                                                <p>
                                                    <strong>Advertisement ID:</strong> <?= htmlspecialchars($item->advertisement_id) ?>
                                                </p>
                                                <p>
                                                    <strong>Company ID:</strong> <?= htmlspecialchars($item->company_id) ?>
                                                </p>
                                                <?php if (!empty($item->reason)): ?>
                                                    <p><strong>Reason:</strong> <?= htmlspecialchars($item->reason) ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="notification-actions">
                                                <form method="post" action="<?= ROOT ?>/PDC_admin/AdminNotificationOverview/updateAndRedirect">
                                                    <input type="hidden" name="type" value="advertisement">
                                                    <input type="hidden" name="id" value="<?= $item->advertisement_id ?>">
                                                    <input type="hidden" name="notification_id" value="<?= $item->id ?>">
                                                    <button type="submit" class="action-btn view">
                                                        <i class="fas fa-eye" aria-hidden="true"></i> View Advertisement
                                                    </button>
                                                </form>
                                            </div>
                                        </article>
                                    <?php endif; ?>
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
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    
                    button.classList.add('active');
                    
                    const tabId = button.getAttribute('data-tab');
                    const correspondingContent = document.querySelector(`.tab-content[data-tab="${tabId}"]`);
                    if (correspondingContent) {
                        correspondingContent.classList.add('active');
                    }
                });
            });

            if (tabButtons.length > 0) {
                tabButtons[0].click();
            }

            if (window.__flashMessage) {
                showToast(window.__flashMessage.message, window.__flashMessage.type);
            }
        });
    </script>
</body>
</html>