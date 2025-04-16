<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Complain/dashboardComplain.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Complaints</h1>
                </div>

                
            </header>

            

            <div class="tab-content">
                <div id="applications-list" class="tab-pane active ">

                    <!-- <section class="company-list"> -->
                        <div class="list-header">
                            <h2>Complaints</h2>
                            <div class="search-box">
                                <input type="text" placeholder="Search Students" />
                                <button> Search
                                </button>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Company </th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0001</td>
                                    <td>2024/10/10</td>
                                    <td>9.00am</td>
                                    <td>WSO2</td>
                                    <td>M.A. Perera</td>
                                    <td>Unprofessional Behavior of Intern</td>
                                    
                                    <!-- <td><button class="view-btn">View Profile</button></td> -->
                                    <!-- View -> Go to the student profile -->
                                </tr>

                            </tbody>
                        </table>

                    <!-- </section> -->

                    
                </div>
            </div>

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>