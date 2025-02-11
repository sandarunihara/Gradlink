<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisements</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Advertisement/dashboardAdvertisement.css">
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
                    <i class="material-icons">menu</i>
                    <h1> Advertisements</h1>
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
                <div id="pendingad-list" class="tab-pane active ">

                    <!-- Pending Advertisements -->
                    <section class="company-list">
                        <div class="list-header">
                            <h2>Pending Advertisements</h2>

                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Position</th>
                                    <th>No of Interns</th>
                                    <th>Working Mode</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($advertisementData)): ?>
                                    <?php foreach ($advertisementData as $advertisement): ?>
                                        <tr>
                                            <td> <?= htmlspecialchars(string: is_array(value: $advertisement) ? $advertisement['company_name'] : $advertisement->company_name) ?></td>
                                            <td> <?= htmlspecialchars(string: is_array(value: $advertisement) ? $advertisement['position'] : $advertisement->position) ?></td>
                                            <td> <?= htmlspecialchars(string: is_array(value: $advertisement) ? $advertisement['interns'] : $advertisement->interns) ?></td>
                                            <td> <?= htmlspecialchars(string: is_array(value: $advertisement) ? $advertisement['mode'] : $advertisement->mode) ?></td>
                                            <td> <?= htmlspecialchars(string: is_array(value: $advertisement) ? $advertisement['start_date'] : $advertisement->start_date) ?></td>
                                            <td> <?= htmlspecialchars(string: is_array(value: $advertisement) ? $advertisement['end_date'] : $advertisement->end_date) ?></td>
                                            <td><button class="view-btn" onclick="naviagteToViewPendingAdvertisement('<?= htmlspecialchars(string: is_array(value: $advertisement) ? $advertisement['advertisement_id'] : $advertisement->advertisement_id) ?>');">View</button></td>

                                            <!-- View -> Go to the advertisement -->
                                        </tr>

                                    <?php endforeach ?>

                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No Registered Companies</td>
                                    </tr>
                                <?php endif; ?>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>

                    </section>

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>