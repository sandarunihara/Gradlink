<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Application/dashboardApplication.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Applications</h1>
                </div>

                
            </header>

            <?php $activeTab = 'applications-list'; ?>
            <?php $this->renderComponent("applicationTabs") ?>

            <div class="tab-content">
                <div id="applications-list" class="tab-pane active ">

                    <!-- Working Students -->
                    <section class="company-list">
                        <div class="list-header">
                            <h2>Working Students</h2>

                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Registration No.</th>
                                    <th>Name</th>
                                    <th>Degree</th>
                                    <th>Company</th>
                                    <th>Position</th>
                                    <th>Email</th>
                                    <th>Duration</th>
                                    <th>Started Date</th>
                                    <th>Ending Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2022/CS/123</td>
                                    <td>T.Y. Silva</td>
                                    <td>CS</td>
                                    <td>WSO2</td>
                                    <td>Software Engineer</td>
                                    <td>thisal@gmail.com</td>
                                    <td>6 months</td>
                                    <td>2024/10/14</td>
                                    <td>2025/04/14</td>
                                    <td>working</td>
                                    <td><button class="view-btn">View Profile</button></td>
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