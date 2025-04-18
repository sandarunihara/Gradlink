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
        /* ================ ROOT VARIABLES ================ */
        :root {
            /* Colors */
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
            --sidebar-width: 80px;
            
            /* UI Elements */
            --border-radius: 0.5rem;
            --border-radius-sm: 0.375rem;
            --border-radius-lg: 0.75rem;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --box-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition: all 0.2s ease;
        }

        /* ================ BASE STYLES ================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f5;
            color: var(--dark);
            line-height: 1.5;
        }

        /* ================ LAYOUT STRUCTURE ================ */
        .container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        .content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2rem;
            min-height: 100vh;
            transition: var(--transition);
            background-color: #f8fafc;
        }

        @media (max-width: 768px) {
            .content {
                padding: 1.5rem;
            }
        }

        /* ================ HEADER STYLES ================ */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
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
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumb span {
            color: var(--primary);
            font-weight: 500;
        }

        .breadcrumb i {
            font-size: 0.7rem;
            color: var(--gray-light);
        }

        /* ================ TAB SYSTEM ================ */
        .tabs {
            display: flex;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 0.25rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            scrollbar-width: none; /* Firefox */
        }

        .tabs::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }

        .tab-btn {
            flex: 1;
            min-width: 180px;
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
            white-space: nowrap;
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

        /* ================ CARD COMPONENTS ================ */
        .card {
            background: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--box-shadow);
            padding: 1.75rem;
            margin-bottom: 2rem;
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            box-shadow: var(--box-shadow-lg);
            transform: translateY(-2px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-light);
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-header h2 i {
            color: var(--primary);
            font-size: 1.1rem;
        }

        .card-body {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.75rem;
        }

        .card-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 2rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--gray-light);
        }

        /* ================ DETAIL ITEMS ================ */
        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .detail-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 0.95rem;
            color: var(--dark);
            font-weight: 500;
            line-height: 1.5;
        }

        /* ================ BUTTONS ================ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.65rem 1.5rem;
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

        .btn-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        /* ================ STATUS BADGES ================ */
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
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .status-blocked {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .status-ongoing {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-deactive {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .status-reject {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-pending {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        /* ================ AVATAR & EMPTY STATES ================ */
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
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--primary);
            flex-shrink: 0;
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
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            font-size: 1.25rem;
            color: var(--dark);
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .empty-state p {
            color: var(--gray);
            font-size: 0.95rem;
            max-width: 400px;
            line-height: 1.6;
        }

        /* ================ TIMELINE ================ */
        .timeline {
            position: relative;
            padding-left: 30px;
            margin-top: 1rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #6ee7b7, #93c5fd, #fca5a5);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 1.75rem;
            padding-bottom: 1.5rem;
        }

        .timeline-marker {
            position: absolute;
            left: -9px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .timeline-content {
            margin-left: 1rem;
        }

        .timeline-date {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ================ UTILITY CLASSES ================ */
        .flex-row {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-right: 0.75rem;
            margin-bottom: 0.75rem;
        }

        /* ================ ANIMATIONS ================ */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ================ RESPONSIVE ADJUSTMENTS ================ */
        @media (max-width: 1024px) {
            .card-body {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .card {
                padding: 1.5rem;
            }
            
            .card-body {
                grid-template-columns: 1fr;
            }
            
            .flex-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .card-footer {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
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
                            <span class="status-badge <?= strtolower($application['Status']) === 'blocked' ? 'status-blocked' : 'status-ongoing' ?>">
                                <i class="fas fa-circle" style="font-size: 8px;"></i>
                                <?= strtolower($application['Status']) === 'blocked' ? 'Blocked' : 'Ongoing' ?>
                            </span>
                        </div>
                        
                        <div class="flex-row">
                            <div class="avatar" style="background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);">
                                <?= substr(htmlspecialchars($application['StudentName']), 0, 1) ?>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">
                                    <?= htmlspecialchars($application['StudentName']) ?>
                                </h3>
                                <p style="color: var(--gray); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                    <i class="fas fa-id-card"></i> ID: <?= htmlspecialchars($application['StudentId']) ?>
                                </p>
                                <div style="display: flex; gap: 1rem; margin-top: 0.75rem;">
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
                                <div class="detail-value">
                                    <a href="mailto:<?= htmlspecialchars($application['Email']) ?>" style="color: var(--primary); text-decoration: none;">
                                        <?= htmlspecialchars($application['Email']) ?>
                                    </a>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Contact Number</div>
                                <div class="detail-value">
                                    <a href="tel:<?= htmlspecialchars($application['ContactNum']) ?>" style="color: var(--primary); text-decoration: none;">
                                        <?= htmlspecialchars($application['ContactNum']) ?>
                                    </a>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Degree Program</div>
                                <div class="detail-value"><?= htmlspecialchars($application['DegreeName']) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Application Date</div>
                                <div class="detail-value">
                                    <i class="far fa-calendar-alt" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= date('F d, Y', strtotime($application['ApplicationDate'] ?? 'now')) ?>
                                </div>
                            </div>
                            <div class="detail-item">

                            <?php if($application['CV'] != null):?>
                                <div class="detail-label">CV Status</div>
                                    <div class="detail-value">
                                        <span class="status-badge status-approved">
                                            <i class="fas fa-check-circle" style="font-size: 8px;"></i>
                                            Submitted
                                        </span>
                                    </div>
                                </div>
                            <?php else:?>
                                <div class="detail-label">CV Status</div>
                                    <div class="detail-value">
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock" style="font-size: 8px;"></i>
                                            Not Submitted
                                        </span>
                                    </div>
                                </div>
                            <?php endif;?>

                            <div class="detail-item">
                                <div class="detail-label">Company Response</div>
                                <div class="detail-value">
                                    <?php if ($application['Jobstatus'] === 'Pending'): ?>
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock" style="font-size: 8px;"></i>
                                            Pending
                                        </span>
                                    <?php elseif ($application['Jobstatus'] === 'Reject'): ?>
                                        <span class="status-badge status-rejected">
                                            <i class="fas fa-times-circle" style="font-size: 8px;"></i>
                                            Rejected
                                        </span>
                                    <?php elseif ($application['Jobstatus'] === 'Shortlist'): ?>
                                        <span class="status-badge" style="background-color: #dbeafe; color: #1e40af;">
                                            <i class="fas fa-list" style="font-size: 8px;"></i>
                                            Shortlisted
                                        </span>
                                    <?php elseif ($application['Jobstatus'] === 'Recruit'): ?>
                                        <span class="status-badge status-approved">
                                            <i class="fas fa-check-circle" style="font-size: 8px;"></i>
                                            Recruited
                                        </span>
                                    <?php else: ?>
                                        <span class="status-badge" style="background-color: #e5e7eb; color: #4b5563;">
                                            <i class="fas fa-question-circle" style="font-size: 8px;"></i>
                                            Status Unknown
                                        </span>
                                    <?php endif; ?>
                                </div>
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
                            <a href="<?= ROOT ?>/PDC_admin/applications" class="btn btn-primary mt-2">
                                <i class="fas fa-arrow-left"></i> Back to Applications
                            </a>
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
                                <i class="fas 
                                    <?= 
                                    strtolower($application['status']) === 'active' ? 'fa-check-circle' : 
                                    (strtolower($application['status']) === 'deactive' ? 'fa-times-circle' : 
                                    (strtolower($application['status']) === 'reject' ? 'fa-ban' : 'fa-clock'))
                                    ?>" 
                                    style="font-size: 8px;">
                                </i>
                                <?= htmlspecialchars(ucfirst($application['status'])) ?>
                            </span>
                        </div>
                        
                        <!-- <div style="margin-bottom: 1.5rem;">
                            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem; color: var(--primary);">
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
                                <span class="tag" style="background: linear-gradient(135deg, #ecfdf5 0%, #a7f3d0 80%); color: #065f46;">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 0.25rem;"></i>
                                    <?= htmlspecialchars($application['location'] ?? 'Remote') ?>
                                </span>
                            </div>
                        </div> -->
                        
                        <div class="card-body">
                            <div class="detail-item" style="grid-column: 1 / -1;">
                                <div class="detail-label">Description</div>
                                <div class="detail-value" style="line-height: 1.6; padding: 0.75rem; background-color: #f8fafc; border-radius: var(--border-radius-sm);">
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
                                <div class="detail-value">
                                    <i class="far fa-calendar-alt" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= htmlspecialchars($application['startdate']) ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Application Deadline</div>
                                <div class="detail-value">
                                    <i class="far fa-clock" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= htmlspecialchars($application['deadline']) ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Location</div>
                                <div class="detail-value">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= htmlspecialchars($application['location'] ?? 'Remote') ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Advertisement ID</div>
                                <div class="detail-value"><?= htmlspecialchars($application['advertisementId']) ?></div>
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

                            <?php if($application['CompanyId'] != null):?>
                                <span class="status-badge" style="background-color: #e0f2fe; color: #0369a1;">
                                    <i class="fas fa-check-circle" style="font-size: 8px;"></i>
                                    Verified Partner
                                </span>
                            <?php else:?>
                                <span class="status-badge" style="background-color: #fef3c7; color: #92400e;">
                                    <i class="fas fa-clock" style="font-size: 8px;"></i>
                                    Not Verified
                                </span>
                            <?php endif;?>
                        </div>
                        
                        <div class="flex-row">
                            <div class="avatar" style="background: linear-gradient(135deg, #d1fae5 0%, #6ee7b7 100%); color: #065f46;">
                                <?= substr(htmlspecialchars($application['CompanyName']), 0, 1) ?>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #065f46;">
                                    <?= htmlspecialchars($application['CompanyName']) ?>
                                </h3>
                                <p style="color: var(--gray); font-size: 0.9rem;">
                                    <i class="fas fa-id-card"></i> ID: <?= htmlspecialchars($application['CompanyId']) ?>
                                </p>
                                <div style="display: flex; gap: 1rem; margin-top: 0.75rem;">
                                    <?php if (!empty($application['Website'])): ?>
                                        <a href="<?= htmlspecialchars($application['Website']) ?>" target="_blank" class="btn btn-icon btn-outline" style="font-size: 0.8rem;">
                                            <i class="fas fa-globe"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($application['Linkedin'])): ?>
                                        <a href="<?= htmlspecialchars($application['Linkedin']) ?>" target="_blank" class="btn btn-icon btn-outline" style="font-size: 0.8rem;">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    <?php endif; ?>
                                    <button class="btn btn-icon btn-outline" style="font-size: 0.8rem;">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="detail-item" style="grid-column: 1 / -1;">
                                <div class="detail-label">Company Description</div>
                                <div class="detail-value" style="line-height: 1.6; padding: 0.75rem; background-color: #f8fafc; border-radius: var(--border-radius-sm);">
                                    <?= nl2br(htmlspecialchars($application['ShortDesc'])) ?>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Industry</div>
                                <div class="detail-value"><?= htmlspecialchars($application['Industry'] ?? 'Not specified') ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Location</div>
                                <div class="detail-value">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= htmlspecialchars($application['Location'] ?? 'Not specified') ?>
                                </div>
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
                            <div class="detail-item">
                                <div class="detail-label">Contact Person</div>
                                <div class="detail-value"><?= htmlspecialchars($application['ContactPerson'] ?? 'Not specified') ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Contact Email</div>
                                <div class="detail-value">
                                    <?php if (!empty($application['ContactEmail'])): ?>
                                        <a href="mailto:<?= htmlspecialchars($application['ContactEmail']) ?>" style="color: var(--primary); text-decoration: none;">
                                            <?= htmlspecialchars($application['ContactEmail']) ?>
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
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <span class="status-badge" style="background-color: #f0fdf4; color: #065f46;">
                                    <i class="fas fa-circle" style="font-size: 8px;"></i>
                                    In Progress
                                </span>
                            </div>
                        </div>
                        
                        <div class="timeline">
                            <!-- Timeline items would normally be dynamic from database -->
                            <div class="timeline-item">
                                <div class="timeline-marker" style="background: linear-gradient(135deg, #d1fae5 0%, #6ee7b7 100%);"></div>
                                <div class="timeline-content">
                                    <div style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; color: #065f46;">Application Submitted</div>
                                    <div class="timeline-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?= date('F d, Y, h:i A', strtotime('-3 days')) ?>
                                    </div>
                                    <div style="font-size: 0.9rem; padding: 0.75rem; background-color: #f0fdf4; border-radius: var(--border-radius-sm); border-left: 3px solid #10b981;">
                                        Student <?= htmlspecialchars($application['StudentName']) ?> applied for the <?= htmlspecialchars($application['position']) ?> position.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker" style="background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);"></div>
                                <div class="timeline-content">
                                    <div style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; color: #1e40af;">Application Reviewed</div>
                                    <div class="timeline-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?= date('F d, Y, h:i A', strtotime('-2 days')) ?>
                                    </div>
                                    <div style="font-size: 0.9rem; padding: 0.75rem; background-color: #eff6ff; border-radius: var(--border-radius-sm); border-left: 3px solid #3b82f6;">
                                        Application was reviewed by the PDC team and marked as eligible.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker" style="background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%);"></div>
                                <div class="timeline-content">
                                    <div style="font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; color: #92400e;">Pending Company Review</div>
                                    <div class="timeline-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?= date('F d, Y, h:i A', strtotime('-1 day')) ?>
                                    </div>
                                    <div style="font-size: 0.9rem; padding: 0.75rem; background-color: #fefcbf; border-radius: var(--border-radius-sm); border-left: 3px solid #fbbf24;">
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

    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
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