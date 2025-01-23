<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/viewCompany.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">

</head>

<body>

    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        <main class="content">
            <header class="header">
            <div class="student-title">
                    <h1><?= htmlspecialchars($companyData->Name) ?></h1>
                </div>
            </header>
            <section class="company-info">
                <form class="company-form" id="student-form" method='POST' action="<?= ROOT ?>/PDC_admin/ViewStudent/edit/<?= $companyData->CompanyId ?>">
                <div class="form-group">
                    <label for="company-id">Company Id</label>
                    <input type="text" id="company-id" name="CompanyId" value="<?= htmlspecialchars($companyData->CompanyId) ?>" readonly>
                    <?php if (!empty($errors['CompanyId'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['CompanyId']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="company-name">Company Name</label>
                    <input type="text" id="company-name" name="Name" value="<?= htmlspecialchars($companyData->Name) ?>" readonly>
                    <?php if (!empty($errors['Name'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Name']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="contact-person">Contact Person</label>
                    <input type="text" id="contact-person" name="ContactPerson" value="<?= htmlspecialchars($companyData->ContactPerson) ?>" readonly>
                    <?php if (!empty($errors['ContactPerson'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['ContactPerson']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="company-desc">Description</label>
                    <input type="text" id="company-desc" name="ShortDesc" value="<?= htmlspecialchars($companyData->ShortDesc) ?>" readonly>
                    <?php if (!empty($errors['ShortDesc'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['ShortDesc']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="company-No">Address:(No)</label>
                    <input type="text" id="company-No" name="No" value="<?= htmlspecialchars($companyData->No) ?>" readonly>
                    <?php if (!empty($errors['No'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['No']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="company-Lane">Address:(Lane)</label>
                    <input type="text" id="company-Lane" name="Lane" value="<?= htmlspecialchars($companyData->Lane) ?>" readonly>
                    <?php if (!empty($errors['Lane'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Lane']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="company-City">Address:(City)</label>
                    <input type="text" id="company-City" name="City" value="<?= htmlspecialchars($companyData->City) ?>" readonly>
                    <?php if (!empty($errors['City'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['City']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="company-District">Address:(District)</label>
                    <input type="text" id="company-District" name="District" value="<?= htmlspecialchars($companyData->District) ?>" readonly>
                    <?php if (!empty($errors['District'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['District']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="company-email">Email</label>
                    <input type="text" id="company-email" name="Email" value="<?= htmlspecialchars($companyData->Email) ?>" readonly>
                    <?php if (!empty($errors['Email'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Email']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="company-contact">Contact Number</label>
                    <input type="text" id="company-contact" name="ContactNum" value="<?= htmlspecialchars($companyData->ContactNum) ?>" readonly>
                    <?php if (!empty($errors['ContactNum'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['ContactNum']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="company-website">Website Link</label>
                    <input type="text" id="company-website" name="Website" value="<?= htmlspecialchars($companyData->Website) ?>" readonly>
                    <?php if (!empty($errors['Website'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Website']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="company-Linkedin">Linkedin</label>
                    <input type="text" id="company-Linkedin" name="Linkedin" value="<?= htmlspecialchars($companyData->Linkedin) ?>" readonly>
                    <?php if (!empty($errors['Linkedin'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Linkedin']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="company-Status">Status</label>
                    <input type="text" id="company-Status" name="Status" value="<?= htmlspecialchars($companyData->Status) ?>" readonly>
                    <?php if (!empty($errors['Status'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Status']) ?></span>
                    <?php endif; ?>
                </div>

                </form>
                        
                        <div class="button-line">
                            <div class="action-buttons">
                                <button class="btn back-btn" id="back-btn-student" onclick="history.back()">Back</button>
                                <?php if ($companyData->Status === 'Blocked'): ?>
                                    <button class="btn unblock-btn" onclick="unblockCompany('<?= htmlspecialchars($companyData->CompanyId) ?>')">Unblock</button>
                                <?php else: ?>
                                    <button class="btn block-btn" onclick="blockCompany('<?= htmlspecialchars($companyData->CompanyId) ?>')">Block</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    
                
            </section>
        </main>
    </div>

    <div id="block-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3>Block Company</h3>
            <p>Please provide a reason for blocking the company. This message will be sent to the company's email.</p>
            <textarea id="block-reason" rows="5" placeholder="Enter your reason here..."></textarea>
            <div class="modal-buttons">
                <button class="btn-primary" onclick="submitBlockReason('<?= htmlspecialchars($companyData->CompanyId) ?>')">Submit</button>
                <button class="btn-secondary" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js?v=<?= time() ?>"></script>

</body>

</html>