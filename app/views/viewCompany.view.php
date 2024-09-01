<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/viewCompany.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/logo.png" alt="GRadlink logo">
            </div>

            <nav class="nav-menu">
                <div class="nav-item">
                    <i class="material-icons">dashboard</i>
                    <a href="#" class="active">Dashboard</a>
                </div>
                <div class="nav-item active">
                    <i class="material-icons">business</i>
                    <a href="#">Companies</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">school</i>
                    <a href="#">Students</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">tab</i>
                    <a href="#">Advertisements</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">article</i>
                    <a href="#">Applications</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">event</i>
                    <a href="#">Sessions</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">help</i>
                    <a href="#">Complain</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">account_circle</i>
                    <a href="#">Profile</a>
                </div>
            </nav>
            <div class="logout">

                <a href="#">Logout</a>
            </div>
        </aside>
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
                        <label for="website">Website</label>
                        <input type="text" id="website" placeholder="www.codegen.com" readonly>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="text" id="linkedin" placeholder="linkedin.com/company/codegen" readonly>
                    </div>

                </form>
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
</body>

</html>