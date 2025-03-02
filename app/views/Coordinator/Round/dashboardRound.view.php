<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rounds</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Round/dashboardRound.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">

</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard") ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Rounds</h1>
                </div>

            </header>

            <div class="tab-content">
                <!-- Company List Tab -->
                <div id="company-list" class="tab-pane active ">
                    <!-- <section class="company-list"> -->
                    <div class="list-header">
                        <h2>This is Round 01</h2>
                        
                    </div>
                </div>

            </div>
            <div class="company-list">
                    <table>
                    <thead>
                        <tr>
                            <th>Round ID</th>
                            <th>Round</th>
                            <th>Status</th>
                            <th>From</th>
                            <th>To</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php if (!empty($blockedCompanyData)): ?>
                            <?php foreach ($blockedCompanyData as $company): ?>
                                <tr>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['company_id'] : $company->company_id) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['company_name'] : $company->company_name) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_person'] : $company->contact_person) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['email'] : $company->email) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_number'] : $company->contact_number) ?></td>

                                    
                                    <td><button class="view-btn">View</button></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            <?php endforeach ?>

                        <?php else: ?> -->
                            <tr>
                                <td colspan="9">No Registered Companies</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                    </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>
    

</html>