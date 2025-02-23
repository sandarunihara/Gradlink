<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Company/blockedCompanies.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Companies</h1>
                </div>

                
            </header>

            <?php $activeTab = 'pending-companies'; ?>
            <?php $this->renderComponent("companyTabs") ?>


            <!-- Pending Companies -->
            <section class="company-list">
                <div class="list-header">
                    <h2>Blocked Company List</h2>

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
                            <td><button class="view-btn">View</button></td>
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