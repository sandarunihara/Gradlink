<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/viewCompany.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>

        <main class="main-content">
            <!-- <a href="<?= ROOT ?>/PDC_coordinator/dashboardAdvertisement/active" class="back-button">
                <i class="fas fa-arrow-left"></i>
            </a> -->
            <header class="header">


                <div class="company-title">
                    <h1 name="company_name"><?= htmlspecialchars($data->advertisementId) ?></h1>
                    <!-- <button class="edit-btn">&#9998;</button> -->
                </div>


            </header>

            <?php $this->renderComponent("advertisementTabs") ?>

            <section class="company-info">
                <?php if (!empty($data)): ?>
                    <script>
                        const data = <?= json_encode($data, JSON_PRETTY_PRINT | JSON_HEX_TAG); ?>;
                        console.log(data);
                    </script>
                    <!-- <?php
                            echo "<pre>";
                            print_r($data);
                            echo "</pre>";
                            ?> -->
                    <form class="company-form" >
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" id="position" name="position" value="<?= htmlspecialchars($data->position) ?>" readonly >
                            
                        </div>
                        <div class="form-group">
                            <label for="company-name">Company Name</label>
                            <input type="text" id="company-name" name="company-name" value="<?= htmlspecialchars($data->Name) ?>" readonly >
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" id="status" name="status" value="<?= htmlspecialchars($data->status) ?>" readonly >
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea readonly><?= htmlspecialchars($data->description) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="interns">Number of Interns Required</label>
                            <input type="text" id="interns" name="interns" value="<?= htmlspecialchars($data->numOfInterns) ?>" readonly >
                        </div>
                        <div class="form-group">
                            <label for="mode">Working Mode</label>
                            <input type="text" id="mode" name="mode" value="<?= htmlspecialchars($data->workingMode) ?>" readonly >
                        </div>
                        <div class="form-group">
                            <label for="start-date">Start Date</label>
                            <input type="text" id="start-date" name="start-date" value="<?= htmlspecialchars($data->startdate) ?>" readonly >
                        </div>
                       
                        <div class="form-group">
                            <label for="end-date">End Date</label>
                            <input type="text" id="end-date" name="end-date" value="<?= htmlspecialchars($data->deadline) ?>" readonly required>
                        </div>
                    </form>

                <?php else: ?>
                    <p>No data available.</p>
                <?php endif; ?>

            </section>
           
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>