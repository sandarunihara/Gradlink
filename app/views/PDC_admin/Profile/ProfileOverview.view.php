<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Profile | PDC</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: rgb(36, 115, 194);
            --secondary-color: rgb(32, 61, 91);
            --accent-color: #e74c3c;
            --light-gray: #f5f7fa;
            --medium-gray: #e0e0e0;
            --dark-gray: #95a5a6;
            --text-color: #333;
            --white: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --danger-color: #dc3545;
            --gray-color: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--text-color);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 80px; /* Same as sidebar width */
    flex: 1;
    padding: 40px 40px 40px 40px;
    background-color: #f0f0f5;
    min-height: 100vh;
    transition: margin-left 0.3s;

        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .profile-container {
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--medium-gray);
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-color);
            margin-right: 2rem;
            box-shadow: var(--shadow);
        }

        .profile-info h2 {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .profile-info p {
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .profile-info .role-badge {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .profile-sections {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            background: var(--white);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
        }

        .profile-section h3 {
            font-size: 1.2rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--medium-gray);
            display: flex;
            align-items: center;
        }

        .profile-section h3 i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .security-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            padding: 1rem;
            background-color: var(--light-gray);
            border-radius: 8px;
        }

        .info-label {
            font-size: 0.85rem;
            color: var(--dark-gray);
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .info-value {
            font-size: 1rem;
            color: var(--text-color);
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        @media (max-width: 768px) {
            .security-info-grid {
                grid-template-columns: 1fr;
            }
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .stat-card {
            background: var(--light-gray);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card .stat-value {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-label {
            font-size: 0.9rem;
            color: var(--dark-gray);
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem;
            gap: 1rem;
        }

        .btn {
            padding: 0.7rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color:rgb(52, 81, 101);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        @media (max-width: 992px) {
            .profile-sections {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-avatar {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .info-item {
                flex-direction: column;
            }
            
            .info-label {
                margin-bottom: 0.3rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: white;
            border-radius: 12px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn 0.3s;
            position: relative;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--medium-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            border-radius: 12px 12px 0 0;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin: 0;
        }

        .close {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 1.5rem;
            color: var(--gray-color);
            cursor: pointer;
            transition: var(--transition);
            background: none;
            border: none;
            padding: 0.5rem;
            line-height: 1;
        }

        .close:hover {
            color: var(--danger-color);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 1.5rem;
        }

        /* Enhanced Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: var(--light-gray);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(36, 115, 194, 0.1);
            background-color: var(--white);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }

        .avatar-upload {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--medium-gray);
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            margin-right: 1.5rem;
            box-shadow: var(--shadow);
        }

        .avatar-upload-btn {
            display: flex;
            flex-direction: column;
        }

        .upload-btn {
            padding: 0.75rem 1.5rem;
            background-color: var(--light-gray);
            border: 2px dashed var(--medium-gray);
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            background-color: #e9ecef;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .avatar-note {
            font-size: 0.8rem;
            color: var(--dark-gray);
            max-width: 200px;
        }

        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--medium-gray);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            position: sticky;
            bottom: 0;
            background: white;
            z-index: 10;
            border-radius: 0 0 12px 12px;
        }

        /* Password strength meter */
        .password-strength-meter {
            height: 4px;
            background-color: var(--medium-gray);
            margin-top: 8px;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0;
            background-color: var(--accent-color);
            transition: width 0.3s, background-color 0.3s;
        }
        
        .password-requirements {
            color: var(--dark-gray);
            margin-top: 5px;
            font-size: 0.8rem;
        }
        
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 42px;
            cursor: pointer;
            color: var(--dark-gray);
            z-index: 2;
        }
        
        .text-error {
            color: var(--accent-color);
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-group.full-width {
                grid-column: span 1;
            }
            
            .avatar-upload {
                flex-direction: column;
                text-align: center;
            }
            
            .avatar-preview {
                margin-right: 0;
                margin-bottom: 1rem;
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

        .toggle-password {
        position: absolute;
        right: 15px;
        top: 42px;
        cursor: pointer;
        color: var(--dark-gray);
    }
    
    .password-strength-meter {
        height: 4px;
        background-color: var(--medium-gray);
        margin-top: 8px;
        border-radius: 2px;
        overflow: hidden;
    }
    
    .strength-bar {
        height: 100%;
        width: 0;
        background-color: var(--accent-color);
        transition: width 0.3s, background-color 0.3s;
    }
    
    .password-requirements {
        color: var(--dark-gray);
        margin-top: 5px;
        display: block;
    }
    
    .password-requirements ul {
        margin-top: 5px;
        padding-left: 20px;
    }
    
    .password-requirements li {
        list-style-type: none;
        position: relative;
    }
    
    .password-requirements li:before {
        content: "✗";
        color: var(--accent-color);
        position: absolute;
        left: -20px;
    }
    
    .password-requirements li.valid:before {
        content: "✓";
        color: #28a745;
    }
    
    .form-group {
        position: relative;
    }
    
    .text-error {
        color: var(--accent-color);
        font-size: 0.8rem;
        margin-top: 5px;
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
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Admin Profile</h1>
                </div>
            </header>

            <div class="profile-container">
                <div class="profile-header">
                    <img src="<?= ROOT ?>/assets/images/default-avatar.jpg" alt="Admin Avatar" class="profile-avatar">
                    <div class="profile-info">
                        <h2><?= $data[0]->Name ?></h2>
                        <p><?= $data[0]->Email ?></p>
                        <p>+<?= $data[0]->contact_number ?></p>
                        <span class="role-badge">Administrator</span>
                    </div>
                </div>

                <div class="profile-sections">
                    <div class="profile-section">
                        <h3><i class="fas fa-info-circle"></i> Personal Information</h3>
                        <div class="info-item">
                            <span class="info-label">Full Name:</span>
                            <span class="info-value"><?= $data[0]->Name ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Date of Birth:</span>
                            <span class="info-value"><?= $data[0]->dob ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Gender:</span>
                            <span class="info-value"><?= $data[0]->gender ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Address:</span>
                            <span class="info-value"><?= $data[0]->address ?></span>
                        </div>
                    </div>

                    <div class="profile-section">
                        <h3><i class="fas fa-briefcase"></i> Professional Information</h3>
                        <div class="info-item">
                            <span class="info-label">Position:</span>
                            <span class="info-value">PDC Administrator</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Department:</span>
                            <span class="info-value">Professional Development Center</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Employee ID:</span>
                            <span class="info-value"><?= $data[0]->AssistantId ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Join Date:</span>
                            <span class="info-value">March 10, 2020</span>
                        </div>
                    </div>

                    <div class="profile-section">
                        <h3><i class="fas fa-chart-line"></i> Activity Stats</h3>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-value"><?= $data[2] ?></div>
                                <div class="stat-label">Pending Companies</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value"><?= $data[1] ?></div>
                                <div class="stat-label">Pending Addvertisements</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value"><?= $data[3] ?></div>
                                <div class="stat-label">Not Applied Students</div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-section">
                        <h3><i class="fas fa-lock"></i> Security</h3>
                        
                        <div class="security-info-grid">
                            <div class="info-item">
                                <span class="info-label">Last Login:</span>
                                <span class="info-value">
                                    <?php 
                                    if(isset($_SESSION['logintime'])) {
                                        $loginTime = new DateTime($_SESSION['logintime']);
                                        echo $loginTime->format('M j, Y \a\t g:i A');
                                    } else {
                                        echo 'Never logged in';
                                    }
                                    ?>
                                </span>
                            </div>
                            
                            <!-- <div class="info-item">
                                <span class="info-label">Password Last Changed:</span>
                                <span class="info-value">
                                    <?php
                                    if(isset($data[0]->password_changed_at)) {
                                        $changedTime = new DateTime($data[0]->password_changed_at);
                                        $interval = $changedTime->diff(new DateTime());
                                        
                                        if($interval->y > 0) {
                                            echo $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                                        } elseif($interval->m > 0) {
                                            echo $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                                        } elseif($interval->d > 0) {
                                            echo $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                                        } else {
                                            echo 'Today';
                                        }
                                    } else {
                                        echo 'Never changed';
                                    }
                                    ?>
                                </span>
                            </div> -->
                        </div>
                        
                        <div class="action-buttons">
                            <button class="btn btn-outline" id='change-password-btn'>
                                <i class="fas fa-key"></i> Change Password
                            </button>
                            <button class="btn btn-primary" id='edit-btn'>
                                <i class="fas fa-user-edit"></i> Edit Profile
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </main>
    </div>

    <div class="modal" id='changePasswordModal'>
        <div class="modal-content">

            <div class="modal-header">
                <h2>Change Password</h2>
                <button class="close-btn" id="closePasswordModalBtn" onclick="closemodal()">&times;</button>
            </div>

            <div class="modal-body">
                <form id="changePasswordForm" action="<?= ROOT ?>/PDC_admin/AdminProfileOverview/changePassword/<?= htmlspecialchars($data[0]->AssistantId) ?>" method="POST">
                    
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('currentPassword')"></i>
                    </div>
                    
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        <div class="password-strength-meter">
                            <div class="strength-bar"></div>
                        </div>
                        <small class="password-requirements">
                            Password must be at least 8 characters long and contain:
                        </small>
                        <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('newPassword')"></i>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('confirmPassword')"></i>
                        <small id="passwordMatchError" class="text-error" style="display:none;color:var(--accent-color);">Passwords do not match</small>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-outline close-btn" onclick="closemodal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="savePasswordBtn">Change Password</button>
                    </div>
                
                </form>
            
            </div>
        
        </div>
    </div>

    <div class="modal" id="editProfileModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Profile</h2>
                <button class="close" id="closeModalBtn">&times;</button>
            </div>
            <div class="modal-body">
                <form id="profileForm" action="<?= ROOT ?>/PDC_admin/AdminProfileOverview/edit/<?= htmlspecialchars($data[0]->AssistantId) ?>" method="POST" enctype="multipart/form-data">
                    <div class="avatar-upload">
                        <img src="<?= ROOT ?>/assets/images/default-avatar.jpg" alt="Avatar Preview" class="avatar-preview" id="avatarPreview">
                        <div class="avatar-upload-btn">
                            <label for="avatarInput" class="upload-btn">
                                <i class="fas fa-camera"></i> Change Avatar
                            </label>
                            <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;">
                            <span class="avatar-note">Recommended: Square image, max 2MB (JPG, PNG)</span>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" value="<?= htmlspecialchars($data[0]->Name) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($data[0]->Email) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="contactNumber">Contact Number</label>
                            <input type="tel" class="form-control" id="contactNumber" name="contactNumber" value="<?= htmlspecialchars($data[0]->contact_number) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($data[0]->dob) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Male" <?= $data[0]->gender == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= $data[0]->gender == 'Female' ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?= $data[0]->gender == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?= htmlspecialchars($data[0]->address) ?></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" id="cancelEditBtn">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveProfileBtn">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editBtn = document.getElementById('edit-btn');
            const editProfileModal = document.getElementById('editProfileModal');
            const changeBtn = document.getElementById('change-password-btn');
            const changePasswordModal = document.getElementById('changePasswordModal');
            const closeButtons = document.querySelectorAll('.close, .btn-outline');
            const avatarInput = document.getElementById('avatarInput');
            const avatarPreview = document.getElementById('avatarPreview');

            // Open edit profile modal
            editBtn.addEventListener("click", function() {
                editProfileModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });

            // Open change password modal
            changeBtn.addEventListener("click", function() {
                changePasswordModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });

            // Close modals
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.modal').forEach(modal => {
                        modal.style.display = 'none';
                    });
                    document.body.style.overflow = 'auto';
                });
            });

            // Close modal when clicking outside content
            window.addEventListener('click', function(event) {
                if (event.target.classList.contains('modal')) {
                    event.target.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });

            // Avatar preview
            avatarInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size exceeds 2MB limit');
                        this.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        avatarPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Toggle password visibility function
            function togglePasswordVisibility(inputId) {
                const input = document.getElementById(inputId);
                const icon = input.nextElementSibling;
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = "password";
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            }
        });
    </script>
</body>

</html>