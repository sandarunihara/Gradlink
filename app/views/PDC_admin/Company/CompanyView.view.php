<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile | <?= htmlspecialchars($data['companyData']->Name) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --danger-color:rgb(206, 17, 17);
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
            --border-radius: 8px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Main Content Area */
        .content {
            margin-left: 80px; /* Same as sidebar width */
            flex: 1;
            padding: 40px 40px 40px 40px;
            background-color: #f0f0f5;
            min-height: 100vh;
            transition: margin-left 0.3s;
        }

        /* Company Header Section */
        .company-header {
            position: relative;
            margin-bottom: 2rem;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }

        .cover-image {
            height: 200px;
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .cover-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
        }

        .company-logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            bottom: -60px;
            left: 40px;
            z-index: 2;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 4px solid white;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }

        .company-logo .initials {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .company-title {
            padding: 80px 40px 30px;
            background: white;
        }

        .company-title h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .company-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .status-active {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success-color);
        }

        .status-blocked {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger-color);
        }

        /* Company Info Section */
        .company-info-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .info-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #eee;
        }

        .card-header i {
            font-size: 1.25rem;
            margin-right: 0.75rem;
            color: var(--primary-color);
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .info-item {
            margin-bottom: 1rem;
        }

        .info-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--gray-color);
            margin-bottom: 0.25rem;
            display: block;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 500;
            color: var(--dark-color);
            padding: 0.5rem 0;
            border-bottom: 1px dashed #e9ecef;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn i {
            font-size: 1rem;
        }

        .btn-back {
            background-color: #e9ecef;
            color: var(--dark-color);
        }

        .btn-back:hover {
            background-color: #dee2e6;
        }

        .btn-block {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-block:hover {
            background-color:rgb(120, 4, 4);
        }

        .btn-unblock {
            background-color: var(--success-color);
            color: white;
        }

        .btn-unblock:hover {
            background-color: #3ab8db;
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: white;
            border-radius: var(--border-radius);
            width: 500px;
            max-width: 95%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: translateY(-20px);
            transition: var(--transition);
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-color);
        }

        textarea {
            width: 100%;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: 'Poppins', sans-serif;
            resize: vertical;
            min-height: 120px;
            transition: var(--transition);
        }

        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-secondary {
            background-color: #e9ecef;
            color: var(--dark-color);
        }

        .btn-secondary:hover {
            background-color: #dee2e6;
        }

        .modal-actions {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        #unblock-modal .modal-content {
            background: white;
            border-radius: var(--border-radius);
            width: 500px;
            max-width: 95%;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: translateY(-20px);
            transition: var(--transition);
        }

        #unblock-modal .modal-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        #unblock-modal .modal-content p {
            font-size: 1rem;
            color: var(--dark-color);
            margin-bottom: 2rem;
        }

        .toast-message.show {
    opacity: 1;
    transform: translateY(0);
}

.toast-message::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
}

.toast-success {
    background-color: rgba(40, 167, 69, 0.95);
}

.toast-success::before {
    background-color: #2ecc71;
}

.toast-error {
    background-color: rgba(220, 53, 69, 0.95);
}

.toast-error::before {
    background-color: #e74c3c;
}

.toast-close-btn {
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.7);
    position: absolute;
    right: 8px;
    top: 8px;
    cursor: pointer;
    font-size: 14px;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
}

.toast-close-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.toast-content {
    padding-right: 20px;
    line-height: 1.5;
}

.toast-title {
    font-weight: 600;
    margin-bottom: 4px;
    font-size: 15px;
}

.toast-text {
    font-size: 14px;
    opacity: 0.9;
}

/* Progress bar animation */
.toast-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    background: rgba(255, 255, 255, 0.3);
}

.toast-progress-bar {
    height: 100%;
    background: white;
    animation: progress linear;
    transform-origin: left;
}

@keyframes progress {
    0% { transform: scaleX(1); }
    100% { transform: scaleX(0); }
}

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .company-info-container {
                grid-template-columns: 1fr;
            }
            
            .content {
                margin-left: 0;
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .company-logo {
                width: 100px;
                height: 100px;
                bottom: -50px;
            }
            
            .company-title {
                padding-top: 70px;
            }
        }

        .history-timeline {
    position: relative;
    padding-left: 30px;
    margin-top: 1rem;
}

.history-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 10px;
    width: 2px;
    background: #e9ecef;
}

.history-item {
    position: relative;
    padding-bottom: 1.5rem;
}

.history-item:last-child {
    padding-bottom: 0;
}

.history-marker {
    position: absolute;
    left: -30px;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

.history-item.blocked .history-marker {
    background-color: var(--danger-color);
    box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.2);
}

.history-item.unblocked .history-marker {
    background-color: var(--success-color);
    box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.2);
}

.history-marker::after {
    content: '';
    position: absolute;
    width: 10px;
    height: 10px;
    background: white;
    border-radius: 50%;
}

.history-content {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.history-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    align-items: center;
}

.history-action {
    font-weight: 600;
    font-size: 0.9rem;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
}

.history-item.blocked .history-action {
    background-color: rgba(220, 53, 69, 0.1);
    color: var(--danger-color);
}

.history-item.unblocked .history-action {
    background-color: rgba(40, 167, 69, 0.1);
    color: var(--success-color);
}

.history-date {
    font-size: 0.8rem;
    color: var(--gray-color);
}

.history-reason, .history-admin {
    font-size: 0.9rem;
    margin-top: 0.5rem;
    padding-left: 0.5rem;
    border-left: 2px solid #dee2e6;
}

.history-reason strong, .history-admin strong {
    color: var(--dark-color);
}

.no-history {
    text-align: center;
    padding: 2rem 0;
    color: var(--gray-color);
}

.no-history i {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: var(--success-color);
}

.no-history p {
    margin: 0;
}

.block-stats {
    font-size: 0.85rem;
    color: var(--danger-color);
    margin-top: 0.25rem;
}

.block-stats span {
    margin-right: 0.5rem;
}
    </style>
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
                <div class="cover-image" style="background-image: url('<?= ROOT ?>/<?= !empty($data['companyData']->coverimg) ? htmlspecialchars($data['companyData']->coverimg) : 'assets/images/default-cover.jpg' ?>')">
                    <div class="company-logo" style="background-image: url('<?= ROOT ?>/<?= !empty($data['companyData']->profileimg) ? htmlspecialchars($data['companyData']->profileimg) : 'assets/images/default-profile.png' ?>')">
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
                <button class="btn btn-back" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                <?php if ($data['companyData']->block === 1): ?>
                    <button class="btn btn-unblock" onclick="unblockCompany('<?= htmlspecialchars($data['companyData']->CompanyId) ?>')">
                        <i class="fas fa-lock-open"></i> Unblock
                    </button>
                <?php else: ?>
                    <button class="btn btn-block" onclick="blockCompany('<?= htmlspecialchars($data['companyData']->CompanyId) ?>')">
                        <i class="fas fa-ban"></i> Block
                    </button>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Block Company Modal with Form -->
    <div id="block-modal" class="modal">
        <div class="modal-content">
            <form id="block-form" method="post" action="<?= ROOT ?>/PDC_admin/ViewCompany/block">
                <input type="hidden" name="companyId" id="company-id" value="">
                <div class="modal-header">
                    <h3>Block Company</h3>
                </div>
                <div class="modal-body">
                    <p>Please provide a reason for blocking <?= htmlspecialchars($data['companyData']->Name) ?>. This message will be sent to the company's email.</p>
                    <div class="form-group">
                        <label for="block-reason">Reason for Blocking</label>
                        <textarea id="block-reason" name="block_reason" placeholder="Enter your reason here..." required></textarea>
                        <p id="modal-message" style="color: red; margin-top: 10px;"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Unblock Company Modal -->
    <div id="unblock-modal" class="modal">
        <div class="modal-content">
            <form id="unblock-form" method="post" action="<?= ROOT ?>/PDC_admin/BlockCompany/unblock">
                <input type="hidden" name="companyId" id="unblock-company-id" value="">
                <div class="modal-header">
                    <h3>Unblock Company</h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to unblock this company?</p>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes, Unblock</button>
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
            document.getElementById("block-reason").value = "";
            document.getElementById("modal-message").textContent = "";
        }

    </script>
</body>
</html>