<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/dashboardCompany.css">
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

            <?php $activeTab = 'company-list'; ?>
            <?php $this->renderComponent("companyTabs") ?>

            <div class="tab-content">
                <!-- Company List Tab -->
                <div id="company-list" class="tab-pane active ">
                    <section class="company-list">
                        <div class="list-header">
                            <h2>Company List</h2>
                            <div class="search-box">
                                <input type="text" placeholder="Search Company" />
                                <button>Search</button>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                <th>Company ID</th>
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
                                <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['company_id'] : $company->company_id) ?></td>
                                <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['company_name'] : $company->company_name) ?></td>
                                <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_person'] : $company->contact_person) ?></td>
                                <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['email'] : $company->email) ?></td>
                                <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_number'] : $company->contact_number) ?></td>
                                    
                                <td><button class="view-btn" onclick="navigateToViewCompany('<?= htmlspecialchars(is_array($company) ? $company['company_id'] : $company->company_id) ?>');">View</button></td>
                                </tr>
                                <?php endforeach ?>

                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No Registered Companies</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <!-- <div class="action-buttons">
                            <button class="add-btn" onclick="navigateToAddCompany();">+ Add</button>
                            <button class="blocked-btn" onclick="navigateToBlockList();">Blocked List</button>
                        </div> -->
                    </section>
                </div>


            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>
    <!-- <script>
        // JavaScript for Tabs
        function openTab(event, tabId) {
            const tabButtons = document.querySelectorAll(".tab-button");
            const tabPanes = document.querySelectorAll(".tab-pane");

            // Remove 'active' class from all tabs and tab content
            tabButtons.forEach(button => button.classList.remove("active"));
            tabPanes.forEach(pane => pane.classList.remove("active"));

            // Add 'active' class to clicked tab and corresponding content
            event.currentTarget.classList.add("active");
            document.getElementById(tabId).classList.add("active");
        }
    </script> -->
</body>

</html>