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
                    <h1 name="company_name"><?= htmlspecialchars($companyData['company_name'] ?? '') ?></h1>
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
                    <form class="company-form" id="companyForm" onsubmit="return validateContactNumber()" method="POST" action="<?= ROOT ?>/PDC_coordinator/viewCompany/edit/<?= htmlspecialchars($companyData[0]['company_id']) ?>">
                        <div class="form-group">
                            <label for="company-name">Company Name</label>
                            <input type="text" id="company-name" name="company_name" value="<?= htmlspecialchars($companyData['company_name'] ?? '') ?>" readonly required>
                            <?php if (!empty($errors['company_name'])): ?>
                                <div style="color: red; font-size: 14px;"><?= htmlspecialchars($errors['company_name']) ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="email-address">Email Address</label>
                            <input type="email" id="email-address" name="email" value="<?= htmlspecialchars($companyData['email'] ?? '') ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="text" id="contact-number" name="contact_number" value="<?= htmlspecialchars($companyData['contact_number'] ?? '') ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address No</label>
                            <input type="text" id="address_no" name="address_no" value="<?= htmlspecialchars($companyData['address_no'] ?? '') ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address Lane</label>
                            <input type="text" id="address_lane" name="address_lane" value="<?= htmlspecialchars($companyData['address_lane'] ?? '') ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address City</label>
                            <input type="text" id="address_city" name="address_city" value="<?= htmlspecialchars($companyData['address_city'] ?? '') ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address District</label>
                            <input type="text" id="address_district" name="address_district" value="<?= htmlspecialchars($companyData['address_district'] ?? '') ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" readonly><?= htmlspecialchars($companyData['description']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="contact-person">Contact Person</label>
                            <input type="text" id="contact-person" name="contact_person" value="<?= htmlspecialchars($companyData['contact_person']) ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" id="website" name="website" value="<?= htmlspecialchars($companyData['website']) ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="linkedin">LinkedIn</label>
                            <input type="url" id="linkedin" name="linkedin" value="<?= htmlspecialchars($companyData['linkedin']) ?>" readonly required>
                        </div>
                        <button class="btn update-btn" id="save-btn" type="submit" style="display: none;">Update</button>
                        <div>
                        <small id="contact-error" class="error-message" style="color: red; display: none; ">
                            Please enter a valid contact number (10 digits, starting with 07).
                        </small>
                    </div>
                    </form>
                    <div class="button-line">
                        <button class="view-profile-btn hidden" >LinkedIn</button>
                        <div class="action-buttons" >
                            <button class="btn update-btn" >View Profile</button>
                            <!-- <button class="btn delete-btn" id="delete-btn" onclick="clickDeleteBtn('<?= $companyData[0]['company_id'] ?>');">Delete</button> -->
                            <!-- <button class="btn update-btn" id="update-btn" onclick="enableEditing()">Edit</button> -->

                        </div>
                    </div>
                <?php else: ?>
                    <p>No company data available.</p>
                <?php endif; ?>

            </section>
            <script>
                function validateContactNumber() {
                    const contactNumber = document.getElementById('contact-number').value;
                    const contactNumberPattern = /^07\d{8}$/; // Validates Sri Lankan mobile numbers
                    const errorElement = document.getElementById('contact-error');

                    if (!contactNumberPattern.test(contactNumber)) {
                        errorElement.style.display = 'block'; // Show error message
                        return false; // Prevent form submission
                    }

                    errorElement.style.display = 'none'; // Hide error message if valid
                    return true;
                }
            </script>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>