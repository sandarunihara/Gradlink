<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Overview | PDC Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --secondary: #0ea5e9;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #6366f1;
            --light: #f9fafb;
            --dark: #111827;
            --gray: #6b7280;
            --gray-light: #e5e7eb;
            --border-radius: 0.5rem;
            --border-radius-sm: 0.375rem;
            --border-radius-lg: 0.75rem;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --box-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition: all 0.2s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: var(--dark);
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
            transition: var(--transition);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-left h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            font-size: 0.875rem;
            color: var(--gray);
        }

        .breadcrumb span {
            color: var(--primary);
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }

        .tabs {
            display: flex;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 0.25rem;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .tab-btn {
            flex: 1;
            padding: 0.75rem 1rem;
            background: none;
            border: none;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--gray);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .tab-btn.active {
            color: var(--primary);
            background-color: var(--primary-light);
        }

        .tab-btn:hover:not(.active) {
            background-color: var(--light);
            color: var(--dark);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        .card {
            background: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: var(--box-shadow-lg);
            transform: translateY(-2px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--gray-light);
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-header h2 i {
            color: var(--primary);
        }

        .card-body {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .detail-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 0.95rem;
            color: var(--dark);
            font-weight: 500;
        }

        .card-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-light);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary-light);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }

        .btn-secondary:hover {
            background-color: #0284c7;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(14, 165, 233, 0.2);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.2);
        }

        .btn-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        /* Enhanced colorful status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.4rem 0.85rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .status-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%);
            color: #92400e;
            border-left: 3px solid #f59e0b;
        }

        .status-approved {
            background: linear-gradient(135deg, #d1fae5 0%, #6ee7b7 100%);
            color: #065f46;
            border-left: 3px solid #10b981;
        }

        .status-rejected {
            background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%);
            color: #b91c1c;
            border-left: 3px solid #ef4444;
        }

        .status-reviewing {
            background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);
            color: #1e40af;
            border-left: 3px solid #3b82f6;
        }

        .status-shortlisted {
            background: linear-gradient(135deg, #e0e7ff 0%, #a5b4fc 100%);
            color: #4338ca;
            border-left: 3px solid #6366f1;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: var(--box-shadow);
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
            text-align: center;
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--gray-light);
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: var(--gray);
            font-size: 0.95rem;
            max-width: 400px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            background-color: var(--primary-light);
            color: var(--primary);
            padding: 0.25rem 0.5rem;
            border-radius: var(--border-radius-sm);
            font-size: 0.75rem;
            font-weight: 500;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 1024px) {
            .content {
                margin-left: 0;
                padding: 1rem;
                width: 100%;
            }

            .card-body {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>

        <main class="content">
            <header class="header">
                <div class="header-left">
                    <h1>Application Overview</h1>
                </div>
                <?php if (!empty($application)) : ?>
                <div class="action-buttons">
                </div>
                <?php endif; ?>
            </header>

            <div class="tabs">
                <button class="tab-btn active" data-tab="studentDetails">
                    <i class="fas fa-user-graduate"></i> Student Details
                </button>
                <button class="tab-btn" data-tab="adDetails">
                    <i class="fas fa-clipboard-list"></i> Advertisement
                </button>
                <button class="tab-btn" data-tab="companyDetails">
                    <i class="fas fa-building"></i> Company
                </button>
                <button class="tab-btn" data-tab="timelineDetails">
                    <i class="fas fa-history"></i> Timeline
                </button>
            </div>

            <div class="tab-content active" id="studentDetails">
                <?php if (!empty($application)) : ?>
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-user-graduate"></i> Student Information</h2>
                            <span class="status-badge status-<?= strtolower($application['Status']) ?>">
                                <i class="fas fa-circle" style="font-size: 8px;"></i>
                                <?= htmlspecialchars($application['Status']) ?>
                            </span>
                        </div>
                        
                        <div style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem;">
                            <div class="avatar" style="background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);">
                                <?= substr(htmlspecialchars($application['StudentName']), 0, 1) ?>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">
                                    <?= htmlspecialchars($application['StudentName']) ?>
                                </h3>
                                <p style="color: var(--gray); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                    ID: <?= htmlspecialchars($application['StudentId']) ?>
                                </p>
                                <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                                    <a href="mailto:<?= htmlspecialchars($application['Email']) ?>" class="btn btn-icon btn-outline" style="font-size: 0.8rem;">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="tel:<?= htmlspecialchars($application['ContactNum']) ?>" class="btn btn-icon btn-outline" style="font-size: 0.8rem;">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="detail-item">
                                <div class="detail-label">Email Address</div>
                                <div class="detail-value"><?= htmlspecialchars($application['Email']) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Contact Number</div>
                                <div class="detail-value"><?= htmlspecialchars($application['ContactNum']) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Degree Program</div>
                                <div class="detail-value"><?= htmlspecialchars($application['DegreeName']) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Application Date</div>
                                <div class="detail-value"><?= date('F d, Y', strtotime($application['ApplicationDate'] ?? 'now')) ?></div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <a href="<?= ROOT ?>/PDC_admin/ViewStudent/show/<?= $application['StudentId'] ?>" class="btn btn-primary">
                                <i class="fas fa-external-link-alt"></i> View Full Profile
                            </a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="card">
                        <div class="empty-state">
                            <i class="fas fa-user-slash"></i>
                            <h3>No Student Data Available</h3>
                            <p>The student information could not be found or is not available at this time.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="tab-content" id="adDetails">
                <?php if (!empty($application)) : ?>
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-clipboard-list"></i> Advertisement Details</h2>
                            <span class="status-badge status-<?= strtolower($application['status']) ?>">
                                <i class="fas fa-circle" style="font-size: 8px;"></i>
                                <?= htmlspecialchars($application['status']) ?>
                            </span>
                        </div>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem; color: #2563eb;">
                                <?= htmlspecialchars($application['position']) ?>
                            </h3>
                            <div style="display: flex; flex-wrap: wrap; margin-bottom: 1rem;">
                                <span class="tag" style="background: linear-gradient(135deg, #e0e7ff 0%, #a5b4fc 80%); color: #4338ca;">
                                    <i class="fas fa-calendar-alt" style="margin-right: 0.25rem;"></i>
                                    <?= htmlspecialchars($application['startdate']) ?>
                                </span>
                                <span class="tag" style="background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 80%); color: #1e40af;">
                                    <i class="fas fa-users" style="margin-right: 0.25rem;"></i>
                                    <?= htmlspecialchars($application['numOfInterns']) ?> interns
                                </span>
                                <span class="tag" style="background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 80%); color: #b91c1c;">
                                    <i class="fas fa-clock" style="margin-right: 0.25rem;"></i>
                                    Deadline: <?= htmlspecialchars($application['deadline']) ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="detail-item" style="grid-column: 1 / -1;">
                                <div class="detail-label">Description</div>
                                <div class="detail-value" style="line-height: 1.6;">
                                    <?= nl2br(htmlspecialchars($application['description'] ?? 'No description available.')) ?>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Position</div>
                                <div class="detail-value"><?= htmlspecialchars($application['position']) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Number of Interns</div>
                                <div class="detail-value"><?= htmlspecialchars($application['numOfInterns']) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Start Date</div>
                                <div class="detail-value"><?= htmlspecialchars($application['startdate']) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Application Deadline</div>
                                <div class="detail-value"><?= htmlspecialchars($application['deadline']) ?></div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <a href="<?= ROOT ?>/PDC_admin/ViewAdvertisement/show/<?= $application['advertisementId'] ?>" class="btn btn-primary">
                                <i class="fas fa-external-link-alt"></i> View Full Advertisement
                            </a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="card">
                        <div class="empty-state">
                            <i class="fas fa-clipboard"></i>
                            <h3>No Advertisement Data Available</h3>
                            <p>The advertisement information could not be found or is not available at this time.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="tab-content" id="companyDetails">
                <?php if (!empty($application)) : ?>
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-building"></i> Company Information</h2>
                        </div>
                        
                        <div style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem;">
                            <div class="avatar" style="background: linear-gradient(135deg, #d1fae5 0%, #6ee7b7 100%); color: #065f46;">
                                <?= substr(htmlspecialchars($application['CompanyName']), 0, 1) ?>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #065f46;">
                                    <?= htmlspecialchars($application['CompanyName']) ?>
                                </h3>
                                <p style="color: var(--gray); font-size: 0.9rem;">
                                    ID: <?= htmlspecialchars($application['CompanyId']) ?>
                                </p>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="detail-item" style="grid-column: 1 / -1;">
                                <div class="detail-label">Company Description</div>
                                <div class="detail-value" style="line-height: 1.6;">
                                    <?= nl2br(htmlspecialchars($application['ShortDesc'])) ?>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Industry</div>
                                <div class="detail-value"><?= htmlspecialchars($application['Industry'] ?? 'Not specified') ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Location</div>
                                <div class="detail-value"><?= htmlspecialchars($application['Location'] ?? 'Not specified') ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Website</div>
                                <div class="detail-value">
                                    <?php if (!empty($application['Website'])): ?>
                                        <a href="<?= htmlspecialchars($application['Website']) ?>" target="_blank" style="color: var(--primary); text-decoration: none;">
                                            <?= htmlspecialchars($application['Website']) ?>
                                            <i class="fas fa-external-link-alt" style="font-size: 0.75rem; margin-left: 0.25rem;"></i>
                                        </a>
                                    <?php else: ?>
                                        Not specified
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <?php if (!empty($application['Linkedin'])): ?>
                                <a href="<?= $application['Linkedin'] ?>" target="_blank" class="btn btn-outline">
                                    <i class="fab fa-linkedin"></i> LinkedIn Profile
                                </a>
                            <?php endif; ?>
                            <a href="<?= ROOT ?>/PDC_admin/ViewCompany/show/<?= $application['CompanyId'] ?>" class="btn btn-primary">
                                <i class="fas fa-external-link-alt"></i> Company Details
                            </a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="card">
                        <div class="empty-state">
                            <i class="fas fa-building"></i>
                            <h3>No Company Data Available</h3>
                            <p>The company information could not be found or is not available at this time.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="tab-content" id="timelineDetails">
                <?php if (!empty($application)): ?>
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-history"></i> Application Timeline</h2>
                        </div>
                        
                        <div style="position: relative; padding-left: 30px; margin-top: 1rem;">
                            <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, #6ee7b7, #93c5fd, #fca5a5);"></div>
                            
                            <!-- Timeline items would normally be dynamic from database -->
                            <div style="position: relative; margin-bottom: 1.5rem; padding-bottom: 1.5rem;">
                                <div style="position: absolute; left: -9px; top: 0; width: 16px; height: 16px; border-radius: 50%; background: linear-gradient(135deg, #d1fae5 0%, #6ee7b7 100%); border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></div>
                                <div style="margin-left: 1rem;">
                                    <div style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; color: #065f46;">Application Submitted</div>
                                    <div style="font-size: 0.85rem; color: var(--gray); margin-bottom: 0.5rem;">
                                        <?= date('F d, Y, h:i A', strtotime('-3 days')) ?>
                                    </div>
                                    <div style="font-size: 0.9rem; padding: 0.75rem; background-color: #f0fdf4; border-radius: var(--border-radius-sm); border-left: 3px solid #10b981;">
                                        Student <?= htmlspecialchars($application['StudentName']) ?> applied for the <?= htmlspecialchars($application['position']) ?> position.
                                    </div>
                                </div>
                            </div>
                            
                            <div style="position: relative; margin-bottom: 1.5rem; padding-bottom: 1.5rem;">
                                <div style="position: absolute; left: -9px; top: 0; width: 16px; height: 16px; border-radius: 50%; background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%); border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></div>
                                <div style="margin-left: 1rem;">
                                    <div style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; color: #1e40af;">Application Reviewed</div>
                                    <div style="font-size: 0.85rem; color: var(--gray); margin-bottom: 0.5rem;">
                                        <?= date('F d, Y, h:i A', strtotime('-2 days')) ?>
                                    </div>
                                    <div style="font-size: 0.9rem; padding: 0.75rem; background-color: #eff6ff; border-radius: var(--border-radius-sm); border-left: 3px solid #3b82f6;">
                                        Application was reviewed by the PDC team.
                                    </div>
                                </div>
                            </div>
                            
                            <div style="position: relative;">
                                <div style="position: absolute; left: -9px; top: 0; width: 16px; height: 16px; border-radius: 50%; background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%); border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></div>
                                <div style="margin-left: 1rem;">
                                    <div style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; color: #92400e;">Pending Company Review</div>
                                    <div style="font-size: 0.85rem; color: var(--gray); margin-bottom: 0.5rem;">
                                        <?= date('F d, Y, h:i A', strtotime('-1 day')) ?>
                                    </div>
                                    <div style="font-size: 0.9rem; padding: 0.75rem; background-color: var(--light); border-radius: var(--border-radius-sm);">
                                        Application forwarded to <?= htmlspecialchars($application['CompanyName']) ?> for review.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card">
                        <div class="empty-state">
                            <i class="fas fa-history"></i>
                            <h3>No Timeline Data Available</h3>
                            <p>The application timeline information could not be found or is not available at this time.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabButtons = document.querySelectorAll('.tab-btn');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons and content
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    document.querySelectorAll('.tab-content').forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Show corresponding content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });
    </script>
</body>

</html>