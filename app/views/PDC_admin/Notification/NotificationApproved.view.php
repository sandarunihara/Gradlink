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
                            
                        </div>

                        <div class="notification-item pending">
                            <div class="notification-header">
                                
                                <div class="notification-type">
                                    <i class="fas fa-building"></i>
                                    <span>Company Signup</span>
                                </div>
                                <div class="notification-meta">
                                    <span class="notification-status badge pending">Pending</span>
                                    <span class="notification-date">Today, 10:30 AM</span>
                                </div>
                            </div>
                            <div class="notification-body">
                                <p>New company <strong>Tech Solutions Ltd</strong> has requested registration.</p>
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn approve"><i class="fas fa-check"></i> Approve</button>
                                <button class="action-btn reject"><i class="fas fa-times"></i> Reject</button>
                                <button class="action-btn view"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>

                        <div class="notification-item approved">
                            <div class="notification-header">
                                <div class="notification-type">
                                    <i class="fas fa-bullhorn"></i>
                                    <span>Advertisement</span>
                                </div>
                                <div class="notification-meta">
                                    <span class="notification-status badge approved">Approved</span>
                                    <span class="notification-date">Yesterday, 2:15 PM</span>
                                </div>
                            </div>
                            <div class="notification-body">
                                <p>Advertisement <strong>"Summer Internship Program"</strong> from <strong>Global Corp</strong> was approved.</p>
                            </div>
                        </div>

                        <div class="notification-item rejected">
                            <div class="notification-header">
                                <div class="notification-type">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Coordinator Request</span>
                                </div>
                                <div class="notification-meta">
                                    <span class="notification-status badge rejected">Rejected</span>
                                    <span class="notification-date">Mar 12, 2024</span>
                                </div>
                            </div>
                            <div class="notification-body">
                                <p>Coordinator access request from <strong>john.doe@email.com</strong> was rejected.</p>
                            </div>
                        </div>

                    </section>

                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
    <script>
        
    </script>

    </body>

</html>