<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/dashboardCompany.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">

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

            <!-- Tabs Section -->
            <div class="tabs">
                <button class="tab-button active" onclick="openTab(event, 'company-list')">Company List</button>
                <button class="tab-button" onclick="openTab(event, 'pending-companies')">Pending Companies</button>
            </div>

            <div class="tab-content">
                <!-- Company List Tab -->
                <div id="company-list" class="tab-pane active">
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
                                    <td><button class="view-btn" onclick="navigateToViewCompany();"  >View</button></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                        <div class="action-buttons">
                            <button class="add-btn" onclick="navigateToAddCompany();">+ Add</button>
                            <button class="blocked-btn" onclick="navigateToBlockList();">Blocked List</button>
                        </div>
                    </section>
                </div>

                <!-- Pending Companies Tab -->
                <div id="pending-companies" class="tab-pane">
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

    <script src="<?= ROOT ?>/assets/js/script.js"></script>
    <script>
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
    </script>
</body>

</html>
