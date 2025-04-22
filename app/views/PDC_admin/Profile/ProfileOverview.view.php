<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Profile | PDC</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/profile/overviewProfile.css?v=<?= time() ?>">
    
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