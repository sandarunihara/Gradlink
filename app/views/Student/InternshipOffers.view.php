<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applied Companies</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/InternshipOffers.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/InternshipConferm.css"> 
    <script src="<?php echo ROOT ?>/assets/js/student/toast.js"></script> 
</head>
<body>
    <?php $this->renderComponent("studentHeader", ["title" => "Internship Offers"]) ?>
    <?php $this->renderComponent("studentSidebar") ?>
    <div class="main-content">
        <div class="progress-report-table-container">
            <div class="progress-report-table-wrapper">
                <table class="progress-report-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Company Name</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data['student_applied_companies']) && !empty($data['student_applied_companies'])): ?>
                            <?php foreach($data['student_applied_companies'] as $index => $company): ?>
                                <tr>
                                    <td data-label="Date"><?php echo htmlspecialchars($company->date)?></td>
                                    <td data-label="Company Name"><?php echo htmlspecialchars($company->Name)?></td>
                                    <td data-label="Position"><?php echo htmlspecialchars($company->position)?></td>
                                    <td data-label="Status">
                                        <span class="status-badge pending">Pending</span>
                                    </td>
                                    <td data-label="Actions" class="actions-cell">
                                        <div class="action-buttons">
                                            <a href="<?=ROOT?>/Student/StudentAppliedCompanies/ViewAppliedCompanies/<?php echo htmlspecialchars($company->advertisementId)?>" class="btn view-btn">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <button class="btn accept-btn" aria-label="Accept offer" id="acceptBtn_<?= $index ?>">
                                                <i class="fas fa-check"></i> Accept
                                            </button>
                                            <button class="btn reject-btn" aria-label="Reject offer" id="rejectBtn_<?= $index ?>">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <?php 
                                    // Accept Modal
                                    $this->renderComponent("studentInternshipConferm", [
                                        "url" => ROOT . "/Student/StudentAppliedCompanies/studentReply?advertisementId=" . $company->advertisementId . "&response=accept",
                                        "button" => "acceptBtn_" . $index,
                                        "modalId" => "acceptModal_" . $index,
                                        "message" => "Do you want to accept this offer?",
                                        "id" => 1
                                    ]); 

                                    // Reject Modal
                                    $this->renderComponent("studentInternshipConferm", [
                                        "url" => ROOT . "/Student/StudentAppliedCompanies/studentReply?advertisementId=" . $company->advertisementId . "&response=reject",
                                        "button" => "rejectBtn_" . $index,
                                        "modalId" => "rejectModal_" . $index,
                                        "message" => "Do you want to reject this offer?",
                                        "warning" => "Your all other applications will be rejected.",
                                        "id" => 2
                                    ]); 
                                ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="no-data">No intenship offers found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

