<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Companies</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/overviewCompany.css?v=<?= time() ?>">
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
                    <h1>Pending Companies</h1>
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
                                <input type="text" id='search-query' placeholder="Search Company" />
                                <button onclick="searchCompany()">Search</button>
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
                            <tbody id='company-table-body'>
                                <?php if(!empty($companyData)): ?>
                                    <?php foreach($companyData as $company): ?>
                                        <tr>
                                            <td><?= htmlspecialchars(is_array($company) ? $company['Name'] : $company->Name) ?></td>
                                            <td><?= htmlspecialchars(is_array($company) ? $company['ContactPerson'] : $company->ContactPerson) ?></td>
                                            <td><?= htmlspecialchars(is_array($company) ? $company['Email'] : $company->Email) ?></td>
                                            <td><?= htmlspecialchars(is_array($company) ? $company['ContactNum'] : $company->ContactNum) ?></td>
                                            <td><button class="view-btn" onclick="navigateToShowCompany('<?= htmlspecialchars(is_array($company) ? $com['CompanyId'] : $company->CompanyId) ?>')">View</button></td>

                                            <!-- <td><button class="btn delete-btn" id="delete-btn" onclick="navigateToDeleteStudent('<?= htmlspecialchars(is_array($student) ? $student['StudentId'] : $student->StudentId) ?>')">Delete</button></td> -->
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No Companies found.</td>
                                    </tr>
                                <?php endif; ?>
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