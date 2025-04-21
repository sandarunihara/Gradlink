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
                    <h1>Companies</h1>
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
                            <button class="search-icon-btn">
                                <i class="fas fa-search"></i>
                            </button>

                        </div>
                    </div>
                    <div class="table-wrapper">
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
                                <?php if (!empty($companyData)): ?>
                                    <?php foreach ($companyData as $company): ?>
                                        <tr>
                                            <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['company_id'] : $company->company_id) ?></td>
                                            <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['company_name'] : $company->company_name) ?></td>
                                            <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_person'] : $company->contact_person) ?></td>
                                            <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['email'] : $company->email) ?></td>
                                            <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_number'] : $company->contact_number) ?></td>

                                            <td><button class="view-btn" onclick="navigateToViewCompany('<?= htmlspecialchars(is_array($company) ? $company['company_id'] : $company->company_id) ?>');">
                                                    <i class="fas fa-eye"></i>
                                                    View</button></td>
                                        </tr>
                                    <?php endforeach ?>

                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No Registered Companies</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    </section>
                </div>


            </div>
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector(".search-box input");
            const tableRows = document.querySelectorAll("table tbody tr");

            searchInput.addEventListener("keyup", function() {
                const query = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    let matchFound = false;

                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(query)) {
                            matchFound = true;
                        }
                    });

                    if (matchFound) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>