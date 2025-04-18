<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Details | PDC Admin</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <style>
        :root {
            --primary: #1e40af;
            --primary-light:rgb(53, 112, 180);
            --primary-dark: rgb(3, 19, 45);
            --secondary: #6b7280;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f9fafb;
            --dark: #1f2937;
            --gray: #9ca3af;
            --border-radius: 8px;
            --border-radius-sm: 4px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            line-height: 1.5;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 1.5rem 2rem;
            margin-left: 5%;  /* Sidebar is 5% of width */
            width: 95%;       /* Content is 95% of width */
            padding-left: 5%; /* Add padding for content */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .header-left h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header-left h1 i {
            color: var(--primary);
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }

        .tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 0.5rem;
        }

        .tab-btn {
            padding: 0.5rem 1rem;
            background: transparent;
            border: none;
            border-radius: var(--border-radius-sm);
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--secondary);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tab-btn i {
            font-size: 0.9rem;
        }

        .tab-btn:hover {
            color: var(--primary);
            background-color: #e0e7ff;
        }

        .tab-btn.active {
            color: var(--primary);
            background-color: #e0e7ff;
            font-weight: 600;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9fafb;
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-header h2 i {
            color: var(--primary);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .status-badge i {
            font-size: 0.5rem;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            background-color: #f9fafb;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .avatar {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
        }

        .detail-item {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .detail-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
        }

        .detail-value {
            font-size: 0.95rem;
            color: #111827;
            word-break: break-word;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius-sm);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid transparent;
        }

        .btn i {
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary-dark);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline:hover {
            background-color: #e0e7ff;
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: white;
            border-color: #4b5563;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .btn-link {
            background: transparent;
            color: var(--primary);
            text-decoration: none;
            padding: 0;
            border: none;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .tag {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .empty-state {
            padding: 3rem 1.5rem;
            text-align: center;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #d1d5db;
        }

        .empty-state h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #4b5563;
        }

        .empty-state p {
            font-size: 0.95rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .breadcrumb {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .separator {
            color: var(--gray);
        }

        .meta-container {
            display: flex;
            gap: 1.5rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--gray);
        }

        .meta-item i {
            color: var(--primary);
        }

        /* Grid layout for session details */
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 992px) {
            .details-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Company card styles */
        .company-card {
            border: 1px solid #e5e7eb;
            border-radius: var(--border-radius-sm);
            overflow: hidden;
        }

        .company-header {
            padding: 1rem;
            background-color: #f0f9ff;
            border-bottom: 1px solid #e5e7eb;
        }

        .company-header h4 {
            margin: 0;
            color: #111827;
            font-size: 1.1rem;
        }

        .company-id {
            font-size: 0.75rem;
            color: var(--gray);
            margin-top: 0.25rem;
        }

        .company-details {
            padding: 1rem;
        }

        .company-links {
            padding: 0.75rem 1rem;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 0.75rem;
        }
        .status-expired {
            color: #dc2626;
            background-color: #fee2e2;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: 500;
        }

        .status-active {
            color: #16a34a;
            background-color: #dcfce7;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: 500;
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
            border-color: var(--danger);
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 1000;
    animation: fadeIn 0.3s ease-out;
}

.modal.active {
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: white;
    border-radius: var(--border-radius);
    width: 100%;
    max-width: 500px;
    margin: 1rem;
    box-shadow: var(--shadow-lg);
    transform: translateY(-20px);
    opacity: 0;
    animation: slideIn 0.3s ease-out forwards;
    overflow: hidden;
}

.modal-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #ef4444, #dc2626);
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.modal-header h3 {
    margin: 0;
    color: var(--danger);
    font-size: 1.25rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modal-header h3::before {
    content: '!';
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    background-color: var(--danger);
    color: white;
    border-radius: 50%;
    font-weight: bold;
}

.modal-body {
    padding: 1.5rem;
}

.modal-body p {
    margin-bottom: 1rem;
    color: var(--dark);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--dark);
}

#delete-reason {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: var(--border-radius-sm);
    font-family: inherit;
    min-height: 120px;
    resize: vertical;
    transition: border-color 0.2s;
}

#delete-reason:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
}

.modal-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
}

#modal-message {
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { 
        transform: translateY(-20px);
        opacity: 0;
    }
    to { 
        transform: translateY(0);
        opacity: 1;
    }
}


.toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast-message {
            padding: 15px 20px;
            margin-bottom: 10px;
            border-radius: 4px;
            color: white;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s ease;
            position: relative;
        }

        .toast-success {
            background-color: #28a745;
        }

        .toast-error {
            background-color: #dc3545;
        }

        .toast-info {
            background-color: #17a2b8;
        }

        .toast-close-btn {
            background: transparent;
            border: none;
            color: white;
            position: absolute;
            right: 5px;
            top: 5px;
            cursor: pointer;
            font-size: 16px;
        }

              /* Update Modal Styles */
.update-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 1000;
    animation: fadeIn 0.3s ease-out;
}

.update-modal.active {
    display: flex;
    justify-content: center;
    align-items: center;
}

.update-modal-content {
    background-color: white;
    border-radius: var(--border-radius);
    width: 100%;
    max-width: 600px;
    margin: 1rem;
    box-shadow: var(--shadow-lg);
    transform: translateY(-20px);
    opacity: 0;
    animation: slideIn 0.3s ease-out forwards;
    overflow: hidden;
    border-top: 4px solid var(--primary);
}

.update-modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    background-color: #f8fafc;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.update-modal-header h3 {
    margin: 0;
    color: var(--primary);
    font-size: 1.25rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.update-modal-header h3 i {
    color: var(--primary);
}

.update-modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--gray);
    transition: color 0.2s;
    padding: 0.25rem;
    border-radius: 4px;
}

.update-modal-close:hover {
    color: var(--danger);
    background-color: #f3f4f6;
}

.update-modal-body {
    padding: 1.5rem;
}

.update-modal-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #e5e7eb;
    background-color: #f9fafb;
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
}

/* Form Styles */
#sessionUpdateForm {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--dark);
}

#sessionUpdateForm input[type="text"],
#sessionUpdateForm input[type="date"],
#sessionUpdateForm select,
#sessionUpdateForm textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: var(--border-radius-sm);
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    transition: all 0.2s;
}

#sessionUpdateForm input[type="text"]:focus,
#sessionUpdateForm input[type="date"]:focus,
#sessionUpdateForm select:focus,
#sessionUpdateForm textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
}

#sessionUpdateForm textarea {
    min-height: 100px;
    resize: vertical;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

@media (max-width: 600px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { 
        transform: translateY(-20px);
        opacity: 0;
    }
    to { 
        transform: translateY(0);
        opacity: 1;
    }
}


    </style>
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
        <?php $this->renderComponent("pdc_adminsidebar") ?>

        <main class="content">
            <header class="header">
                <div class="header-left">
                    <h1><i class="fas fa-calendar-alt"></i> Session Details</h1>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-outline" id="edit-toggle-btn">
                        <i class="fas fa-edit"></i> Edit Session
                    </button>
                    <button class="btn btn-danger" id="delete-btn">
                        <i class="fas fa-trash-alt"></i> Delete Session
                    </button>
                </div>
            </header>

            <div class="meta-container">
                <div class="meta-item">
                    <i class="fas fa-id-badge"></i>
                    <span>Session ID: <?= htmlspecialchars($session->session_id) ?></span>
                </div>
                <div class="meta-item">
                    <span class="validity" id="check-date"></span>
                </div>
            </div>

            <div class="tabs">
                <button class="tab-btn active" data-tab="sessionInfo">
                    <i class="fas fa-info-circle"></i> Session Information
                </button>
                <button class="tab-btn" data-tab="companyInfo">
                    <i class="fas fa-building"></i> Company Details
                </button>
            </div>

            <div class="tab-content active" id="sessionInfo">
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-info-circle"></i> Session Overview</h2>
                    </div>

                    <div class="card-body">
                        <div class="detail-item" style="grid-column: 1 / -1;">
                            <div class="detail-label">Description</div>
                            <div class="detail-value"><?= htmlspecialchars($session->description) ?></div>
                        </div>

                        <div class="details-grid">
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Date</div>
                                    <div class="detail-value"><?= date('F j, Y', strtotime($session->session_date)) ?></div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Time Slot</div>
                                    <div class="detail-value"><?= htmlspecialchars($session->time_slot) ?></div>
                                </div>
                            </div>
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Venue</div>
                                    <div class="detail-value">
                                        <?= htmlspecialchars($session->hall_number) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary" onclick="history.back()">
                            <i class="fas fa-arrow-left"></i> Back to Sessions
                        </button>
                        <button type="button" class="btn btn-primary" id="save-btn" style="display: none;">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="companyInfo">
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-building"></i> Company Information</h2>
                    </div>

                    <div style="display: flex; gap: 1.5rem; margin: 1.5rem;">
                        <div class="avatar" style="background: linear-gradient(135deg, #d1fae5 0%, #6ee7b7 100%); color: #065f46;">
                            <?= substr(htmlspecialchars($session->other_company_name), 0, 1) ?>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #065f46;">
                                <?= htmlspecialchars($session->other_company_name) ?>
                            </h3>
                            <p style="color: var(--gray); font-size: 0.9rem;">
                                ID: NONE
                            </p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="details-grid">
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Contact Person</div>
                                    <div class="detail-value"><?= htmlspecialchars($session->contact_person) ?></div>
                                </div>
                            </div>
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Contact Information</div>
                                    <div class="detail-value">
                                        <i class="fas fa-phone"></i> <?= htmlspecialchars($session->contact_number) ?><br>
                                        <i class="fas fa-envelope"></i> <?= htmlspecialchars($session->email) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="delete-modal" class="modal">
        <div class="modal-content">
            <form id="delete-form" method="post" action="<?= ROOT ?>/PDC_admin/ViewSession/removeUnregistered">
                <input type="hidden" name="session_id" id="session-id" value="">
                <input type="hidden" name="email" id="email" value="<?= htmlspecialchars($session->email) ?>">
                <div class="modal-header">
                    <h3>Delete Session</h3>
                </div>
                <div class="modal-body">
                    <p>Please provide a reason for deletion. This message will be sent to the company's email.</p>
                    <div class="form-group">
                        <label for="block-reason">Reason for Deletion</label>
                        <textarea id="delete-reason" name="delete_reason" placeholder="Enter your reason here..." required></textarea>
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

    <div id="update-modal" class="update-modal">
        <div class="update-modal-content">
            <div class="update-modal-header">
                <h3><i class="fas fa-edit"></i> Update Session Details</h3>
                <button class="update-modal-close" onclick="closeUpdateModal()">&times;</button>
            </div>
            <div class="update-modal-body">
                <form id="sessionUpdateForm" method="post" action="<?= ROOT ?>/PDC_admin/ViewSession/editUnreg/<?= htmlspecialchars($session->session_id) ?>">
                    
                    <div class="form-group">
                        <label for="session-name" class="form-label">Session Name</label>
                        <input type="text" id="session-name" name="session_name" placeholder="Session Name" 
                            value="<?= htmlspecialchars($session->session_name) ?>" 
                        required>
                    </div>

                    <div class="form-group" style="display: none;">
                        <input type="text" name="session_id" id="session-id" 
                            value="<?= htmlspecialchars($session->session_id) ?>"
                        >
                    </div>

                    <div class="form-group" style="display: none;">
                        <input type="text" name="email" id="company-email" 
                            value="<?= htmlspecialchars($session->email) ?>"
                        >
                    </div>

                    <div class="form-group" style="display: none;">
                        <input type="text" name="contact_number" id="contact-number" 
                            value="<?= htmlspecialchars($session->contact_number) ?>"
                        >
                    </div>

                    
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Session Description</label>
                        <textarea id="description" name="description" class="form-control form-textarea"><?= !empty($session->description) ? htmlspecialchars($session->description) : '' ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="session-date" class="form-label">Session Date</label>
                            <input type="date"
                                id="session-date" 
                                name="session_date" 
                                placeholder="Session Date"
                                min="<?= date('Y-m-d') ?>" 
                                required>
                        </div>

                        <div class="form-group">
                            <label for="time" class="form-label">Time Slot</label>
                            <select id="time-slot" name="time_slot" 
                                value="<?= htmlspecialchars($session->time_slot) ?>"
                                required>
                            </select>
                        </div>

                    </div>
                    
                    <div class="form-row">

                        <div class="form-group">
                            <label for="hall-number" class="form-label">Hall Name</label>
                            <select id="hall-number" name="hall_number" 
                                value="<?= htmlspecialchars($session->hall_number) ?>"
                                required>
                            </select>
                        </div>

                    </div>
                    
                    <div class="update-modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeUpdateModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/toast.js"></script>


    <script>

        function closeModal(){
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('active');
            document.getElementById('delete-reason').value = '';
            document.getElementById('modal-message').innerText = '';
        }

        function closeUpdateModal() {
            const modal = document.getElementById('update-modal');
            modal.classList.remove('active');
        }

        const deletebtn = document.getElementById('delete-btn');
        const updateBtn = document.getElementById('edit-toggle-btn');
            
        deletebtn.addEventListener('click', function() {
            const sessionId = <?= json_encode($session->session_id) ?>;
            document.getElementById('session-id').value = sessionId;
            document.getElementById('delete-modal').classList.add('active');
        });

        updateBtn.addEventListener('click', function() {
            document.getElementById('update-modal').classList.add('active');
        });


        document.addEventListener('DOMContentLoaded', function() {

            // Tab functionality
            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Remove active class from all buttons and content
                    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked button and corresponding content
                    btn.classList.add('active');
                    const tabId = btn.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });

            const hallname = document.getElementById('hall-number');
            const timeslot = document.getElementById('time-slot');
            const date = document.getElementById('session-date');

            const allTimeSlots = [
                            "9:00 AM - 11:00 AM",
                            "11:00 AM - 1:00 PM",
                            "1:00 PM - 3:00 PM",
                            "3:00 PM - 5:00 PM"
                        ];

            const allHalls = ["W001", "S104", "S202" ,"W004"];

            date.addEventListener("change", function (){
                const selectedDate = this.value;
                //console.log("Selected date:", selectedDate);
                fetch(`<?= ROOT ?>/PDC_admin/AddSession/GetAvailability?type=date&value=${selectedDate}`)
                    .then(response => response.json())
                    .then(data => {
                        //console.log("Fetched data:", data);

                        const  slotHalls = {};

                        data.forEach(item => {
                            if(!slotHalls[item.time_slot]){
                                slotHalls[item.time_slot] = new Set();
                            }
                            slotHalls[item.time_slot].add(item.hall_number)
                        })

                        console.log(slotHalls);

                        const mapped = Object.entries(slotHalls).map(([timeslot , setHalls])=> {
                            return{
                                timeslot,
                                count: setHalls.size
                            }
                        }
                        )

                        console.log(mapped);

                        const unavailableTimeSlots = mapped.filter(({ count }) => 
                            count === allHalls.length
                        ).map(({ timeslot }) => timeslot);
                        
                        console.log(unavailableTimeSlots);


                        const availableTimeSlots = allTimeSlots.filter(slot => !unavailableTimeSlots.includes(slot));

                        console.log(availableTimeSlots);

                        const timeSlotSelect = document.getElementById("time-slot");



                        //const unavailableTimeSlots = data.map(item => (item.time_slot));
                        //const availableTimeSlots = allTimeSlots.filter(slot => !unavailableTimeSlots.includes(slot));
                        //console.log(availableTimeSlots);


                        timeSlotSelect.innerHTML = '<option value="" >Select Time Slot</option>';
                        availableTimeSlots.forEach(slot => {
                            const option = document.createElement("option");
                            option.value = slot;
                            option.textContent = slot;
                            timeSlotSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching availability:", error);
                    });
            })

            timeslot.addEventListener("change", function () {
                const selectedDate = date.value;
                const selectedSlot = this.value;

                if (!selectedDate || !selectedSlot) return;

                fetch(`<?= ROOT ?>/PDC_admin/AddSession/GetAvailability?type=date&value=${selectedDate}`)
                    .then(response => response.json())
                    .then(data => {
                        const hallSelect = document.getElementById("hall-number");

                        hallSelect.innerHTML = '<option value="">Select Hall</option>';

                        const unavailableHalls = data.filter(item => item.time_slot === selectedSlot).map(item => item.hall_number);
                        const availableHalls = allHalls.filter(hall => !unavailableHalls.includes(hall));

                        console.log(availableHalls);

                        availableHalls.forEach(hall => {
                            const option = document.createElement("option");
                            option.value = hall;
                            option.textContent = hall;
                            hallSelect.appendChild(option);
                        });

                    })
                    .catch(error => {
                        console.error("Error filtering halls based on time slot:", error);
                    });
            });

            
        });
    </script>
</body>
</html>