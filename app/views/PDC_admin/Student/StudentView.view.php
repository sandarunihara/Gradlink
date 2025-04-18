<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --success: #4cc9f0;
            --warning: #ffc107;
            --danger: #dc3545;
            --border-radius: 8px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
            --success-color: #4cc9f0;
            --light-gray: #e9ecef;
            --primary-dark: #3a0ca3;



        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f5;
            color: var(--dark);
            height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .content {
            margin-left: 80px; /* Same as sidebar width */
            flex: 1;
            padding: 40px 40px 40px 40px;
            background-color: #f0f0f5;
            min-height: 100vh;
            transition: margin-left 0.3s;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: var(--shadow);
        }

        .profile-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .profile-title .status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-active {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }

        .status-blocked {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: #d39e00;
        }

        .student-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .detail-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
        }

        .detail-card h3 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            color: var(--dark);
            border-bottom: 1px solid #eee;
            padding-bottom: 0.5rem;
        }

        .detail-card i {
            font-size: 1.25rem;
            margin-right: 0.75rem;
            color: var(--primary);
        }

        .detail-item {
            margin-bottom: 1rem;
        }

        .detail-label {
            font-size: 0.85rem;
            color: var(--gray);
            display: block;
            margin-bottom: 0.25rem;
        }

        .detail-value {
            font-weight: 500;
            padding: 0.5rem 0;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }

        .social-link:hover {
            color: var(--secondary);
        }

        .applications-section {
            margin-top: 2rem;
        }

        .section-title {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .applications-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .application-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .application-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .application-header {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .company-logo {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 1rem;
        }

        .company-info {
            flex: 1;
        }

        .company-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .application-status {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .application-body {
            padding: 1rem;
        }

        .application-detail {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .application-detail strong {
            color: var(--gray);
            margin-right: 0.5rem;
        }

        .no-applications {
            text-align: center;
            padding: 2rem;
            color: var(--gray);
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }


        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(-20px);
            transition: all 0.3s ease;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            color: var(--primary);
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--danger);
        }

        .close {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 1.5rem;
            color: var(--gray);
            cursor: pointer;
            transition: var(--transition);
        }

        .close:hover {
            color: var(--danger);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: flex;
            gap: 1rem;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .btn-cancel {
            background-color: white;
            color: var(--gray);
            border: 1px solid var(--light-gray);
        }

        .btn-cancel:hover {
            background-color: var(--light-gray);
        }

        .btn-save {
            background-color: var(--success);
            color: white;
        }

        .btn-save:hover {
            background-color: #218838;
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

        .form-hint {
            display: block;
            font-size: 12px;
            color: #6b7280;
            margin-top: 5px;
        }

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
            color: var(--dark);
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
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-secondary {
            background-color: white;
            color: var(--gray);
            border: 1px solid var(--light-gray);
        }

        .btn-secondary:hover {
            background-color: var(--light-gray);
        }

        .modal-actions {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .modal-message {
            padding: 0.75rem;
            border-radius: var(--border-radius);
            background-color: rgba(72, 149, 239, 0.1);
            color: var(--primary);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
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
            color: var(--dark);
            margin-bottom: 1rem;
        }

        #unblock-modal .modal-content p {
            font-size: 1rem;
            color: var(--dark);
            margin-bottom: 2rem;
        }

        @media (max-width: 992px) {
            .student-details {
                grid-template-columns: 1fr;
            }
            
            .content {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        .block-stats {
            font-size: 0.85rem;
            color: var(--danger);
            margin-top: 0.25rem;
        }

        .block-stats span {
            margin-right: 0.5rem;
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
    background-color: var(--danger);
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
    color: var(--dark);
}

.history-item.blocked .history-action {
    background-color: rgba(220, 53, 69, 0.1);
    color: var(--danger);
}

.history-item.unblocked .history-action {
    background-color: rgba(40, 167, 69, 0.1);
    color: var(--success-color);
}

.history-date {
    font-size: 0.8rem;
    color: var(--gray);
}

.history-reason, .history-admin {
    font-size: 0.9rem;
    margin-top: 0.5rem;
    padding-left: 0.5rem;
    border-left: 2px solid #dee2e6;
}

.history-reason strong, .history-admin strong {
    color: var(--danger);
}

.no-history {
    text-align: center;
    padding: 2rem 0;
    color: var(--gray);
}

.no-history i {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: var(--success-color);
}

.no-history p {
    margin: 0;
}

.info-card {
            margin-top: 2rem;
            margin-bottom: 2rem;
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
            color: var(--primary);
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
        }

        .modal-field {
            margin-bottom: 1.5rem;
        }

        .modal-field label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .modal-field textarea {
            width: 100%;
            min-height: 120px;
            padding: 0.75rem;
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius);
            resize: vertical;
            font-family: inherit;
            transition: var(--transition);
        }

        .modal-field textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-success:hover {
            background-color: #3aa8d1;
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color:rgb(196, 44, 59);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(67, 97, 238, 0.1);
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
        <div class="sidebar">
            <?php $this->renderComponent("pdc_adminsidebar") ?>
        </div>
        <main class="content">
            <div class="profile-header">
                <img src="<?= ROOT ?>/assets/images/default-profile.png" alt="Profile Image" class="profile-image">
                <div class="profile-title">
                    <h1><?= htmlspecialchars($data['studentData']->Name) ?></h1>
                    <span class="status <?= $data['studentData']->Status === 'Blocked' ? 'status-blocked' : ($data['studentData']->Status === 'Pending' ? 'status-pending' : 'status-active') ?>">
                        <i class="fas fa-<?= $data['studentData']->Status === 'Blocked' ? 'ban' : ($data['studentData']->Status === 'Pending' ? 'clock' : 'check-circle') ?>"></i>
                        <?= htmlspecialchars($data['studentData']->Status) ?>
                    </span>

                    <?php if ($data['studentData']->block_count > 0): ?>
                    <div class="block-stats">
                        <span>Blocked <?= htmlspecialchars($data['studentData']->block_count) ?> time(s)</span>
                        
                        <?php if (!empty($data['studentData']->last_blocked_at)): ?>
                        <span>• Last on <?= date('M j, Y', strtotime($data['studentData']->last_blocked_at)) ?></span>
                        <?php endif; ?>
                    
                    </div>
                    <?php endif; ?>



                </div>
            </div>

            <div class="student-details">
                <div class="detail-card">
                    <h3><i class="fas fa-id-card"></i> Basic Information</h3>
                    <div class="detail-item">
                        <span class="detail-label">Registration Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['studentData']->StudentId) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">NIC Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['studentData']->NIC) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Degree Program</span>
                        <div class="detail-value"><?= htmlspecialchars($data['studentData']->DegreeName) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Contact Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['studentData']->ContactNum) ?></div>
                    </div>
                </div>

                <div class="detail-card">
                    <h3><i class="fas fa-envelope"></i> Contact Information</h3>
                    <div class="detail-item">
                        <span class="detail-label">Email Address</span>
                        <div class="detail-value"><?= htmlspecialchars($data['studentData']->Email) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Professional Links</span>
                        <div class="social-links">
                            <?php if (!empty($data['studentData']->Github)): ?>
                                <a href="<?= htmlspecialchars($data['studentData']->Github) ?>" target="_blank" class="social-link">
                                    <i class="fab fa-github"></i> GitHub
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($data['studentData']->Linkedin)): ?>
                                <a href="<?= htmlspecialchars($data['studentData']->Linkedin) ?>" target="_blank" class="social-link">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Applications Count</span>
                        <div class="detail-value"><?= htmlspecialchars($data['noOfAppliedAds']) ?> applications</div>
                    </div>
                </div>
            </div>

            <?php if (!empty($data['studentData']->ShortDesc)): ?>
            <div class="detail-card">
                <h3><i class="fas fa-file-alt"></i> Student Description</h3>
                <p><?= htmlspecialchars($data['studentData']->ShortDesc) ?></p>
            </div>
            <?php endif; ?>

            <div class="applications-section">
                <div class="detail-card">
                    <h3 class="section-title"><i class="fas fa-briefcase"></i> Applied Companies</h3>
                    
                    <?php if (empty($data['applications'])): ?>
                        <div class="no-applications">No companies applied yet</div>
                    <?php else: ?>
                        <div class="applications-grid">
                            <?php foreach ($data['applications'] as $application): ?>
                                <div class="application-card">
                                    <div class="application-header">
                                        <img src="data:image/jpeg;base64,<?= htmlspecialchars($application['CompanyLogo']) ?>" alt="Company Logo" class="company-logo">
                                        <div class="company-info">
                                            <div class="company-name"><?= htmlspecialchars($application['ComName']) ?></div>
                                            <span class="application-status 
                                                <?= strtolower(str_replace(' ', '-', htmlspecialchars($application['Jobstatus']))) ?>">
                                                <?= htmlspecialchars($application['Jobstatus']) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="application-body">
                                        <div class="application-detail">
                                            <strong>Position:</strong> <?= htmlspecialchars($application['position']) ?>
                                        </div>
                                        <div class="application-detail">
                                            <strong>Applied On:</strong> <?= htmlspecialchars($application['CreatedAt']) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
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

            <div class="action-buttons">
                <button class="btn btn-outline" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>

                <?php if (($data['studentData']->block === 1) && ($data['studentData']->Status === 'Blocked')): ?>
                    <button class="btn btn-success" onclick="unblockStudent('<?= htmlspecialchars($data['studentData']->StudentId) ?>')">
                        <i class="fas fa-lock-open"></i> Unblock
                    </button>
                <?php else: ?>
                    <button class="btn btn-danger" onclick="blockStudent('<?= htmlspecialchars($data['studentData']->StudentId) ?>')">
                        <i class="fas fa-ban"></i> Block
                    </button>
                    <button class="btn btn-success" id="edit-btn-student" onclick="openUpdateform()">
                        <i class="fas fa-edit"></i> Update
                    </button>
                <?php endif; ?>
            </div>
        </main>

        <div id="block-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form id="block-form" method="post" action="<?= ROOT ?>/PDC_admin/ViewStudent/block">
                    <input type="hidden" name="StudentId" id="student-id" value="">
                    <div class="modal-header">
                        <h3>Block Student</h3>
                    </div>
                    
                    <div class="modal-body">

                        <div id="confirmationMessage" class="modal-message">
                            <i class="fas fa-info-circle"></i>
                            <span id="messageText"> Please provide a reason for blocking <?= htmlspecialchars($data['studentData']->Name) ?>. This message will be sent to the student's email.</span>
                        </div>

                        <div class="modal-field">
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

        <div id="unblock-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form id="unblock-form" method="post" action="<?= ROOT ?>/PDC_admin/BlockStudent/unblock">
                    <input type="hidden" name="StudentId" id="unblock-student-id" value="">
                    <div class="modal-header">
                        <h3>Unblock Student</h3>
                    </div>
                    <div class="modal-body">
                        <div class="modal-message">
                            <i class="fas fa-info-circle"></i>
                            <span> Are you sure you want to unblock this student?</span>                            
                        </div>
                    </div>
                    <div class="modal-actions">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes, Unblock</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal-overlay" id="updateModal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" onclick="hideUpdateForm()">&times;</span>
                    <h2><i class="fas fa-user-edit"></i> Update Student Information</h2>
                </div>
                <div class="modal-body">
                    <form id="studentUpdateForm" method="post" action="<?= ROOT ?>/PDC_admin/ViewStudent/edit/<?= htmlspecialchars($data['studentData']->StudentId) ?>">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" name="Name" class="form-control" value="<?= htmlspecialchars($data['studentData']->Name) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="Email" class="form-control" value="<?= htmlspecialchars($data['studentData']->Email) ?>" required>
                                <small class="form-hint">Format: example@domain.com</small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="studentId" class="form-label">Student ID</label>
                                <input type="text" id="studentId" name="StudentId" class="form-control" value="<?= htmlspecialchars($data['studentData']->StudentId) ?>"
                                    pattern="\d{4}[a-z]{2}\d{3}"
                                    required>
                                <small class="form-hint">Format: YYYYLLNNN (e.g., 2023cs001)</small>
                            </div>
                            <div class="form-group">
                                <label for="nic" class="form-label">NIC Number</label>
                                <input type="text" id="nic" name="NIC" class="form-control" value="<?= htmlspecialchars($data['studentData']->NIC) ?>"
                                    pattern="^\d{12}$"
                                    required
                                    >
                                <small class="form-hint">Format: 200456789012</small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="tel" id="contact" name="ContactNum" class="form-control" value="<?= htmlspecialchars($data['studentData']->ContactNum) ?>"
                                        pattern="^[0-9+\s()-]{7,20}$"
                                        required
                                ">
                                </div>
                            <div class="form-group">
                                <label for="degree" class="form-label">Degree Program</label>
                                <select id="degree" name="DegreeName" class="form-control">
                                    <option value="<?= htmlspecialchars($data['studentData']->DegreeName) ?>" selected>
                                        <?= htmlspecialchars($data['studentData']->DegreeName) ?>
                                    </option>
                                    <option value="<?= $data['studentData']->DegreeName == 'Computer Science' ? 'Information System' : 'Computer Science' ?>">
                                        <?= $data['studentData']->DegreeName == 'Computer Science' ? 'Information System' : 'Computer Science' ?>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" id="status" name="Status" class="form-control" value="<?= htmlspecialchars($data['studentData']->Status) ?>" hidden>
                        </div>

                        <div class="form-group">
                            <label for="github" class="form-label">GitHub Profile</label>
                            <input type="url" id="github" name="Github" class="form-control" value="<?= !empty($data['studentData']->Github) ? htmlspecialchars($data['Github']) : '' ?>" placeholder="https://github.com/username"
                                pattern="https?://github\.com/.+">
                            <small class="form-hint">Format: https://github.com/username</small>
                        </div>

                        <div class="form-group">
                            <label for="linkedin" class="form-label">LinkedIn Profile</label>
                            <input type="url" id="linkedin" name="Linkedin" class="form-control" value="<?= !empty($data['studentData']->Linkedin) ? htmlspecialchars($data['Linkedin']) : '' ?>" placeholder="https://linkedin.com/in/username"
                                pattern="https?://(www\.)?linkedin\.com/in/.+">
                            <small class="form-hint">Format: https://linkedin.com/in/username</small>    
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Student Description</label>
                            <textarea id="description" name="ShortDesc" class="form-control form-textarea"><?= !empty($data['studentData']->ShortDesc) ? htmlspecialchars($data['studentData']->ShortDesc) : '' ?></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="hideUpdateForm()">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js?v=<?= time() ?>"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
    <script>
        function openUpdateform(){
            document.getElementById('updateModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideUpdateForm(){
            document.getElementById('updateModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        function blockStudent(StudentId) {
            document.getElementById("student-id").value = StudentId;
            document.getElementById("block-modal").classList.add("active");
        }

        function unblockStudent(StudentId) {
            document.getElementById("unblock-student-id").value = StudentId;
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