<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Company</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/addCompany.css?time=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <?php $this->renderComponent("pdc_adminsidebar") ?>

        </div>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Register Company</h1>
                </div>
            </header>
            
            <div class="tab-content">

                <div id="company-list" class="tab-pane active">
                    <section class="company-info">
                        <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddCompany/create" onsubmit="return validateContactNumber()">
                            
                            <div class="filling-form">
                                <div class="form-group">
                                    <label for="company-name">Company Name</label>
                                    <input type="text" id="company-name" placeholder="Company name" name="company_name" required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="email-address">Email Address</label>
                                    <input type="email" id="email-address" placeholder="Email" name="email" required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact-person">Contact Person</label>
                                    <input type="text" id="contact-person" placeholder="Name" name="contact_person" required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact-number">Contact Number</label>
                                    <input type="text" id="contact-number" placeholder="Mobile" name="contact_number" 
                                        pattern="^[0-9+\s()-]{7,20}$"
                                        required
                                    />
                                    <small class="format-hint">Enter a valid phone number (e.g., +94 98765 43210 , 0733333333)</small>
                                    </div>
                            </div>

                            <div class="button-line">
                                <button class="btn back-btn" onclick="history.back()"><b>Back</b></button>
                                <button class="btn submit-btn" type="submit"><b>Submit</b></button> 
                            </div>

                        </form>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
</body>

</html>
