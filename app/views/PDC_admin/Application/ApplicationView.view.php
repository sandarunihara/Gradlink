<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Overview | PDC Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/application/viewApplication.css?v=<?= time() ?>">
    
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