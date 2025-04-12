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
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --border-radius: 8px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
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
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        .content {
            flex: 1;
            width: 95%;
            padding: 2rem;
            margin-left: 5%;
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
            color: var(--primary);
            border-bottom: 1px solid #eee;
            padding-bottom: 0.5rem;
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
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn i {
            font-size: 1rem;
        }

        .btn-update {
            background-color: var(--primary);
            color: white;
        }

        .btn-update:hover {
            background-color: var(--secondary);
        }

        .btn-back {
            background-color: #e9ecef;
            color: var(--dark);
        }

        .btn-back:hover {
            background-color: #dee2e6;
        }

        .btn-block {
            background-color: var(--danger);
            color: white;
        }

        .btn-block:hover {
            background-color: #c82333;
        }

        .btn-unblock {
            background-color: var(--success);
            color: white;
        }

        .btn-unblock:hover {
            background-color: #218838;
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
            background-color: #e9ecef;
            color: var(--dark);
        }

        .btn-cancel:hover {
            background-color: #dee2e6;
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
            background-color: var(--secondary);
        }

        .btn-secondary {
            background-color: #e9ecef;
            color: var(--dark);
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
            <div class="profile-header">
                <img src="<?= ROOT ?>/assets/images/default-profile.png" alt="Profile Image" class="profile-image">
                <div class="profile-title">
                    <h1><?= htmlspecialchars($data['Name']) ?></h1>
                    <span class="status <?= $data['Status'] === 'Blocked' ? 'status-blocked' : ($data['Status'] === 'Pending' ? 'status-pending' : 'status-active') ?>">
                        <i class="fas fa-<?= $data['Status'] === 'Blocked' ? 'ban' : ($data['Status'] === 'Pending' ? 'clock' : 'check-circle') ?>"></i>
                        <?= htmlspecialchars($data['Status']) ?>
                    </span>
                </div>
            </div>

            <div class="student-details">
                <div class="detail-card">
                    <h3><i class="fas fa-id-card"></i> Basic Information</h3>
                    <div class="detail-item">
                        <span class="detail-label">Registration Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['StudentId']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">NIC Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['NIC']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Degree Program</span>
                        <div class="detail-value"><?= htmlspecialchars($data['DegreeName']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Contact Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['ContactNum']) ?></div>
                    </div>
                </div>

                <div class="detail-card">
                    <h3><i class="fas fa-envelope"></i> Contact Information</h3>
                    <div class="detail-item">
                        <span class="detail-label">Email Address</span>
                        <div class="detail-value"><?= htmlspecialchars($data['Email']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Professional Links</span>
                        <div class="social-links">
                            <?php if (!empty($data['Github'])): ?>
                                <a href="<?= htmlspecialchars($data['Github']) ?>" target="_blank" class="social-link">
                                    <i class="fab fa-github"></i> GitHub
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($data['Linkedin'])): ?>
                                <a href="<?= htmlspecialchars($data['Linkedin']) ?>" target="_blank" class="social-link">
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

            <?php if (!empty($data['ShortDesc'])): ?>
            <div class="detail-card">
                <h3><i class="fas fa-file-alt"></i> Student Description</h3>
                <p><?= htmlspecialchars($data['ShortDesc']) ?></p>
            </div>
            <?php endif; ?>

            <div class="applications-section">
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

            <div class="action-buttons">
                <button class="btn btn-back" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                <button class="btn btn-update" id="edit-btn-student" onclick="openUpdateform()">
                    <i class="fas fa-edit"></i> Update
                </button>
                <?php if ($data['block'] === 1): ?>
                    <button class="btn btn-unblock" onclick="unblockStudent('<?= htmlspecialchars($data['StudentId']) ?>')">
                        <i class="fas fa-lock-open"></i> Unblock
                    </button>
                <?php else: ?>
                    <button class="btn btn-block" onclick="blockStudent('<?= htmlspecialchars($data['StudentId']) ?>')">
                        <i class="fas fa-ban"></i> Block
                    </button>
                <?php endif; ?>
            </div>
        </main>

        <div id="block-modal" class="modal">
            <div class="modal-content">
                <form id="block-form" method="post" action="<?= ROOT ?>/PDC_admin/ViewStudent/block">
                    <input type="hidden" name="StudentId" id="student-id" value="">
                    <div class="modal-header">
                        <h3>Block Student</h3>
                    </div>
                    <div class="modal-body">
                        <p>Please provide a reason for blocking <?= htmlspecialchars($data['Name']) ?>. This message will be sent to the student's email.</p>
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

        <div id="unblock-modal" class="modal">
            <div class="modal-content">
                <form id="unblock-form" method="post" action="<?= ROOT ?>/PDC_admin/BlockStudent/unblock">
                    <input type="hidden" name="StudentId" id="unblock-student-id" value="">
                    <div class="modal-header">
                        <h3>Unblock Student</h3>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to unblock this student?</p>
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
                    <h2><i class="fas fa-user-edit"></i> Update Student Information</h2>
                    <button class="modal-close" onclick="hideUpdateForm()">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="studentUpdateForm" method="post" action="<?= ROOT ?>/PDC_admin/ViewStudent/edit/<?= htmlspecialchars($data['StudentId']) ?>">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" name="Name" class="form-control" value="<?= htmlspecialchars($data['Name']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="Email" class="form-control" value="<?= htmlspecialchars($data['Email']) ?>">
                                <small class="form-hint">Format: example@domain.com</small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="studentId" class="form-label">Student ID</label>
                                <input type="text" id="studentId" name="StudentId" class="form-control" value="<?= htmlspecialchars($data['StudentId']) ?>"
                                    pattern="\d{4}[a-z]{2}\d{3}">
                                <small class="form-hint">Format: YYYYLLNNN (e.g., 2023cs001)</small>
                            </div>
                            <div class="form-group">
                                <label for="nic" class="form-label">NIC Number</label>
                                <input type="text" id="nic" name="NIC" class="form-control" value="<?= htmlspecialchars($data['NIC']) ?>"
                                    pattern="^\d{12}$">
                                <small class="form-hint">Format: 200456789012</small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="tel" id="contact" name="ContactNum" class="form-control" value="<?= htmlspecialchars($data['ContactNum']) ?>"
                                    pattern="\d{10,15}$">
                            </div>
                            <div class="form-group">
                                <label for="degree" class="form-label">Degree Program</label>
                                <select id="degree" name="DegreeName" class="form-control">
                                    <option value="<?= htmlspecialchars($data['DegreeName']) ?>" selected>
                                        <?= htmlspecialchars($data['DegreeName']) ?>
                                    </option>
                                    <option value="<?= $data['DegreeName'] == 'Computer Science' ? 'Information System' : 'Computer Science' ?>">
                                        <?= $data['DegreeName'] == 'Computer Science' ? 'Information System' : 'Computer Science' ?>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" id="status" name="Status" class="form-control" value="<?= htmlspecialchars($data['Status']) ?>" hidden>
                        </div>

                        <div class="form-group">
                            <label for="github" class="form-label">GitHub Profile</label>
                            <input type="url" id="github" name="Github" class="form-control" value="<?= !empty($data['Github']) ? htmlspecialchars($data['Github']) : '' ?>" placeholder="https://github.com/username"
                                pattern="https?://github\.com/.+">
                            <small class="form-hint">Format: https://github.com/username</small>
                        </div>

                        <div class="form-group">
                            <label for="linkedin" class="form-label">LinkedIn Profile</label>
                            <input type="url" id="linkedin" name="Linkedin" class="form-control" value="<?= !empty($data['Linkedin']) ? htmlspecialchars($data['Linkedin']) : '' ?>" placeholder="https://linkedin.com/in/username"
                                pattern="https?://(www\.)?linkedin\.com/in/.+">
                            <small class="form-hint">Format: https://linkedin.com/in/username</small>    
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Student Description</label>
                            <textarea id="description" name="ShortDesc" class="form-control form-textarea"><?= !empty($data['ShortDesc']) ? htmlspecialchars($data['ShortDesc']) : '' ?></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-cancel" onclick="hideUpdateForm()">Cancel</button>
                            <button type="submit" class="btn btn-save">Save Changes</button>
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