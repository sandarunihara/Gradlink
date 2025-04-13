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
    </style>
</head>

<body>
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
                                        <?= htmlspecialchars($session->hall_number) ?> - 
                                        <?= $session->hall_number == 'W001' ? 'Main Auditorium' : 
                                           ($session->hall_number == 'S104' ? 'Seminar Room' : 'Conference Hall') ?>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Session Type</div>
                                    <div class="detail-value"><?= htmlspecialchars($session->session_type ?? 'Standard') ?></div>
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
                            <?= substr(htmlspecialchars($session->Name), 0, 1) ?>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #065f46;">
                                <?= htmlspecialchars($session->Name) ?>
                            </h3>
                            <p style="color: var(--gray); font-size: 0.9rem;">
                                ID: <?= htmlspecialchars($session->CompanyId) ?>
                            </p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="details-grid">
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Industry</div>
                                    <div class="detail-value"><?= htmlspecialchars($session->ShortDesc) ?></div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Contact Person</div>
                                    <div class="detail-value"><?= htmlspecialchars($session->ContactPerson) ?></div>
                                </div>
                            </div>
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Contact Information</div>
                                    <div class="detail-value">
                                        <i class="fas fa-phone"></i> <?= htmlspecialchars($session->ContactNum) ?><br>
                                        <i class="fas fa-envelope"></i> <?= htmlspecialchars($session->Email) ?>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Location</div>
                                    <div class="detail-value">
                                        <?= htmlspecialchars($session->No) ?>, <?= htmlspecialchars($session->Lane) ?>,<br>
                                        <?= htmlspecialchars($session->City) ?>, <?= htmlspecialchars($session->District) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="<?= htmlspecialchars($session->Website) ?>" target="_blank" class="btn btn-outline">
                            <i class="fas fa-globe"></i> Website
                        </a>
                        <a href="<?= htmlspecialchars($session->Linkedin) ?>" target="_blank" class="btn btn-outline">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="<?= ROOT ?>/PDC_admin/ViewCompany/show/<?= $session->CompanyId ?>" class="btn btn-primary">
                            <i class="fas fa-external-link-alt"></i> View Full Profile
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const validity = document.getElementById('check-date');
            const sessionDateStr = "<?= $session->session_date ?>";
            
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            const sessionDate = new Date(sessionDateStr);
            sessionDate.setHours(0, 0, 0, 0);
            
            const formattedDate = sessionDate.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            if (sessionDate < today) {
                validity.innerHTML = `<i class="fas fa-clock"></i> Expired on ${formattedDate}`;
                validity.classList.add('status-expired');
            } else {
                validity.innerHTML = `<i class="fas fa-calendar-day"></i> ${formattedDate}`;
                validity.classList.add('status-active');
            }


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

            // Edit toggle functionality
            const editToggleBtn = document.getElementById('edit-toggle-btn');
            const saveBtn = document.getElementById('save-btn');
            const formInputs = document.querySelectorAll('input, select, textarea');
            
            editToggleBtn.addEventListener('click', function() {
                const isEditing = saveBtn.style.display === 'block';
                
                if (isEditing) {
                    // Switching back to view mode
                    saveBtn.style.display = 'none';
                    editToggleBtn.innerHTML = '<i class="fas fa-edit"></i> Edit Session';
                    formInputs.forEach(input => {
                        input.readOnly = true;
                        if (input.tagName === 'SELECT') {
                            input.disabled = true;
                        }
                    });
                } else {
                    // Switching to edit mode
                    saveBtn.style.display = 'block';
                    editToggleBtn.innerHTML = '<i class="fas fa-times"></i> Cancel';
                    formInputs.forEach(input => {
                        input.readOnly = false;
                        if (input.tagName === 'SELECT') {
                            input.disabled = false;
                        }
                    });
                }
            });
            
            saveBtn.addEventListener('click', function() {
                // Submit form logic here
                alert('Changes saved!');
            });
        });
    </script>
</body>
</html>