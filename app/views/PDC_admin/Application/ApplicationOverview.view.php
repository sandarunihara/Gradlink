<!DOCTYPE html>
<html lang="en">

<head>
    <title>Applications</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/application/overviewApplication.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Applications</h1>
                </div>
            </header>

            <?php $activeTab = 'applications'; ?>
            <?php $this->renderPDC_adminTabs("applicationTabs") ?>

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
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($data == null) : ?>
                            <tr>
                                <td colspan="8">No applications found</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($data as $row) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row->StudentId) ?></td>
                                    <td><?= htmlspecialchars($row->StudentName) ?></td>
                                    <td><?= htmlspecialchars($row->DegreeName) ?></td>
                                    <td><?= htmlspecialchars($row->CompanyName) ?></td>
                                    <td><?= htmlspecialchars($row->position) ?></td>
                                    <td><?= htmlspecialchars($row->Jobstatus) ?></td>
                                    <td>
                                        <button class="view-btn" onclick="navigateToViewApplication('<?= htmlspecialchars($row->StudentId)?>','<?= htmlspecialchars($row->advertisementId)?>')">View</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

            </section>
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>

</body>

</html>