<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Company</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/addCompany.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">

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
                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_coordinator/AddCompany/create" >
                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <input type="text" id="company-name" placeholder="Company name" name="company_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-person">Contact Person</label>
                        <input type="text" id="contact-person" placeholder="John Doe" name="contact_person" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" placeholder="0771234567" name="contact_number">
                    </div>

                <button class="btn email-btn" type="submit" ><b>Submit</b></button>
                    <!-- <div class="row" >
                        <input class="btn email-btn" type="submit" value="Send an Email">
                    </div> -->
                </form>
                <!-- <div class="row" >
                <button class="btn email-btn"><b>Send An Email</b></button>

                </div> -->
            </section>
        </main>
    </div>
</body>

</html>