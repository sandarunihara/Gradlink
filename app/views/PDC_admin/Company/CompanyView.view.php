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

</head>

<body>
    <div class="container">
        
        <main class="content">
            <header class="header">
            <div class="company-title">
                    <h1>CodeGen</h1>
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

            <section class="company-info">
                <form class="company-form">
                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <input type="text" id="company-name" placeholder="CodeGen" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" placeholder="info@codegen.com" readonly>
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" placeholder="0771234567" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" placeholder="No, Lane, City, District" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" placeholder="Company Description" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="contact-person">Contact Person</label>
                        <input type="text" id="contact-person" placeholder="John Doe" readonly>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="text" id="linkedin" placeholder="linkedin.com/company/codegen" readonly>
                    </div>

                </form>
                <div class="button-line">
                    <button class="view-website-btn">View Website</button>
                    <div class="action-buttons">
                        <button class="btn back-btn" onclick='history.back()'>Back</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>

</body>

</html>