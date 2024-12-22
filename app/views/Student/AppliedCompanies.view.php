<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applied Companies</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/appliedCompanies.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="side">
        <?php $this->renderComponent("studentSidebar")  ?>
    </div>
    <div class="content">
        <div class="header">
            <?php $this->renderComponent("studentHeader")  ?>
        </div>
        <div class="main-content">
            <div class="progress-report-table-div">
                <div class="progress-report-table-background">
                    <!-- Table -->
                    <div>
                        <table class="progress-report-table">
                            <thead class="progress-report-table-headings">
                                <tr>
                                    <th>
                                        <h5>Date</h5>
                                    </th>
                                    <th>
                                        <h5>Company Name</h5>
                                    </th>
                                    <th>
                                        <h5>Position</h5>
                                    </th>
                                    <th>
                                        <h5>Status</h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($data['student_applied_companies']) && !empty($data['student_applied_companies'])): ?>
                                    <?php
                                        foreach($data['student_applied_companies'] as $company){
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($company->date)?></td>
                                        <td><?php echo htmlspecialchars($company->Name)?></td>
                                        <td><?php echo htmlspecialchars($company->position)?></td>
                                        <td>
                                            <button class="<?php echo htmlspecialchars(strtolower($company->Jobstatus)); ?>" onclick="location.href='<?=ROOT?>/Student/StudentAppliedCompanies/ViewAppliedCompanies/<?php echo htmlspecialchars($company->advertisementId)?>';">
                                                <?php echo htmlspecialchars($company -> Jobstatus) ?>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">No applied companies found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
