<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisements</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Advertisement/dashboardAdvertisement.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Components/coordinatorDashboard.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Advertisements</h1>
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

            <?php $activeTab = 'ongoingad-list'; ?>
            <?php $this->renderComponent("advertisementTabs") ?>

            <div class="tab-content">
                <div id="ongoingad-list" class="tab-pane active ">
                    <section class="company-list">
                        <div class="list-header">
                            <h2>Ongoing Advertisement List</h2>
                            <div class="search-box">
                                <input type="text" placeholder="Search Company" />
                                <button> Search
                                </button>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Position</th>
                                    <th>No of Interns</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>WSO2</td>
                                    <td>Software Engineer</td>
                                    <td>2</td>
                                    <td>10/10/2024</td>
                                    <td>30/10/2024</td>
                                    <td><button class="view-btn">View</button></td>
                                    <!-- View -> Go to the advertisement -->
                                </tr>
                                <tr>
                                    <td>WSO2</td>
                                    <td>QA</td>
                                    <td>5</td>
                                    <td>10/10/2024</td>
                                    <td>30/10/2024</td>
                                    <td><button class="view-btn">View</button></td>
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

</body>

</html>