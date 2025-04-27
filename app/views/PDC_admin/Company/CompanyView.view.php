<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile | <?= htmlspecialchars($data['companyData']->Name) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/viewCompany.css?time=<?= time() ?>">

</head>

<body>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Companies</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/overviewCompany.css?time=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
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
        <div class="sidebar">
            <?php $this->renderComponent("pdc_adminsidebar") ?>
        </div>
    
        <main class="content">
            <div class="company-header">
                    
                <div class="cover-image" style="background-image: url('<?= ROOT ?>/assets/img/Company/<?= htmlspecialchars($data['companyData']->coverimg) ?>')">                    
                    <div class="company-logo" style="background-image: url('<?= ROOT ?>/assets/img/Company/<?= htmlspecialchars($data['companyData']->profileimg) ?>')">

                        <?php if (empty($data['companyData']->profileimg)): ?>
                            <div class="initials"><?= substr(htmlspecialchars($data['companyData']->Name), 0, 1) ?></div>
                        <?php endif; ?>
                        
                    </div>
                </div>
                <div class="company-title">

                    <h1><?= htmlspecialchars($data['companyData']->Name) ?></h1>
                    <span class="company-status <?= $data['companyData']->Status === 'Blocked' ? 'status-blocked' : 'status-active' ?>">
                        <i class="fas fa-<?= $data['companyData']->Status === 'Blocked' ? 'ban' : 'check-circle' ?>"></i>
                        <?= htmlspecialchars($data['companyData']->Status) ?>
                    </span>

                    <?php if ($data['companyData']->block_count > 0): ?>
                    <div class="block-stats">
                        <span>Blocked <?= htmlspecialchars($data['companyData']->block_count) ?> time(s)</span>
                        
                        <?php if (!empty($data['companyData']->last_blocked_at)): ?>
                        <span>• Last on <?= date('M j, Y', strtotime($data['companyData']->last_blocked_at)) ?></span>
                        <?php endif; ?>
                    
                    </div>
                    <?php endif; ?>

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
                            <div class="info-value"><?= htmlspecialchars($data['companyData']->CompanyId) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Contact Person</span>
                            <div class="info-value"><?= htmlspecialchars($data['companyData']->ContactPerson) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <div class="info-value"><?= htmlspecialchars($data['companyData']->Email) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone</span>
                            <div class="info-value"><?= htmlspecialchars($data['companyData']->ContactNum) ?></div>
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
                            <div class="info-value"><?= htmlspecialchars($data['companyData']->No) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Street Lane</span>
                            <div class="info-value"><?= htmlspecialchars($data['companyData']->Lane) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">City</span>
                            <div class="info-value"><?= htmlspecialchars($data['companyData']->City) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">District</span>
                            <div class="info-value"><?= htmlspecialchars($data['companyData']->District) ?></div>
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
                        <div class="info-value" style="border-bottom: none; padding-bottom: 0;"><?= htmlspecialchars($data['companyData']->ShortDesc) ?></div>
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
                                <?php if (!empty($data['companyData']->Website)): ?>
                                    <a href="<?= htmlspecialchars($data['companyData']->Website) ?>" target="_blank">Visit Website</a>
                                <?php else: ?>
                                    Not provided
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">LinkedIn</span>
                            <div class="info-value">
                                <?php if (!empty($data['companyData']->Linkedin)): ?>
                                    <a href="<?= htmlspecialchars($data['companyData']->Linkedin) ?>" target="_blank">View Profile</a>
                                <?php else: ?>
                                    Not provided
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="card-header">
                    <i class="fas fa-history"></i>
                    <h2>Block History</h2>
                </div>
                <?php if (!empty($data['actionDet'])): ?>
                    <div class="history-timeline">
                        <?php foreach ($data['actionDet'] as $record): ?>
                            <div class="history-item <?= $record->action_type?>">
                                <div class="history-marker">
                                    <?php if ($record->action_type === 'blocked'): ?>
                                        <i class="fas fa-ban"></i>
                                    <?php else: ?>
                                        <i class="fas fa-check-circle"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="history-content">
                                    <div class="history-header">
                                        <div class="history-action-container">
                                            <span class="history-action"><?= htmlspecialchars(ucfirst($record->action_type)) ?></span>
                                            <?php if (!empty($record->actor_role)): ?>
                                                <span class="history-role">• <?= htmlspecialchars($record->actor_role) ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="history-date"><?= date('M j, Y \a\t g:i A', strtotime($record->timestamp)) ?></span>
                                    </div>
                                    <?php if (!empty($record->reason)): ?>
                                        <div class="history-reason">
                                            <span class="reason-label">Note:</span>
                                            <span class="reason-text"><?= htmlspecialchars($record->reason) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-history">
                        <i class="fas fa-check-circle"></i>
                        <p>No block history recorded</p>
                        <small class="no-history-sub">This user has never been blocked</small>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn btn-outline" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>

                <?php if($data['companyData']->Status != 'Pending' ):?>
                  <?php if ($data['companyData']->block === 1): ?>
                      <button class="btn btn-success" onclick="unblockCompany('<?= htmlspecialchars($data['companyData']->CompanyId) ?>')">
                          <i class="fas fa-lock-open"></i> Unblock
                      </button>
                  <?php else: ?>
                      <button class="btn btn-danger" onclick="blockCompany('<?= htmlspecialchars($data['companyData']->CompanyId) ?>')">
                          <i class="fas fa-ban"></i> Block
                      </button>
                  <?php endif; ?>
                <?php else: ?>
                      <button class="btn btn-primary" onclick="navigateToAcceptCompany()">
                          <i class="fas fa-check"></i> Accept
                      </button>

                      <button class="btn btn-danger" onclick="rejectCompany('<?= htmlspecialchars($data['companyData']->CompanyId) ?>')">
                          <i class="fas fa-times"></i>
                        Reject
                      </button>      
                <?php endif; ?>
                
            </div>
        </main>
    </div>

    <!-- Block Company Modal with Form -->
    <div id="block-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="block-form" method="post" action="<?= ROOT ?>/PDC_admin/ViewCompany/block">
                <input type="hidden" name="companyId" id="company-id" value="">
                <div class="modal-header">
                    <h3>Block Company</h3>
                </div>
                <div class="modal-body">

                    <div class="modal-field">
                        <div class="form-group">
                            <label for="block-reason">Reason for Blocking</label>
                            <textarea id="block-reason" name="block_reason" placeholder="Enter your reason here..." required></textarea>
                            <p id="modal-message" style="color: red; margin-top: 10px;"></p>
                        </div>
                    </div>

                    <div id="confirmationMessage" class="modal-message">
                        <i class="fas fa-info-circle"></i>
                        <span id="messageText"> Please provide a reason for blocking <?= htmlspecialchars($data['companyData']->Name) ?>. This message will be sent to the company's email.</span>
                    </div>

                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Unblock Company Modal -->
    <div id="unblock-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="unblock-form" method="post" action="<?= ROOT ?>/PDC_admin/BlockCompany/unblock">
                <input type="hidden" name="companyId" id="unblock-company-id" value="">
                <div class="modal-header">
                    <h3>Unblock Company</h3>
                </div>
                <div class="modal-body">
                
                    <div id="confirmationMessage" class="modal-message">
                        <i class="fas fa-info-circle"></i>
                        <span id="messageText">Are you sure you want to unblock this company?</span>
                    </div>

                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes, Unblock</button>
                </div>
            </form>
        </div>
    </div>

    <div id="accept-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="accept-form" method="post" action="<?= ROOT ?>/PDC_admin/ViewCompany/accept/<?= $data['companyData']->CompanyId?>">
                <input type="hidden" name="companyId" id="unblock-company-id" value="">
                <div class="modal-header">
                    <h3>Accept Company</h3>
                </div>
                <div class="modal-body">
                
                    <div id="confirmationMessage" class="modal-message">
                        <i class="fas fa-info-circle"></i>
                        <span id="messageText">Are you sure you want to accept this company?</span>
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
            <form id="reject-form" method="post" action="<?= ROOT ?>/PDC_admin/ViewCompany/reject">
                <input type="hidden" name="companyId" id="pending-company-id" value="">
                <div class="modal-header">
                    <h3>Reject Company</h3>
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
                        <span id="messageText"> Please provide a reason for rejecting <?= htmlspecialchars($data['companyData']->Name) ?>. This message will be sent to the company's email.</span>
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
        function blockCompany(companyId) {
            document.getElementById("company-id").value = companyId;
            document.getElementById("block-modal").classList.add("active");
        }

        function unblockCompany(companyId) {
            document.getElementById("unblock-company-id").value = companyId;
            document.getElementById("unblock-modal").classList.add("active");
        }

        function closeModal() {
            document.getElementById("block-modal").classList.remove("active");
            document.getElementById("unblock-modal").classList.remove("active");
            document.getElementById('accept-modal').classList.remove("active");
            document.getElementById('reject-modal').classList.remove("active");
            document.getElementById("block-reason").value = "";
            document.getElementById("modal-message").textContent = "";
            document.getElementById("accept-modal").textContent = "";
            document.getElementById("reject-modal").value = "";
        }

        function navigateToAcceptCompany(){
            document.getElementById('accept-modal').classList.add('active');

        //   console.log("Accepting company with ID: " + companyId);
        //   window.location.href = "/Gradlink/public/PDC_admin/ViewCompany/accept/" + companyId;
        }

        function rejectCompany(companyId){
            console.log(companyId);
            document.getElementById('pending-company-id').value = companyId;
            console.log(document.getElementById('pending-company-id').value);
            document.getElementById('reject-modal').classList.add('active');
        }

    </script>
</body>
</html>