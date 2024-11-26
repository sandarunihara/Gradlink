<!DOCTYPE html>
<html lang="en">

<head>
    <title>Applications</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/application/overviewApplication.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Applications</h1>
                </div>

                <div class="header-right">
                    <i class="material-icons">notifications</i>
                    <img src="<?= ROOT ?>/assets/img/profile_img.jpg" alt="">

                    <div class="user-info">
                        <span>John</span>
                        <small>Admin</small>
                    </div>
                </div>
            </header>


            <?php $activeTab = 'working-students'; ?>
            <?php $this->renderPDC_adminTabs("advertisementTabs") ?>

            <section class="company-list">
                <div class="list-header">
                    <h2>Applications</h2>
                    <div class="search-box">
                        <input type="text" placeholder="Search Students" />
                        <button> Search
                        </button>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Registration No.</th>
                            <th>Name</th>
                            <th>Degree</th>
                            <th>Applied Company</th>
                            <th>Position</th>
                            <th>Advertisement ID</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2022/CS/123</td>
                            <td>D.M. Perera</td>
                            <td>CS</td>
                            <td>WSO2</td>
                            <td>Software Engineer</td>
                            <td>003</td>
                            <td>
                                <select class="status-btn" id="status" name="status">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><button class="view-btn">View Profile</button></td>
                            <!-- View -> Go to the student profile -->
                        </tr>

                    </tbody>
                </table>

            </section>

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

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>