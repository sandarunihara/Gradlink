<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/pendingCompanyList.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">

</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard") ?>
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
            <?php $this->renderComponent("companyTabs") ?>

            <div class="tab-content">
                
                <!-- Pending Companies Tab -->
                <div id="pending-companies" class="tab-pane active">
                    <section class="company-list">
                        <div class="list-header">
                            <h2>Pending Companies</h2>
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
                            <?php if(!empty($companyData)): ?>
                                <?php foreach($companyData as $company): ?>
                                <tr>
                                <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['company_name'] : $company->company_name) ?></td>
                                <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_person'] : $company->contact_person) ?></td>
                                <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['email'] : $company->email) ?></td>
                                <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_number'] : $company->contact_number) ?></td>
                                
                                    <td><button class="view-btn" onclick="navigateToViewPendingCompany();">View</button></td>
                                </tr>
                                <?php endforeach ?>

                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No Registered Companies</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>
    
</body>

</html>
