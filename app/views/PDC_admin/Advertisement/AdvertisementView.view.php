<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/advertisement/viewAdvertisement.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        <main class="content">
            <header class="header">
                <h1>Advertisement #<?= htmlspecialchars($data->advertisementId) ?></h1>
            </header>
            
            <section class="company-info">
                <div class="image-container">
                    <img src="data:image/jpeg;base64,<?= htmlspecialchars($data->image) ?>" alt="Advertisement Image">
                </div>
                
                <form class="company-form" id="advertisement-form">
                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" value="<?= htmlspecialchars($data->position) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" value="<?= htmlspecialchars($data->status) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea readonly><?= htmlspecialchars($data->description) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Number of Interns Required</label>
                        <input type="text" value="<?= htmlspecialchars($data->numOfInterns) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Working Mode</label>
                        <input type="text" value="<?= htmlspecialchars($data->workingMode) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="text" value="<?= htmlspecialchars($data->startdate) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="text" value="<?= htmlspecialchars($data->deadline) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" value="<?= htmlspecialchars($data->Name) ?>" readonly>
                    </div>
                    <!-- <?= htmlspecialchars($data->Email)?> -->
                </form>

                <div>
                    <?php if ($data->status == 'Active'): ?>
                        <button class="btn btn-primary" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>', 'deactivate' , '<?= htmlspecialchars($data->Email) ?>')">Deactivate</button>
                    <?php elseif ($data->status == 'Deactive'): ?>
                        <button class="btn btn-primary" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>', 'activate' , '<?= htmlspecialchars($data->Email) ?>')">Activate</button>
                    <?php elseif ($data->status == 'Pending'): ?>
                        <button class="btn btn-primary" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>' , 'activate' , '<?= htmlspecialchars($data->Email) ?>')">Approve</button>
                        <button class="btn btn-primary" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>' , 'reject' , '<?= htmlspecialchars($data->Email) ?>')">Reject</button>
                    <?php elseif ($data->status == 'Rejected'): ?>
                        <button class="btn btn-primary" onclick="openModal('<?= htmlspecialchars($data->advertisementId) ?>' , 'activate' , '<?= htmlspecialchars($data->Email) ?>')">Activate</button>
                    <?php endif; ?>
                </div>
            </section>
        </main>
    </div>


    <div id="actionModal" class="modal">
        <form id="actionForm" method="POST" action="<?= ROOT ?>/PDC_admin/ViewAdvertisement/handleAction">
            <span class="close" onclick="closeModal()">&times;</span>
            <input type="hidden" name="advertisementId" id="hiddenAdId">
            <input type="hidden" name="action" id="hiddenAction">
            <input type="hidden" name="mail" id="hiddenEmail">
            
            <div id="reasonContainer">
                <label for="actionMessage">Enter a Reason:</label>
                <textarea name="reason" id="actionMessage"></textarea>
            </div>

            <div id="confirmationMessage"></div>

            <button type="submit" class="btn btn-primary">Proceed</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
        </form>
    </div>


</div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js?v=<?= time() ?>"></script>
</body>

</html>
