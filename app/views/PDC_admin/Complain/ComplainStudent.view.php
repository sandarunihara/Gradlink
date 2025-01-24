<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/complain/overviewComplain.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css?v=<?= time() ?>">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Complaints</h1>
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

            <?php $activeTab = 'student-complain-list'; ?>
            <?php $this->renderPDC_adminTabs("complainTabs") ?>

            <div class="tab-content">
                <div id="applications-list" class="tab-pane active ">

                    <!-- Working Students -->
                    <section class="company-list">
                        <div class="list-header">
                            <h2>Student Complaints</h2>

                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Name</th>
                                    <th>Registration No.</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0005</td>
                                    <td>2024/10/14</td>
                                    <td>11.00pm</td>
                                    <td>T.Y. Silva</td>
                                    <td>2022/CS/034</td>
                                    <td>Delay in Response from Assigned Company</td>
                                    <!-- <td><button class="view-btn">View Profile</button></td> -->
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