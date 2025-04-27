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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/viewCompany.css?v=<?= time() ?>">
    
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
            <img src="<?= ROOT ?>/assets/img/Student/<?= htmlspecialchars($data['studentData']->ProfilePic ?? 'default-profile.png') ?>" alt="Profile Image" class="profile-image">
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
                                        <img src="<?=ROOT .'/assets/img/Company/' . htmlspecialchars($application['CompanyLogo']) ?>" alt="Company Logo" class="company-logo">
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
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="Name" class="form-control" value="<?= htmlspecialchars($data['studentData']->Name) ?>">
                                <p class="error-message">Name cannot be empty</p>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="Email" class="form-control" value="<?= htmlspecialchars($data['studentData']->Email) ?>">
                                <small class="form-hint">Format: example@domain.com</small>
                                <p class="error-message">Email cannot be empty</p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="studentId" class="form-label">Student ID</label>
                                <input type="text" id="studentId" name="StudentId" class="form-control" value="<?= htmlspecialchars($data['studentData']->StudentId) ?>"
                                    >
                                <small class="form-hint">Format: YYYYLLNNN (e.g., 2023cs001)</small>
                                <p class="error-message basic">Student ID cannot be empty</p>
                                <p class="error-message pattern">Student ID not valid pattern</p>
                            </div>
                            <div class="form-group">
                                <label for="nic" class="form-label">NIC Number</label>
                                <input type="text" id="nic" name="NIC" class="form-control" value="<?= htmlspecialchars($data['studentData']->NIC) ?>"
                                    >
                                <small class="form-hint">Format: 200456789012</small>
                                <p class="error-message basic">NIC cannot be empty</p>
                                <p class="error-message pattern">NIC ID not valid pattern</p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="tel" id="contact" name="ContactNum" class="form-control" value="<?= htmlspecialchars($data['studentData']->ContactNum) ?>"
                                >
                                <small class="form-hint">Enter a valid phone number (e.g. 0733333333)</small>
                                <p class="error-message basic">Contact Number cannot be empty</p>
                                <p class="error-message pattern">Contact Number not valid pattern</p>
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


        const studentUpdateForm = document.getElementById('studentUpdateForm');
        
        studentUpdateForm.addEventListener('submit' , function(e){

            let haserrorUpdate = false

            const errors = document.querySelectorAll('.error-message');
            errors.forEach(msg => msg.style.display = 'none');

            const studentName = document.getElementById('name')
            if(studentName.value.trim() === ""){
                studentName.nextElementSibling.style.display = 'block'
                haserrorUpdate = true
            }


        // } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {


            const studentEmail = document.getElementById('email');
            const emailError = studentEmail.closest('.form-group').querySelector('.error-message');

            if(studentEmail.value.trim() === ""){
                emailError.style.display = 'block';
                haserrorUpdate = true;
            } else {
                emailError.style.display = 'none';
            }

            const studentId = document.getElementById('studentId');
            const studentIdValue = studentId.value.trim()
            if(studentIdValue === ""){
                studentId.parentElement.querySelector('.error-message.basic').style.display = 'block'
                haserrorUpdate = true
            }
            else if(!/^\d{4}(cs|is)\d{3}$/.test(studentIdValue)){
                studentId.parentElement.querySelector('.error-message.pattern').style.display = 'block'
                haserrorUpdate = true
            }

            const studentnic = document.getElementById('nic');
            const studentnicValue = studentnic.value.trim()
            if(studentnicValue === ""){
                studentnic.parentElement.querySelector('.error-message.basic').style.display = 'block'
                haserrorUpdate = true
            }
            else if(!/^\d{12}$/.test(studentnicValue)){
                studentnic.parentElement.querySelector('.error-message.pattern').style.display = 'block'
                haserrorUpdate = true
            }

            const number = document.getElementById('contact');
            const numberValue = number.value.trim();
            if (numberValue === "") {
                number.parentElement.querySelector('.error-message.basic').style.display = 'block';
                haserrorUpdate = true;
            } else if (!/^\d{10}$/.test(numberValue)) {
                number.parentElement.querySelector('.error-message.pattern').style.display = 'block';
                haserrorUpdate = true;
            }

            if(haserrorUpdate){
                e.preventDefault()
            }

        })


    </script>
</body>
</html>