<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Company</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/viewPendingCompany.css">
</head>

<body>
    <div class="container">
    <?php $this->renderComponent("coordinatorDashboard")  ?>

        <main class="content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Companies</h1>
                </div>

                <div class="header-right">
                    <i class="material-icons">notifications</i>
                    <img src="<?= ROOT ?>/assets/images/profile_img.jpg" alt="">

                    <div class="user-info">
                        <span>Jonitha Cathrine</span>
                        <small>Admin</small>
                    </div>
                </div>
            </header>

            <?php $this->renderComponent("companyTabs") ?>

            <section class="company-info">
            <?php if (!empty($companyData)): ?>
                <form class="company-form" id="companyForm" method="POST" action="<?= ROOT ?>/PDC_coordinator/viewPendingCompany/edit/<?= htmlspecialchars($companyData[0]['company_id']) ?>">
                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <input type="text" id="company-name" name="company_name" value="<?= htmlspecialchars($companyData[0]['company_name'] ?? '') ?>"  readonly>
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" name="email" value="<?= htmlspecialchars($companyData[0]['email'] ?? '') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="contact-person">Contact Person</label>
                        <input type="text" id="contact-person" name="contact_person" value="<?= htmlspecialchars($companyData[0]['contact_person'] ?? '') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact_number" value="<?= htmlspecialchars($companyData[0]['contact_number'] ?? '') ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="button">
                    <button class="btn update-btn" id="save-btn" type="submit" style="display: none;">Update</button>
                    </label>    
                </div>

                </form>
                <?php else: ?>
                    <p>No company data available.</p>
                <?php endif; ?>

                <div class="row action-buttons" >
                        <button class="btn update-btn" id="update-btn" onclick="enableEditing()">Edit</button>
                <!-- <button class="btn update-btn">Update</button> -->
                <button class="btn delete-btn" id="delete-btn" onclick="clickDeleteBtninPending('<?= $companyData[0]['company_id'] ?>');" >Delete</button>
                <button class="btn email-btn"><b>Send An Email</b></button>
                </div>
            </section>
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>