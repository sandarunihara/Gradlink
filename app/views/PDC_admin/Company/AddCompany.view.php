<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Company</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/addCompany.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">

</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar")  ?>
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

        
            <section class="company-info">
                <form
                    class="company-form"
                    method="POST"
                    action="<?= ROOT ?>/PDC_admin/AddCompany/create"
                    onsubmit="return validateContactNumber()">
                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <input
                            type="text"
                            id="company-name"
                            placeholder="Company name"
                            name="company_name"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input
                            type="email"
                            id="email-address"
                            placeholder="Email"
                            name="email"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="contact-person">Contact Person</label>
                        <input
                            type="text"
                            id="contact-person"
                            placeholder="Name"
                            name="contact_person"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input
                            type="text"
                            id="contact-number"
                            placeholder="Mobile"
                            name="contact_number" />
                    </div>

                    <button class="btn email-btn"  type="submit"><b>Submit</b></button>
                    <div>
                        <small id="contact-error" class="error-message" style="color: red; display: none; ">
                            Please enter a valid contact number (10 digits, starting with 07).
                        </small>
                    </div>
                </form>
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
</body>

</html>