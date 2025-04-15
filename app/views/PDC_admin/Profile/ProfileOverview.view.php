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
            --primary-color:rgb(36, 115, 194);
            --secondary-color:rgb(32, 61, 91);
            --accent-color: #e74c3c;
            --light-gray: #f5f7fa;
            --medium-gray: #e0e0e0;
            --dark-gray: #95a5a6;
            --text-color: #333;
            --white: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
            flex: 1;
            padding: 2rem;
            margin-left: 5%; /* Matching the sidebar width */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--medium-gray);
        }

        .header h1 {
            font-size: 1.8rem;
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

        .info-item {
            display: flex;
            margin-bottom: 1rem;
        }

        .info-label {
            font-weight: 500;
            color: var(--secondary-color);
            min-width: 150px;
        }

        .info-value {
            color: var(--text-color);
            flex: 1;
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
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
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
        }

        .modal-header h2 {
            font-size: 1.5rem;
            color: var(--secondary-color);
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark-gray);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--medium-gray);
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--medium-gray);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .avatar-upload {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            margin-right: 1.5rem;
        }

        .avatar-upload-btn {
            display: flex;
            flex-direction: column;
        }

        .upload-btn {
            padding: 0.5rem 1rem;
            background-color: var(--light-gray);
            border: 1px dashed var(--medium-gray);
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .upload-btn:hover {
            background-color: #e9ecef;
        }

        .avatar-note {
            font-size: 0.8rem;
            color: var(--dark-gray);
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
            
            .modal-content {
                width: 95%;
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
                        <div class="info-item">
                            <span class="info-label">Last Login:</span>
                            <span class="info-value">Today, 09:42 AM</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Login IP:</span>
                            <span class="info-value">192.168.1.105</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Password Last Changed:</span>
                            <span class="info-value">2 weeks ago</span>
                        </div>
                        <div class="action-buttons">
                            <button class="btn btn-outline" id='change-password-btn' >
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
                        <button type="button" class="btn btn-outline" id="cancelPasswordBtn">Cancel</button>
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
                <button class="close-btn" id="closeModalBtn" onclick="closemodal()">&times;</button>
            </div>
            <div class="modal-body">
            <form id="profileForm" action="<?= ROOT ?>/PDC_admin/AdminProfileOverview/edit/<?= htmlspecialchars($data[0]->AssistantId) ?>" method="POST" enctype="multipart/form-data">
                <div class="avatar-upload">
                        <img src="<?= ROOT ?>/assets/images/default-avatar.jpg" alt="Avatar Preview" class="avatar-preview" id="avatarPreview">
                        <div class="avatar-upload-btn">
                            <label for="avatarInput" class="upload-btn">Change Avatar</label>
                            <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;">
                            <span class="avatar-note">Max. 2MB (JPG, PNG)</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" value="<?= $data[0]->Name ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $data[0]->Email ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="contactNumber">Contact Number</label>
                        <input type="tel" class="form-control" id="contactNumber" name="contactNumber" value="<?= $data[0]->contact_number ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= $data[0]->dob ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male" <?= $data[0]->gender == 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= $data[0]->gender == 'Female' ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= $data[0]->gender == 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required><?= $data[0]->address ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline" id="cancelEditBtn" onclick="closemodal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveProfileBtn">Save Changes</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>


    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
    <script>
        const editbtn = document.getElementById('edit-btn');
        const editProfile = document.getElementById('editProfileModal');
        const closebtn = document.getElementById('cancelEditBtn')
        const avatarInput = document.getElementById('avatarInput');
        const avatarPreview = document.getElementById('avatarPreview');
        const changebtn = document.getElementById('change-password-btn');
        const changePasswordModal = document.getElementById('changePasswordModal');

        editbtn.addEventListener("click" , function(){
            editProfile.style.display = 'flex';
            document.body.style.overflow = 'hidden';

        })

        changebtn.addEventListener("click" , function(){
            changePasswordModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        })

        function closemodal(){
            editProfile.style.display = 'none';
            document.body.style.overflow = 'auto';
            changePasswordModal.style.display = 'none';
        }

        avatarInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        
    </script>
</body>

</html>