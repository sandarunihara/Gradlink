<!DOCTYPE html>
<html lang="en">

<head>
    <title>Companies</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/overviewCompany.css?time=<?= time() ?>">
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
                    <h1>Companies</h1>
                </div>
            </header>

            <?php $activeTab = 'company-list'; ?>
            <?php $this->renderPDC_adminTabs("companyTabs") ?>

            <div class="tab-content">
                <div id="company-list" class="tab-pane active">
                    <section class="company-list">
                        <div class="list-header">
                            <div class="search-box">
                                <input type="text" id="search-query" placeholder="Search Company" />
                                <button onclick="searchCompany()">Search</button>
                                <button onclick="navigateToAddCompany()" class="add-btn">Add</button>
                            </div>
                        </div>

                        <div class="card-container" id="company-card-container">
                            <?php if (!empty($companyData)) : ?>
                                <?php foreach ($companyData as $company) : ?>
                                    <div class="company-card">
                                        <h2><?= htmlspecialchars(is_array($company) ? $company['Name'] : $company->Name) ?></h2>
                                        <p><strong>Contact Person:</strong> <?= htmlspecialchars(is_array($company) ? $company['ContactPerson'] : $company->ContactPerson) ?></p>
                                        <p><strong>Email:</strong> <?= htmlspecialchars(is_array($company) ? $company['Email'] : $company->Email) ?></p>
                                        <p><strong>Contact Number:</strong> <?= htmlspecialchars(is_array($company) ? $company['ContactNum'] : $company->ContactNum) ?></p>
                                        <button class="view-btn" onclick="navigateToShowCompany('<?= htmlspecialchars(is_array($company) ? $company['CompanyId'] : $company->CompanyId) ?>')">View</button>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>No Companies found.</p>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
</body>

</html>
