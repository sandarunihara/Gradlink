<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/viewCompany.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">

</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>

        <main class="content">
            <header class="header">
                <div class="company-title">
                    <h1><?= htmlspecialchars($companyData[0]['company_name'] ?? '') ?></h1>
                    <button class="edit-btn">&#9998;</button>
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
                    <script>
                        const companyData = <?= json_encode($companyData, JSON_PRETTY_PRINT | JSON_HEX_TAG); ?>;
                        console.log(companyData);
                    </script>
                    <!-- <?php
                    echo "<pre>";
                    print_r($companyData);
                    echo "</pre>";
                    ?> -->
                    <form class="company-form">
                        <div class="form-group">
                            <label for="company-name">Company Name</label>
                            <input type="text" id="company-name" value="<?= htmlspecialchars($companyData[0]['company_name'] ?? '') ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email-address">Email Address</label>
                            <input type="email" id="email-address" value="<?= htmlspecialchars($companyData[0]['email'] ?? '') ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="text" id="contact-number" value="<?= htmlspecialchars($companyData[0]['contact_number'] ?? '') ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" readonly>
<?= htmlspecialchars($companyData[0]['address_no'] . ', ' . $companyData[0]['address_lane'] . ', ' . $companyData[0]['address_city'] . ', ' . $companyData[0]['address_district']) ?>
            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" readonly><?= htmlspecialchars($companyData[0]['description']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="contact-person">Contact Person</label>
                            <input type="text" id="contact-person" value="<?= htmlspecialchars($companyData[0]['contact_person']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" id="website" value="<?= htmlspecialchars($companyData[0]['website']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="linkedin">LinkedIn</label>
                            <input type="text" id="linkedin" value="<?= htmlspecialchars($companyData[0]['linkedin']) ?>" readonly>
                        </div>
                    </form>
                <?php else: ?>
                    <p>No company data available.</p>
                <?php endif; ?>
                <div class="button-line">
                    <button class="view-profile-btn">View Profile</button>
                    <div class="action-buttons">
                        <button class="btn block-btn">Block</button>
                        <button class="btn delete-btn">Delete</button>
                        <button class="btn update-btn">Update</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>