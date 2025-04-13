<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile | <?= htmlspecialchars($companyData->Name) ?></title>
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
            width: 100%;
        }

        /* Main Content Area */
        .content {
            flex: 1;
            width: 95%;
            
            padding: 1rem;
            padding-left: 8%;
            transition: var(--transition);
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

        /* Toast Styles */
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

.toast-message {
    background: #fff;
    padding: 1rem 1.5rem;
    margin-bottom: 1rem;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-width: 250px;
    opacity: 0;
    transform: translateX(100%);
    transition: all 0.3s ease;
}

.toast-message.toast-success {
    border-left: 4px solid var(--success-color);
}

.toast-message.toast-error {
    border-left: 4px solid var(--danger-color);
}

.toast-content {
    flex: 1;
}

.toast-close-btn {
    background: none;
    border: none;
    color: var(--gray-color);
    cursor: pointer;
    margin-left: 1rem;
    font-size: 1rem;
    padding: 0;
}

.toast-close-btn:hover {
    color: var(--dark-color);
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
            document.addEventListener('DOMContentLoaded', function() {
                <?php if ($type === 'success'): ?>
                    successToast('<?= $message ?>');
                <?php else: ?>
                    errorToast('<?= $message ?>');
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>

    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        
        <main class="content">
            <!-- Company Header with Cover Image -->
            <div class="company-header">
                <div class="cover-image" style="background-image: url('<?= ROOT ?>/<?= !empty($companyData->coverimg) ? htmlspecialchars($companyData->coverimg) : 'assets/images/default-cover.jpg' ?>')">
                    <div class="company-logo" style="background-image: url('<?= ROOT ?>/<?= !empty($companyData->profileimg) ? htmlspecialchars($companyData->profileimg) : 'assets/images/default-profile.png' ?>')">
                        <?php if (empty($companyData->profileimg)): ?>
                            <div class="initials"><?= substr(htmlspecialchars($companyData->Name), 0, 1) ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="company-title">
                    <h1><?= htmlspecialchars($companyData->Name) ?></h1>
                    <span class="company-status <?= $companyData->Status === 'Blocked' ? 'status-blocked' : 'status-active' ?>">
                        <i class="fas fa-<?= $companyData->Status === 'Blocked' ? 'ban' : 'check-circle' ?>"></i>
                        <?= htmlspecialchars($companyData->Status) ?>
                    </span>
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
                            <div class="info-value"><?= htmlspecialchars($companyData->CompanyId) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Contact Person</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->ContactPerson) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->Email) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->ContactNum) ?></div>
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
                            <div class="info-value"><?= htmlspecialchars($companyData->No) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Street Lane</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->Lane) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">City</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->City) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">District</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->District) ?></div>
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
                        <div class="info-value" style="border-bottom: none; padding-bottom: 0;"><?= htmlspecialchars($companyData->ShortDesc) ?></div>
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
                                <?php if (!empty($companyData->Website)): ?>
                                    <a href="<?= htmlspecialchars($companyData->Website) ?>" target="_blank">Visit Website</a>
                                <?php else: ?>
                                    Not provided
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">LinkedIn</span>
                            <div class="info-value">
                                <?php if (!empty($companyData->Linkedin)): ?>
                                    <a href="<?= htmlspecialchars($companyData->Linkedin) ?>" target="_blank">View Profile</a>
                                <?php else: ?>
                                    Not provided
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn btn-back" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                <?php if ($companyData->Status === 'Blocked'): ?>
                    <button class="btn btn-unblock" onclick="unblockCompany('<?= htmlspecialchars($companyData->CompanyId) ?>')">
                        <i class="fas fa-lock-open"></i> Unblock
                    </button>
                <?php else: ?>
                    <button class="btn btn-block" onclick="blockCompany('<?= htmlspecialchars($companyData->CompanyId) ?>')">
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
                    <p>Please provide a reason for blocking <?= htmlspecialchars($companyData->Name) ?>. This message will be sent to the company's email.</p>
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