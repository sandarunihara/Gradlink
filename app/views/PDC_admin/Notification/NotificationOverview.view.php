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
                                    <?php if($item->type == 'advertisement_request'):?>
                                        <div class="notification-item">
                                            <div class="notification-header">
                                                <div class="notification-title">
                                                    <i class="fas fa-ad"></i>
                                                    Advertisement Request
                                                </div>
                                                <div class="notification-meta">
                                                    <span class="badge pending-badge">Pending</span>
                                                    <span class="notification-date"><?= htmlspecialchars($item->created_at) ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="notification-body">
                                                <p>
                                                    <strong><?= htmlspecialchars($item->Name) ?></strong> has requested to publish advertisement.
                                                </p>
                                            </div>
                                            
                                            <div class="notification-actions">
                                                <button class="action-btn approve" data-id="<?= $item->advertisement_id ?>" data-type="<?= $item->type ?>" onclick="acceptAdv(this)">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                                <button class="action-btn reject" data-id="<?= $item->id ?>" data-type="<?= $item->type ?>" onclick="rejectAdv(this)">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                                <button class="action-btn view" data-id="<?= $item->advertisement_id ?>" data-type="<?= $item->type ?>" onclick="viewAdv(this)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </div>
                                        </div>

                                    <?php elseif($item->type == 'coordinator_request'):?>
                                        <div class="notification-item">
                                            <div class="notification-header">
                                                <div class="notification-title">
                                                    <i class="fas fa-user-tie"></i>
                                                    Coordinator Request
                                                </div>
                                                <div class="notification-meta">
                                                    <span class="badge pending-badge">Pending</span>
                                                    <span class="notification-date"><?= htmlspecialchars($item->created_at) ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="notification-body">
                                                <p>
                                                    <?php if (!empty($item->student_id)): ?>
                                                        <strong>Student ID: <?= htmlspecialchars($item->student_id) ?></strong>
                                                    <?php elseif (!empty($item->company_id)): ?>
                                                        <strong>Company ID: <?= htmlspecialchars($item->company_id) ?></strong>.
                                                    <?php elseif (!empty($item->advertisement_id)): ?>
                                                        <strong>Advertisement ID: <?= htmlspecialchars($item->advertisement_id) ?></strong>.
                                                    <?php else: ?>
                                                        
                                                    <?php endif; ?>

                                                    <?php if(!empty($item->reason)): ?>
                                                        <p><?= $item->reason ?></p>
                                                    <?php else:?>
                                                        <p>No reason to show</p>
                                                    <?php endif;?>

                                                </p>
                                            </div>
                                            
                                            <div class="notification-actions">
                                                <button class="action-btn approve" data-id="<?= $item->id ?>" data-type="<?= $item->type ?>" onclick="acceptCoordinator(this)">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                                <button class="action-btn reject" data-id="<?= $item->id ?>" data-type="<?= $item->type ?>" onclick="rejectCoordinator(this)">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                                <button class="action-btn view" data-id="<?= $item->id ?>" data-type="<?= $item->type ?>" onclick="viewCoordinator(this)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </div>
                                        </div>

                                    <?php elseif($item->type == 'deactivation_request'):?>
                                        <div class="notification-item">
                                            <div class="notification-header">
                                                <div class="notification-title">
                                                    <i class="fas fa-power-off"></i>
                                                    Deactivation Request
                                                </div>
                                                <div class="notification-meta">
                                                    <span class="badge pending-badge">Pending</span>
                                                    <span class="notification-date"><?= htmlspecialchars($item->created_at) ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="notification-body">
                                                <p>
                                                    <strong><?= htmlspecialchars($item->Name) ?></strong> has requested account deactivation.
                                                </p>
                                            </div>
                                            
                                            <div class="notification-actions">
                                                <button class="action-btn approve" data-id="<?= $item->advertisement_id ?>" data-type="<?= $item->type ?>" onclick="approveDeactivation(this)">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                                <button class="action-btn reject" data-id="<?= $item->advertisement_id ?>" data-type="<?= $item->type ?>" onclick="rejectDeactivation(this)">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                                <button class="action-btn view" data-id="<?= $item->advertisement_id ?>" data-type="<?= $item->type ?>" onclick="viewDeactivation(this)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </div>
                                        </div>

                                    <?php elseif($item->type == 'signup_company'):?>
                                        <div class="notification-item">
                                            <div class="notification-header">
                                                <div class="notification-title">
                                                    <i class="fas fa-building"></i>
                                                    New Company Registration
                                                </div>
                                                <div class="notification-meta">
                                                    <span class="badge pending-badge">Pending</span>
                                                    <span class="notification-date"><?= htmlspecialchars($item->created_at) ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="notification-body">
                                                <p>
                                                    <strong><?= htmlspecialchars($item->Name) ?></strong> has registered as a new company.
                                                </p>
                                            </div>
                                            
                                            <div class="notification-actions">
                                                <button class="action-btn approve" onclick="openModal()">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                                <button class="action-btn reject" data-id="<?= $item->advertisement_id ?>" data-type="<?= $item->type ?>" onclick="rejectAdv(this)">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                                <button class="action-btn view" data-id="<?= $item->advertisement_id ?>" data-type="<?= $item->type ?>" onclick="viewAdv(this)">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
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

    <div id="accept-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="accept-form" method="post">
                <input type="hidden" name="advertisement_id" id="accept-advertisement-id" value="">
                <div class="modal-header">
                    <h3>Accept Advertisement</h3>
                </div>
                <div class="modal-body">
                
                    <div id="confirmationMessage" class="modal-message">
                        <i class="fas fa-info-circle"></i>
                        <span id="messageText">Are you sure you want to accept this advertisement?</span>
                    </div>

                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes, Accept</button>
                </div>
            </form>
        </div>
    </div>

    <div id="reject-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="reject-form" method="post" action="<?= ROOT ?>/PDC_admin/ViewAdvertisement/handleAction">
                <div class="modal-header">
                    <input type="hidden" name="advertisementId" id="reject-adv-id">
                    <input type="hidden" name="action" value="reject">
                    <h3>Reject Advertisement</h3>
                </div>
                <div class="modal-body">

                    <div class="modal-field">
                        <div class="form-group">
                            <label for="block-reason">Reason for Rejecting</label>
                            <textarea id="block-reason" name="reject_reason" placeholder="Enter your reason here..." required></textarea>
                            <p id="modal-message" style="color: red; margin-top: 10px;"></p>
                        </div>
                    </div>

                    <div id="confirmationMessage" class="modal-message">
                        <i class="fas fa-info-circle"></i>
                        <span id="messageText"> Please provide a reason for rejecting . This message will be sent to the company's email.</span>
                    </div>

                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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
        });

        function acceptAdv(btn){
            document.getElementById('accept-modal').classList.add("active");
            const advId = btn.getAttribute('data-id');
            const form = document.getElementById('accept-form');
            form.action = `<?= ROOT ?>/PDC_admin/ViewAdvertisement/activate/${advId}/Active`
        }

        function rejectAdv(btn){
            document.getElementById('reject-modal').classList.add('active');
            const advId = btn.getAttribute('data-id');
            document.getElementById('reject-adv-id').value = advId;
        }

        function viewAdv(btn){
            const advId = btn.getAttribute('data-id');
            window.location.href = `<?=ROOT?>/PDC_admin/ViewAdvertisement/show/${advId}`
        }

        function closeModal(){
            document.getElementById('accept-modal').classList.remove("active");
            document.getElementById('reject-modal').classList.remove('active');
        }

    </script>

    </body>

</html>