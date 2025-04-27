<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notifications</title>
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
                        </div>

                        <div class="notification-container">
                            <?php if (!empty($data)): ?>
                                <?php foreach ($data as $item): ?>
                                    <?php if($item->type == 'coordinator_request'):?>                                        
                                        <div class="notification-item <?= strtolower($item->status) ?>">
                                            <div class="notification-header">
                                                <div class="notification-title">
                                                    <i class="fas fa-user-tie"></i>
                                                    Coordinator Request
                                                </div>
                                                <div class="notification-meta">
                                                    <span class="badge <?= strtolower($item->status) ?>-badge"><?= htmlspecialchars($item->status) ?></span>
                                                    <span class="notification-date"><?= htmlspecialchars($item->created_at) ?></span>
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
                                                    <p>
                                                        <strong><?= ucfirst($type) ?> ID: <?= htmlspecialchars($targetId) ?></strong></p>

                                                        <?php if (!empty($item->reason)): ?>
                                                            <p><?= htmlspecialchars($item->reason) ?></p>
                                                        <?php else: ?>
                                                            <p>No reason to show</p>
                                                        <?php endif; ?>

                                                <?php else: ?>
                                                    <p>Unknown notification type.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    <?php elseif($item->type == 'deactivation_request'):?>
                                        <div class="notification-item <?= strtolower($item->status) ?>">
                                            <div class="notification-header">
                                                <div class="notification-title">
                                                    <i class="fas fa-power-off"></i>
                                                    Deactivation Request
                                                </div>
                                                <div class="notification-meta">
                                                    <span class="badge <?= strtolower($item->status) ?>-badge"><?= htmlspecialchars($item->status) ?></span>
                                                    <span class="notification-date"><?= htmlspecialchars($item->created_at) ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="notification-body">
                                                <p>
                                                    <strong><?= htmlspecialchars($item->Name) ?></strong> has requested account deactivation.
                                                </p>
                                                
                                            </div>
                                        </div>
                                    <?php endif;?>
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

            if (tabButtons.length > 0) {
                tabButtons[0].click();
            }

            // Handle flash messages
            if (window.__flashMessage) {
                showToast(window.__flashMessage.message, window.__flashMessage.type);
            }
        });

        function approveDeactivation(button) {
            const id = button.getAttribute('data-id');
            const type = button.getAttribute('data-type');
            // Implement approval logic here
            console.log(`Approving ${type} with ID: ${id}`);
        }

        function rejectDeactivation(button) {
            const id = button.getAttribute('data-id');
            const type = button.getAttribute('data-type');
            // Implement rejection logic here
            console.log(`Rejecting ${type} with ID: ${id}`);
        }

        function viewDeactivation(button) {
            const id = button.getAttribute('data-id');
            const type = button.getAttribute('data-type');
            // Implement view details logic here
            console.log(`Viewing ${type} with ID: ${id}`);
        }
    </script>

</body>
</html>