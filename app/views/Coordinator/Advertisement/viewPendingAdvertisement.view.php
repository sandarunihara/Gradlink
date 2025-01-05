<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Company</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Advertisement/viewPendingAdvertisement.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    </head>

<body>
    <div class="container">
    <?php $this->renderComponent("coordinatorDashboard")  ?>

        <main class="content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Advertisement</h1>
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

            <?php $this->renderComponent("advertisementTabs") ?>

            <section class="company-info">
                <?php if (!empty($advertisementData)): ?>
                <form class="company-form">
                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <input type="text" id="company-name" name="company_name" value="<?= htmlspecialchars($advertisementData[0]['company_name'] ?? '') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" id="position" name="position" value="<?= htmlspecialchars($advertisementData[0]['position'] ?? '') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="interns">Number of Interns</label>
                        <input type="number" id="interns" name="interns" value="<?= htmlspecialchars($advertisementData[0]['interns'] ?? '') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date" name="start_date" value="<?= htmlspecialchars($advertisementData[0]['start_date'] ?? '') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="end-date">End Date</label>
                        <input type="date" id="end-date" name="end_date" value="<?= htmlspecialchars($advertisementData[0]['end_date'] ?? '') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="working-mode">Working Mode</label>
                        <input type="text" id="working-mode" name="mode" value="<?= htmlspecialchars($advertisementData[0]['mode'] ?? '') ?>"readonly>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" readonly><?= htmlspecialchars($advertisementData[0]['description'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="qualifications">Qualifications</label>
                        <textarea id="qualifications" name="qualification" readonly><?= htmlspecialchars($advertisementData[0]['qualification'] ?? '') ?></textarea>
                    </div>
                    
                </form>
                <?php else: ?>
                    <p>No company data available.</p>
                <?php endif; ?>

                <div class="row action-buttons" >
                <!-- <button class="btn update-btn">Update</button> -->
                <button class="btn delete-btn" onclick="rejectAdvertisement();">Reject</button>
                <button class="btn view-btn"><b>Approve</b></button>
                </div>
            </section>
        </main>
    </div>

    <script>
        function rejectAdvertisement() {
            if (confirm("Are you sure you want to reject this advertisement?")) {
                window.location.href = "<?= ROOT ?>/pdc_coordinator/viewPendingAdvertisement/reject?id=<?= $advertisementData[0]['advertisement_id'] ?>";
            }
        }
    </script>
</body>

</html>