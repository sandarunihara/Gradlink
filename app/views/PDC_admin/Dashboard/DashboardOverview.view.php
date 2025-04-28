<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | PDC</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/dashboard/overviewDashboard.css">

</head>
<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar")  ?>

        <main class="main-content">
            <!-- Header Section -->
            <header class="dashboard-header">
                <div class="header-content">
                    <div class="header-text">
                        <h1>Dashboard Overview</h1>
                    </div>
                    
                    <div class="header-actions">
                        <div class="notification-wrapper">
                            <!-- <button class="notification-btn">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge"></span>
                            </button> -->
                            
                            <div class="notification-dropdown">

                                <?php if(($data['adNotifications'] ?? 0) == 0 && ($data['pdcNotifications'] ?? 0) == 0):?>
                                    <div class="notification-item">
                                        <span>No requests</span>
                                    </div>

                                <?php else:?>

                                    <div class="notification-item" id='adv-item'>
                                        <i class="fas fa-ad"></i> 
                                        <span>Deactivation requests</span>
                                        <span class="count-badge" id='adv-req'></span>
                                    </div>

                                    <div class="notification-item" id='pdc-item'>
                                        <i class="fas fa-user-tie"></i> 
                                        <span>PDC Cordinator requests</span>
                                        <span class="count-badge" id='pdc-req'></span>
                                    </div>

                                <?php endif;?>

                            </div>
                        </div>

                        <div class="round-indicator">
                            <div class="round-badge">
                                <span><?= htmlspecialchars($data['round']->round ?? 'N/A') ?></span>
                                <div class="round-tooltip">
                                    <div class="progress-container">
                                        <div class="progress-labels">
                                            <span><?= isset($data['round']->startDate) ? date('M d, Y', strtotime($data['round']->startDate)) : 'N/A' ?></span>
                                            <span><?= isset($data['round']->endDate) ? date('M d, Y', strtotime($data['round']->endDate)) : 'N/A' ?></span>       
                                        </div>
                                        <div class="progress-bar">
                                            <?php
                                            $percentage = 0;
                                            $daysRemaining = 0;
                                            
                                            if (isset($data['round']->startDate) && isset($data['round']->endDate)) {
                                                $startTime = strtotime($data['round']->startDate);
                                                $endTime = strtotime($data['round']->endDate);
                                                $now = time();

                                                if ($startTime && $endTime && $endTime > $startTime) {
                                                    $totalDuration = $endTime - $startTime;
                                                    $elapsed = $now - $startTime;
                                                    $remaining = $endTime - $now;
                                                    
                                                    $percentage = min(100, max(0, ($elapsed / $totalDuration) * 100));
                                                    $percentage = round($percentage);
                                                    
                                                    $daysRemaining = max(0, floor($remaining / (60 * 60 * 24)));
                                                }
                                            }
                                            ?>

                                            <div class="progress-fill" style="width: <?= $percentage ?>%"></div>
                                            <div class="progress-marker" style="left: <?= $percentage ?>%"></div>
                                        </div>
                                        <p><?= $percentage ?>% completed</p>
                                        <p class="days-remaining"><?= $daysRemaining ?> days remaining</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Key Metrics Section -->
            <section class="metrics-section">
                <div class="section-header">
                    <h2>Key Performance Indicators</h2>
                    <p class="section-subtitle">Current placement round statistics</p>
                </div>
                
                <div class="metrics-grid">
                    <div class="metric-card" id="std">
                        <div class="metric-icon student">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="metric-content">
                            <h3>Registered Students</h3>
                            <div class="metric-value"><?= $data['cards']['registeredStdCount'] ?? 0 ?></div>
                            <!-- <div class="progress-container">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= ($data['importcount']->total ?? 0) > 0 ? round(($data['cards']['registeredStdCount'] ?? 0) / $data['importcount']->total * 100) : 0 ?>%"></div>
                                </div>
                                <div class="progress-label"><?= ($data['importcount']->total ?? 0) > 0 ? round(($data['cards']['registeredStdCount'] ?? 0) / $data['importcount']->total * 100) : 0 ?>%</div>
                            </div> -->
                        </div>
                    </div>
                    
                    <div class="metric-card" id="com">
                        <div class="metric-icon company">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="metric-content">
                            <h3>Registered Companies</h3>
                            <div class="metric-value"><?= $data['cards']['registeredCompCount'] ?? 0 ?></div>
                            <div class="progress-container">
                                <!-- Progress bar removed as it was commented out -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="metric-card" id="working">
                        <div class="metric-icon placement">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="metric-content">
                            <h3>Placements</h3>
                            <div class="metric-value"><?= $data['cards']['workingStdCount'] ?? 0 ?></div>
                            <!-- <div class="progress-container">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= ($data['importcount']->total ?? 0) > 0 ? round(($data['cards']['workingStdCount'] ?? 0) / $data['importcount']->total * 100) : 0 ?>%"></div>
                                </div>
                                <div class="progress-label"><?= ($data['importcount']->total ?? 0) > 0 ? round(($data['cards']['workingStdCount'] ?? 0) / $data['importcount']->total * 100) : 0 ?>% placement rate</div>
                            </div> -->
                        </div>
                    </div>
                    
                    <div class="metric-card" id="adv">
                        <div class="metric-icon ad">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <div class="metric-content">
                            <h3>Active Ads</h3>
                            <div class="metric-value"><?= $data['activeAds'] ?? 0 ?></div>
                            <!-- Progress bar removed as it was commented out -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dashboard Content Grid -->
            <div class="dashboard-grid">
                <!-- Quick Actions Panel -->
                <div class="quick-actions-panel">
                    <div class="panel-header">
                        <h3>Quick Actions</h3>
                        <p>Frequently used tasks</p>
                    </div>
                    <div class="actions-grid">
    
                    <a href="<?=ROOT?>/PDC_admin/PendingCompany/dashboard" class="action-card">
                        <div class="action-icon company">
                            <i class="fas fa-building"></i>
                            <span class="badge com"></span>
                        </div>
                        <span>Company Approvals</span>
                    </a>
                    <a href="<?=ROOT?>/PDC_admin/PendingAdvertisement/dashboard" class="action-card">
                        <div class="action-icon ad">
                            <i class="fas fa-ad"></i>
                            <span class="badge ad"></span>
                        </div>
                        <span>Ad Approvals</span>
                    </a>
                        <a href="<?=ROOT?>/PDC_admin/AdminProfileOverview/dashboard" class="action-card">
                            <div class="action-icon settings">
                                <i class="fas fa-cog"></i>
                            </div>
                            <span>Profile</span>
                        </a>
                    </div>
                </div>

                <!-- Round Timeline -->
                <div class="timeline-panel">
                    <div class="panel-header">
                        <h3>Round Timeline</h3>
                        <div class="time-remaining">
                            <i class="fas fa-clock"></i>
                            <span><?= $daysRemaining ?> days remaining</span>
                        </div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?= $percentage ?>%"></div>
                                <div class="progress-marker" style="left: <?= $percentage ?>%">
                                    <div class="marker-tooltip">Today</div>
                                </div>
                            </div>
                            <div class="progress-labels">
                                <span><?= isset($data['round']->startDate) ? date('M d, Y', strtotime($data['round']->startDate)) : 'N/A' ?></span>
                                <span><?= isset($data['round']->endDate) ? date('M d, Y', strtotime($data['round']->endDate)) : 'N/A' ?></span>       
                            </div>
                        </div>
                        <div class="milestones">
                            <div class="milestone completed">
                                <div class="milestone-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="milestone-details">
                                    <h4>Round Started</h4>
                                    <p><?= isset($data['round']->startDate) ? date('M d, Y', strtotime($data['round']->startDate)) : 'N/A' ?></p>
                                </div>
                            </div>
                            <div class="milestone">
                                <div class="milestone-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="milestone-details">
                                    <h4>Round Ends</h4>
                                    <p><?= isset($data['round']->endDate) ? date('M d, Y', strtotime($data['round']->endDate)) : 'N/A' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <section class="activity-section">
                <div class="section-header">
                    
                </div>
                
                <div class="activity-content">
                    <div class="data-table">
                        <div class="table-header">
                            <h3>Recent Advertisements</h3>
                            <a href="<?=ROOT?>/PDC_admin/AdminAdvertisementOverview/dashboard" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company</th>
                                        <th>Position</th>
                                        <th>Deadline</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach(($data['table'] ?? []) as $advs):?>

                                        <tr>
                                            <td># <?= $advs['advertisementId'] ?? 'N/A' ?></td>
                                            <td>
                                                <div class="company-cell">
                                                    <img src="<?=ROOT?>/assets/img/Company/<?= htmlspecialchars($advs['profileimg'])?>" alt="Company Logo">
                                                    <?= $advs['companyName'] ?? 'N/A' ?>
                                                </div>
                                            </td>
                                            <td><?= $advs['position'] ?? 'N/A' ?></td>
                                            <td><?= $advs['deadline'] ?? 'N/A' ?></td>
                                            <td><span class="status-badge fulltime"><?= $advs['workingMode'] ?? 'N/A' ?></span></td>
                                            <td>
                                                <a href="<?=ROOT?>/PDC_admin/ViewAdvertisement/show/<?= $advs['advertisementId'] ?? '' ?>" class="action-btn">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    
                                    <?php endforeach;?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="top-companies">
                        <div class="panel-header">
                            <h3>Top Hiring Companies</h3>
                            <a href="<?=ROOT?>/PDC_admin/AdminCompanyOverview/dashboard" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="companies-list">

                            <?php foreach(($data['company'] ?? []) as $company):?>

                                <div class="company-card">
                                    <img src="<?=ROOT?>/assets/img/Company/<?= htmlspecialchars($company['profileimg'])?>" alt="Company Logo">
                                    <div class="company-details">
                                        <h4><?= htmlspecialchars($company['companyName'] ?? 'N/A') ?></h4>
                                        <div class="stats">
                                            <span class="email"><i class="fas fa-envelope"></i><?= htmlspecialchars($company['email'] ?? 'N/A') ?></span>
                                        </div>
                                    </div>
                                    <a href="<?=ROOT?>/PDC_admin/ViewCompany/show/<?= $company['CompanyId'] ?? '' ?>" class="view-btn" aria-label="View company details">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>

                            <?php endforeach;?>

                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const notificationBtn = document.querySelector('.notification-btn');
            const notificationDropdown = document.querySelector('.notification-dropdown');
            const notificationDot = document.querySelector('.notification-badge');
            const advReq = document.getElementById('adv-req');
            const pdcReq = document.getElementById('pdc-req');
            const advItem = document.getElementById('adv-item');
            const pdcItem = document.getElementById('pdc-item');
            const roundBadge = document.querySelector('.round-badge');
            const roundTooltip = document.querySelector('.round-tooltip');
            const comBadge = document.querySelector('.badge.com');
            const adBadge = document.querySelector('.badge.ad');

            const allNotifications = Number('<?= $data['allNotifications'] ?? 0 ?>');
            const adNotifications = Number('<?= $data['adNotifications'] ?? 0 ?>');
            const pdcNotifications = Number('<?= $data['pdcNotifications'] ?? 0 ?>');
            const pendingComCount = Number('<?= $data['pendingCom'] ?? 0 ?>');
            const pendingAds = Number('<?= $data['pendingAds'] ?? 0 ?>');

            if (allNotifications <= 0) {
                notificationDot.style.display = 'none';
            }

            if (adNotifications > 0) {
                advReq.style.display = 'block';
                advReq.textContent = adNotifications;
                advItem.style.display = 'flex';
            } else {
                advItem.style.display = 'none';
            }

            if (pdcNotifications > 0) {
                pdcReq.style.display = 'block';
                pdcReq.textContent = pdcNotifications;
                pdcItem.style.display = 'flex';
            } else {
                pdcItem.style.display = 'none';
            }

            notificationBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                notificationDropdown.classList.toggle('active');
            });

            document.addEventListener('click', function () {
                notificationDropdown.classList.remove('active');
            });

            advItem?.addEventListener('click', () => {
                window.location.href = "<?=ROOT?>/PDC_admin/AdminNotificationOverview/dashboard";
            });

            pdcItem?.addEventListener('click', () => {
                window.location.href = "<?=ROOT?>/PDC_admin/AdminNotificationOverview/dashboard";
            });

            roundBadge.addEventListener('mouseenter', () => {
                roundTooltip.classList.add('visible');
            });

            roundBadge.addEventListener('mouseleave', () => {
                roundTooltip.classList.remove('visible');
            });

            document.querySelectorAll('.tab-btn').forEach(button => {
                button.addEventListener('click', function () {
                    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            updateBadge(comBadge, pendingComCount);
            updateBadge(adBadge, pendingAds);

            function updateBadge(badgeElement, count) {
                if (count > 0) {
                    badgeElement.style.display = 'flex';
                    badgeElement.textContent = count;
                } else {
                    badgeElement.style.display = 'none';
                }
            }

            const student = document.getElementById('std');
            const company = document.getElementById('com');
            const working = document.getElementById('working');
            const adv = document.getElementById('adv');

            student.addEventListener('click' , ()=>{
                window.location.href = "<?=ROOT?>/PDC_admin/AdminStudentOverview/dashboard"
            })

            company.addEventListener('click' , ()=>{
                window.location.href = "<?=ROOT?>/PDC_admin/AdminCompanyOverview/dashboard"
            })

            working.addEventListener('click' , ()=>{
                window.location.href = "<?=ROOT?>/PDC_admin/AdminApplicationOverview/working"
            })

            adv.addEventListener('click' , ()=>{
                window.location.href = "<?=ROOT?>/PDC_admin/AdminAdvertisementOverview/dashboard"
            })

        });
    </script>

</body>
</html>