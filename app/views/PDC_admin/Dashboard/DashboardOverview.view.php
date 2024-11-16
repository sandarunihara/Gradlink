<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/dashboard/overviewDashboard.css">
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

            <div class="views">
                <div class="company-view">
                    <button onclick="navigateToCompanyList();">Registered Companies</button>
                    <div class="logo-grid">
                        <div class="logo-det">
                        <img src="<?= ROOT ?>/assets/img/wso2.png" alt="Company Logo 1">
                        <span>WSO2</span>
                        </div>

                        <div class="logo-det">
                        <img src="<?= ROOT ?>/assets/img/wso2.png" alt="Company Logo 1">
                        <span>WSO2</span>
                        </div>

                        <div class="logo-det">
                        <img src="<?= ROOT ?>/assets/img/wso2.png" alt="Company Logo 1">
                        <span>WSO2</span>
                        </div>

                        <div class="logo-det">
                        <img src="<?= ROOT ?>/assets/img/wso2.png" alt="Company Logo 1">
                        <span>WSO2</span>
                        </div>

                        <div class="logo-det">
                        <img src="<?= ROOT ?>/assets/img/wso2.png" alt="Company Logo 1">
                        <span>WSO2</span>
                        </div>
                        
                    </div>
                </div>

                <div class="student-view">
                    <button onclick="navigateToStudentList();">Registered Students</button>
                    <div class="profile-pic-grid">

                        <div class="logo-det">
                        <img src="<?= ROOT ?>/assets/img/profile_img.jpg" alt="profile Logo 1">
                        <span>2022/CS/000</span>
                        </div>

                        <div class="logo-det">
                        <img src="<?= ROOT ?>/assets/img/profile_img.jpg" alt="profile Logo 1">
                        <span>2022/IS/000</span>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
</body>

</html>