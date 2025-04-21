<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisements</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Advertisement/dashboardAdvertisement.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Components/coordinatorDashboard.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Advertisements</h1>
                </div>


            </header>

            <?php $activeTab = 'active-list'; ?>
            <?php $this->renderComponent("advertisementTabs") ?>

            <div class="tab-content">
                <div id="ongoingad-list" class="tab-pane active ">
                    <!-- <section class="company-list"> -->
                    <div class="list-header">
                        <h2>Active Advertisement List</h2>
                        <div class="search-box">
                            <input type="text" id="searchInput" placeholder="Search Advertisements" onkeyup="filterTable()" />
                            <button class="search-icon-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-wrapper">

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
                            <?php if (!empty($data)): ?>
                                <?php foreach ($data as $advertisement): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($advertisement->Name) ?></td>
                                        <td><?= htmlspecialchars($advertisement->position) ?></td>
                                        <td><?= htmlspecialchars($advertisement->numOfInterns) ?></td>
                                        <td><?= htmlspecialchars($advertisement->workingMode) ?></td>
                                        <td><?= htmlspecialchars($advertisement->startdate) ?></td>
                                        <td><?= htmlspecialchars($advertisement->deadline) ?></td>
                                        <td><button class="view-btn" onclick="navigateToViewAdvertisement('<?= htmlspecialchars($advertisement->advertisementId) ?>')">
                                        <i class="fas fa-eye"></i>      
                                        View</button></td>
                                        <!-- View -> Go to the advertisement -->
                                    </tr>

                                <?php endforeach ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="9">No Advertisements Found</td>
                                </tr>
                            <?php endif; ?>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                    </div>

                    <!-- </section> -->
                </div>
            </div>

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const companyCell = rows[i].getElementsByTagName("td")[0];
            if (companyCell) {
                const txtValue = companyCell.textContent || companyCell.innerText;
                rows[i].style.display = txtValue.toLowerCase().includes(filter) ? "" : "none";
            }
        }
    }
</script>


</body>

</html>