<!DOCTYPE html>
<html lang="en">

<head>
    <title>Advertisements</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/overviewStudent.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
    

</head>

<body>

    <?php 
        if (isset($_SESSION['flash_message'])): 
            $message = htmlspecialchars($_SESSION['flash_message']['message']);
            $type = htmlspecialchars($_SESSION['flash_message']['type']);
            unset($_SESSION['flash_message']);
        ?>
        <script>
            window.__flashMessage = {
                message: "<?= $message ?>",
                type: "<?= $type ?>"
            };
        </script>
    <?php endif; ?>


    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Advertisements</h1>
                </div>
            </header>

            <div class="tabs">
                <?php $this->renderPDC_adminTabs("advertisementTabs", ['activeTab' => $activeTab]); ?>
            </div>

            
            <div class="tab-content">
                <div class="tab-pane active" id="advertisement-list">
                <section class="company-list">
                    <div class="list-header">
                            <div class="search-box">
                                <input type="text" id='search-query' placeholder="Search Advertisement" />
                                <button onclick="searchAdd()">Search</button>
                            </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Position</th>
                                <th>No of Interns</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th> <!-- Added a column header for the button -->
                            </tr>
                        </thead>
                        <tbody id='add-table-body'>
                            <?php if($data == null) : ?>
                                <tr>
                                    <td colspan="6">No advertisements found</td>
                                </tr>
                            <?php else : ?>

                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row->Name) ?></td>
                                        <td><?= htmlspecialchars($row->position) ?></td>
                                        <td><?= htmlspecialchars($row->numOfInterns) ?></td>
                                        <td><?= htmlspecialchars($row->startdate) ?></td>
                                        <td><?= htmlspecialchars($row->deadline) ?></td>
                                        <td><button class="view-btn action-btn" onclick="navigateToAdvertisementView('<?= htmlspecialchars($row->advertisementId)?>')" class="view-btn"><i class="fas fa-eye"></i> View</button></td> <!-- Correctly aligned in a separate column -->
                                    </tr>
                                <?php endforeach; ?>
                                
                            <?php endif; ?>
                        </tbody>
                    </table>

                </section>
                </div>
            </div>
            
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>

</body>

</html>