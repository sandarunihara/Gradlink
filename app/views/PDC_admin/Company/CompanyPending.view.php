<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Companies</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/overviewCompany.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
    </head>

    <body>

    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        <main class="main-content">
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

            <?php $activeTab = 'pending-companies'; ?>
            <?php $this->renderPDC_adminTabs("companyTabs") ?>

            <div class="tab-content">
                
                <!-- Pending Companies Tab -->
                <div id="pending-companies" class="tab-pane active">
                    <section class="company-list">
                        <div class="list-header">
                            <h2>Pending Companies</h2>
                            <div class="search-box">
                                <input type="text" placeholder="Search Company" />
                                <button>Search</button>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>WSO2</td>
                                    <td>Tharindu Perera</td>
                                    <td>tharindu@gmail.com</td>
                                    <td>071 273 4321</td>
                                    <td><button class="view-btn" onclick="navigateToViewPendingCompany();">View</button></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </main>
    </div>

        <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>


    </body>

</html>