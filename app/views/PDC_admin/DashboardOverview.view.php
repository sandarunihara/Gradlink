<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/overviewDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Dashboard</h1>
                </div>

                <div class="header-right">
                    <i class="material-icons">notifications</i>
                    <img src="<?= ROOT ?>/assets/img/profile_img.jpg" alt="">

                    <div class="user-info">
                        <span>John</span>
                        <small>Admin</small>
                    </div>
                </div>
            </header>

            <div class="buttons">
                <button class="company-btn">Registered Companies</button>
                <button class="Student-btn">Registered Students</button>
            </div>

            <div class="views">
                <div class="company-view">
                    <div class="company-card">
                        <div class="company-card-header">
                            <h3>Company Name</h3>
                            <p>Company Email</p>
                        </div>
                        <div class="company-card-body">
                            <p>Company Address</p>
                            <p>Company Phone</p>
                        </div>
                    </div>
                </div>

                <div class="student-view">
                    <div class="student-card">
                        <div class="student-card-header">
                            <h3>Student Name</h3>
                            <p>Student Email</p>
                        </div>
                        <div class="student-card-body">
                            <p>Student Address</p>
                            <p>Student Phone</p>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>