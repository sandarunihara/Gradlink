<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Company</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/addCompany.css">
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
                <form class="company-form">
                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <input type="text" id="company-name" placeholder="Company name" required>
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-person">Contact Person</label>
                        <input type="text" id="contact-person" placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" placeholder="0771234567">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="text" id="password" required >
                            <button class="btn">Generate</button>
                        </div>
                    </div>

                    <!-- <div class="row" >
                        <input class="btn email-btn" type="submit" value="Send an Email">
                    </div> -->
                </form>
                <div class="row" >
                <button class="btn email-btn"><b>Send An Email</b></button>

                </div>
            </section>
        </main>
    </div>
</body>

</html>