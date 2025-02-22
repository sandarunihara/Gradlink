<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Application/dashboardApplication.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Applications</h1>
                </div>

                
            </header>

            <?php $activeTab = 'applications-list'; ?>
            <?php $this->renderComponent("applicationTabs") ?>

            <div class="tab-content">
                <div id="applications-list" class="tab-pane active ">

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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($applicationData)): ?>
                                    <?php foreach ($applicationData as $application): ?>
                                        <tr>

                                            <td><?= htmlspecialchars(string: is_array(value: $application) ? $application['student_id'] : $application->student_id) ?></td>
                                            <td><?= htmlspecialchars(string: is_array(value: $application) ? $application['student_name'] : $application->student_name) ?></td>
                                            <td><?= htmlspecialchars(string: is_array(value: $application) ? $application['degree_name'] : $application->degree_name) ?></td>
                                            <td><?= htmlspecialchars(string: is_array(value: $application) ? $application['company_name'] : $application->company_name) ?></td>
                                            <td><?= htmlspecialchars(string: is_array(value: $application) ? $application['position'] : $application->position) ?></td>
                                            <td><?= htmlspecialchars(string: is_array(value: $application) ? $application['advertisement_id'] : $application->advertisement_id) ?></td>

                                            <td><button class="view-btn">View Profile</button></td>
                                            <!-- View -> Go to the student profile -->
                                        </tr>
                                    <?php endforeach ?>

                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No Registered Companies</td>
                                    </tr>
                                <?php endif; ?>

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