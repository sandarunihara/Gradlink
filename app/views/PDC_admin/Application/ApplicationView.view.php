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
                <?php if (!empty($applicationData['application'])) : ?>
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-user-graduate"></i> Student Information</h2>
                            <span class="status-badge <?= strtolower($applicationData['application']->blockstd) === 1 ? 'status-blocked' : 'status-ongoing' ?>">
                                <i class="fas fa-circle" style="font-size: 8px;"></i>
                                <?= strtolower($applicationData['application']->blockstd) === 1 ? 'Blocked' : 'Ongoing' ?>
                            </span>
                        </div>
                        
                        <div class="flex-row">
                            <div class="avatar" style="background-image: url('<?= ROOT ?>/assets/img/Student/<?= htmlspecialchars($applicationData['application']->ProfilePic) ?>');">
                                <!-- <?= substr(htmlspecialchars($applicationData['application']->StudentName), 0, 1) ?> -->
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">
                                    <?= htmlspecialchars($applicationData['application']->StudentName) ?>
                                </h3>
                                <p style="color: var(--gray); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                    <i class="fas fa-id-card"></i> ID: <?= htmlspecialchars($applicationData['application']->StudentId) ?>
                                </p>
                                <div style="display: flex; gap: 1rem; margin-top: 0.75rem;">
                                    <a href="mailto:<?= htmlspecialchars($applicationData['application']->Email) ?>" class="btn btn-icon btn-outline" style="font-size: 0.8rem;">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="tel:<?= htmlspecialchars($applicationData['application']->ContactNum) ?>" class="btn btn-icon btn-outline" style="font-size: 0.8rem;">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="detail-item">
                                <div class="detail-label">Email Address</div>
                                <div class="detail-value">
                                    <a href="mailto:<?= htmlspecialchars($applicationData['application']->StudentEmail) ?>" style="color: var(--primary); text-decoration: none;">
                                        <?= htmlspecialchars($applicationData['application']->StudentEmail) ?>
                                    </a>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Contact Number</div>
                                <div class="detail-value">
                                    <a href="tel:<?= htmlspecialchars($applicationData['application']->ContactNum) ?>" style="color: var(--primary); text-decoration: none;">
                                        <?= htmlspecialchars($applicationData['application']->ContactNum) ?>
                                    </a>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Degree Program</div>
                                <div class="detail-value"><?= htmlspecialchars($applicationData['application']->DegreeName) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Application Date</div>
                                <div class="detail-value">
                                    <i class="far fa-calendar-alt" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= date('F d, Y', strtotime($applicationData['application']->ApplicationDate ?? 'now')) ?>
                                </div>
                            </div>

                            <div class="detail-item">
                                    <?php if($applicationData['application']->Jobstatus == 'Recruit'): ?>
                                        <div class="detail-item">
                                            <div class="detail-label">Progress Reports</div>
                                            <div class="detail-value">
                                                <?php if(!empty($applicationData['progressData'])): ?>
                                                    <div class="document-list-container"> <!-- Added container for scrollable area -->
                                                        <div class="document-list">
                                                            <?php foreach($applicationData['progressData'] as $report): ?>
                                                                <?php if($report->Status == 'Approved'): ?>
                                                                    <div class="document-item">
                                                                        <div class="document-info">
                                                                            <i class="fas fa-file-pdf"></i>
                                                                            <span class="document-name"><?= htmlspecialchars(pathinfo($report->Name, PATHINFO_FILENAME)) ?>.pdf</span>
                                                                            <span class="document-date">Submitted: <?= date('M d, Y', strtotime($report->SubmissionDate)) ?></span>
                                                                        </div>
                                                                        <div class="document-actions">
                                                                            <a href="<?= ROOT ?>/<?= htmlspecialchars($report->file_path) ?>" 
                                                                            target="_blank" 
                                                                            class="btn btn-icon btn-outline btn-sm"
                                                                            title="View">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a>
                                                                            <!-- <a href="<?= ROOT ?>/<?= htmlspecialchars($report->file_path) ?>" 
                                                                            download 
                                                                            class="btn btn-icon btn-outline btn-sm"
                                                                            title="Download">
                                                                                <i class="fas fa-download"></i>
                                                                            </a> -->
                                                                        </div>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <p class="no-documents">progress reports not approved yet</p>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="no-documents">No progress reports submitted yet</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="detail-item">
                                            <div class="detail-label">CV</div>
                                            <div class="detail-value">
                                                <?php if($applicationData['application']->CV != null): ?>
                                                    <div class="document-item">
                                                        <div class="document-info">
                                                            <i class="fas fa-file-pdf"></i>
                                                            <span class="document-name">Student_CV.pdf</span>
                                                            <!-- <span class="document-status status-approved">
                                                                <i class="fas fa-check-circle"></i>
                                                                Submitted
                                                            </span> -->
                                                        </div>
                                                        <div class="document-actions">
                                                            <a href="<?= ROOT ?>/<?= htmlspecialchars($applicationData['application']->CV) ?>" 
                                                            target="_blank" 
                                                            class="btn btn-icon btn-outline btn-sm"
                                                            title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <!-- <a href="<?= ROOT ?>/<?= htmlspecialchars($applicationData['application']->CV) ?>" 
                                                            download 
                                                            class="btn btn-icon btn-outline btn-sm"
                                                            title="Download">
                                                                <i class="fas fa-download"></i>
                                                            </a> -->
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="no-documents">No CV submitted yet</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            

                            <div class="detail-item">
                                <div class="detail-label">Company Response</div>
                                <div class="detail-value">
                                    <?php if ($applicationData['application']->Jobstatus === 'Pending'): ?>
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock" style="font-size: 8px;"></i>
                                            Pending
                                        </span>
                                    <?php elseif ($applicationData['application']->Jobstatus === 'Reject'): ?>
                                        <span class="status-badge status-rejected">
                                            <i class="fas fa-times-circle" style="font-size: 8px;"></i>
                                            Rejected
                                        </span>
                                    <?php elseif ($applicationData['application']->Jobstatus === 'Shortlist'): ?>
                                        <span class="status-badge" style="background-color: #dbeafe; color: #1e40af;">
                                            <i class="fas fa-list" style="font-size: 8px;"></i>
                                            Shortlisted
                                        </span>
                                    <?php elseif ($applicationData['application']->Jobstatus === 'Recruit'): ?>
                                        <span class="status-badge status-approved">
                                            <i class="fas fa-check-circle" style="font-size: 8px;"></i>
                                            Recruited
                                        </span>

                                    <?php elseif ($applicationData['application']->Jobstatus === 'Accept'):?>
                                        <span class="status-badge status-approved">
                                            <i class="fas fa-check-circle" style="font-size: 8px;"></i>
                                            Accepted
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
                            <a href="<?= ROOT ?>/PDC_admin/ViewStudent/show/<?= $applicationData['application']->StudentId ?>" class="btn btn-primary">
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
                <?php if (!empty($applicationData['application'])) : ?>
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-clipboard-list"></i> Advertisement Details</h2>
                            <span class="status-badge status-<?= strtolower($application['advStatus']) ?>">
                                <i class="fas 
                                    <?= 
                                    strtolower($applicationData['application']->status) === 'active' ? 'fa-check-circle' : 
                                    (strtolower($applicationData['application']->status) === 'deactive' ? 'fa-times-circle' : 
                                    (strtolower($applicationData['application']->status) === 'reject' ? 'fa-ban' : 'fa-clock'))
                                    ?>" 
                                    style="font-size: 8px;">
                                </i>
                                <?= htmlspecialchars(ucfirst($applicationData['application']->advStatus)) ?>
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
                                <div class="detail-value"><?= htmlspecialchars($applicationData['application']->position) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Number of Interns</div>
                                <div class="detail-value"><?= htmlspecialchars($applicationData['application']->numOfInterns) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Start Date</div>
                                <div class="detail-value">
                                    <i class="far fa-calendar-alt" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= htmlspecialchars($applicationData['application']->startdate) ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Application Deadline</div>
                                <div class="detail-value">
                                    <i class="far fa-clock" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= htmlspecialchars($applicationData['application']->deadline) ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Location</div>
                                <div class="detail-value">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= htmlspecialchars($applicationData['application']->location ?? 'Remote') ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Advertisement ID</div>
                                <div class="detail-value"><?= htmlspecialchars($applicationData['application']->advertisementId) ?></div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <a href="<?= ROOT ?>/PDC_admin/ViewAdvertisement/show/<?= $applicationData['application']->advertisementId ?>" class="btn btn-primary">
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
                <?php if (!empty($applicationData['application'])) : ?>
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-building"></i> Company Information</h2>

                            <?php if($applicationData['application']->CompanyId != null):?>
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
                            <div class="avatar" style="background-image: url('<?= ROOT ?>/assets/img/Company/<?= htmlspecialchars($applicationData['application']->profileimg) ?>')">
                                <!-- <?= substr(htmlspecialchars($applicationData['application']->CompanyName), 0, 1) ?> -->
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #065f46;">
                                    <?= htmlspecialchars($applicationData['application']->CompanyName) ?>
                                </h3>
                                <p style="color: var(--gray); font-size: 0.9rem;">
                                    <i class="fas fa-id-card"></i> ID: <?= htmlspecialchars($applicationData['application']->CompanyId) ?>
                                </p>
                                <div style="display: flex; gap: 1rem; margin-top: 0.75rem;">
                                    <?php if (!empty($applicationData['application']->Website)): ?>
                                        <a href="<?= htmlspecialchars($applicationData['application']->Website) ?>" target="_blank" class="btn btn-icon btn-outline" style="font-size: 0.8rem;">
                                            <i class="fas fa-globe"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($applicationData['application']->Linkedin)): ?>
                                        <a href="<?= htmlspecialchars($applicationData['application']->Linkedin) ?>" target="_blank" class="btn btn-icon btn-outline" style="font-size: 0.8rem;">
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
                                    <?= nl2br(htmlspecialchars($applicationData['application']->ShortDesc)) ?>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Industry</div>
                                <div class="detail-value"><?= htmlspecialchars($applicationData['application']->Industry ?? 'Not specified') ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Location</div>
                                <div class="detail-value">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem; color: var(--gray);"></i>
                                    <?= htmlspecialchars($applicationData['application']->Location ?? 'Not specified') ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Website</div>
                                <div class="detail-value">
                                    <?php if (!empty($applicationData['application']->Website)): ?>
                                        <a href="<?= htmlspecialchars($applicationData['application']->Website) ?>" target="_blank" style="color: var(--primary); text-decoration: none;">
                                            <?= htmlspecialchars($applicationData['application']->Website) ?>
                                            <i class="fas fa-external-link-alt" style="font-size: 0.75rem; margin-left: 0.25rem;"></i>
                                        </a>
                                    <?php else: ?>
                                        Not specified
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Contact Person</div>
                                <div class="detail-value"><?= htmlspecialchars($applicationData['application']->ContactPerson ?? 'Not specified') ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Company Email</div>
                                <div class="detail-value">
                                    <?php if (!empty($applicationData['application']->Email)): ?>
                                        <a href="mailto:<?= htmlspecialchars($applicationData['application']->Email) ?>" style="color: var(--primary); text-decoration: none;">
                                            <?= htmlspecialchars($applicationData['application']->Email) ?>
                                        </a>
                                    <?php else: ?>
                                        Not specified
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <?php if (!empty($applicationData['application']->Linkedin)): ?>
                                <a href="<?= $applicationData['application']->Linkedin ?>" target="_blank" class="btn btn-outline">
                                    <i class="fab fa-linkedin"></i> LinkedIn Profile
                                </a>
                            <?php endif; ?>
                            <a href="<?= ROOT ?>/PDC_admin/ViewCompany/show/<?= $applicationData['application']->CompanyId ?>" class="btn btn-primary">
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
                <?php if (!empty($applicationData['actionData'])): ?>
                    <div class="timeline-container">
                        <h1 class="timeline-title">Advertisement Application Timeline</h1>
                        
                        <div class="timeline">
                            <?php 

                            $actionOrder = [
                                'activate' => 1,
                                'deactivate' => 2,
                                'applied' => 3,
                                'interview_requested' => 4,
                                'interview_completed' => 5,
                                'accepted' => 6,
                                'rejected' => 6,
                                'offer_accepted' => 7,
                                'offer_rejected' => 7
                            ];
                            
                            usort($applicationData['actionData'], function($a, $b) use ($actionOrder) {
                                $timeCompare = strtotime($a->timestamp) - strtotime($b->timestamp);
                                if ($timeCompare === 0) {
                                    $aOrder = $actionOrder[$a->action_type] ?? 999;
                                    $bOrder = $actionOrder[$b->action_type] ?? 999;
                                    return $aOrder - $bOrder;
                                }
                                return $timeCompare;
                            });
                            
                            foreach ($applicationData['actionData'] as $action): 

                                switch ($action->action_type) {
                                    case 'activate':
                                        $statusClass = 'active admin';
                                        $statusText = 'Active';
                                        break;
                                    case 'deactivate':
                                        $statusClass = 'rejected admin';
                                        $statusText = 'Deactivated';
                                        break;
                                    case 'applied':
                                        $statusClass = 'active';
                                        $statusText = 'Pending';
                                        break;
                                    case 'interview_requested':
                                        $statusClass = 'pending';
                                        $statusText = 'Pending';
                                        break;
                                    case 'interview_completed':
                                        $statusClass = 'pending';
                                        $statusText = 'Pending Review';
                                        break;
                                    case 'accepted':
                                        $statusClass = 'pending';
                                        $statusText = 'Waiting Student Response';
                                        break;
                                    case 'rejected':
                                        $statusClass = 'rejected';
                                        $statusText = 'Rejected';
                                        break;
                                    case 'offer_accepted':
                                        $statusClass = 'completed';
                                        $statusText = 'Completed';
                                        break;
                                    case 'offer_rejected':
                                        $statusClass = 'rejected';
                                        $statusText = 'Rejected';
                                        break;
                                    default:
                                        $statusClass = '';
                                        $statusText = ucfirst($action->action_type);
                                }
                                
                                $roleClass = 'role-' . $action->actor_role;
                                
                                $actionDescription = '';
                                switch ($action->action_type) {
                                    case 'activate':
                                        $actionDescription = 'The advertisement was activated and made available to students.';
                                        break;
                                    case 'deactivate':
                                        $actionDescription = 'The advertisement was deactivated by an administrator.';
                                        break;
                                    case 'applied':
                                        $actionDescription = 'Student ' . $action->actor_id . ' applied for this advertisement.';
                                        break;
                                    case 'interview_requested':
                                        $actionDescription = 'The company has requested the student to attend an interview.';
                                        break;
                                    case 'interview_completed':
                                        $actionDescription = 'The interview was successfully completed. Waiting for company\'s final decision.';
                                        break;
                                    case 'accepted':
                                        $actionDescription = 'The company has accepted the student\'s application after the interview.';
                                        break;
                                    case 'rejected':
                                        $actionDescription = 'The company has rejected the student\'s application after the interview.';
                                        break;
                                    case 'offer_accepted':
                                        $actionDescription = 'The student has accepted the company\'s offer and confirmed participation.';
                                        break;
                                    case 'offer_rejected':
                                        $actionDescription = 'The student has rejected the company\'s offer.';
                                        break;
                                    default:
                                        $actionDescription = ucfirst($action->action_type) . ' action performed.';
                                }
                                
                                // Format the action type for display
                                $displayAction = str_replace('_', ' ', $action->action_type);
                                $displayAction = ucwords($displayAction);
                            ?>
                            <div class="timeline-item <?= $statusClass ?>">
                                <div class="timeline-header">
                                    <span class="timeline-action"><?= $displayAction ?>
                                        <?php if (!empty($statusText)): ?>
                                            <span class="status-badge status-<?= explode(' ', $statusClass)[0] ?>"><?= $statusText ?></span>
                                        <?php endif; ?>
                                    </span>
                                    <span class="timeline-role <?= $roleClass ?>"><?= ucfirst($action->actor_role) ?></span>
                                </div>
                                <div class="timeline-content">
                                    <?= $actionDescription ?>
                                </div>
                                <?php if (!empty($action->reason)): ?>
                                    <div class="reason"><?= htmlspecialchars($action->reason) ?></div>
                                <?php endif; ?>
                                <div class="timeline-meta">
                                    <span class="timeline-date"><?= $action->timestamp ?></span>
                                    <span class="timeline-target"><?= ucfirst($action->target_type) ?> #<?= $action->target_id ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
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