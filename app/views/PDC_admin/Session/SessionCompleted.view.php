<!DOCTYPE html>
<html lang="en">

<head>
    <title>Session</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/overviewStudent.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">

</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Sessions</h1>
                </div>
            </header>

            <div class="tabs">
                <?php $this->renderPDC_adminTabs("sessionTabs", ['activeTab' => $activeTab]); ?>
            </div>

            <div class="tab-content">
                <div class="tab-pane active">
                    <section class="company-list">
                        <div class="list-header">
                            <div class="search-box">
                                <input type="text" placeholder="Search Students" />
                                <button > 
                                    Search
                                </button>
 
                                <div class="filter-buttons">
                                    <button class="filter-btn active" data-reg="all">
                                        <i class="fas fa-users"></i> All
                                    </button>
                                    <button class="filter-btn" data-reg="registered">
                                        <i class="fas fa-users"></i> Registered Company
                                    </button>
                                    <button class="filter-btn" data-reg="other">
                                        <i class="fas fa-users"></i> Other Company
                                    </button>
                                </div>

                            </div>

                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Session Name</th>
                                    <th>Company</th>
                                    <th>Hall Number</th>
                                    <th>Date</th>
                                    <th>Time Slot</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($sessionData) && is_array($sessionData)): ?>
                                    <?php foreach($sessionData as $session): ?>
                                        <tr data-other-company="<?= isset($session->other_company_name) && !empty($session->other_company_name) ? 'true' : 'false' ?>">
                                            <td><?= htmlspecialchars($session->session_name) ?></td>
                                            <td> 
                                                <?php 
                                                    if (isset($session->other_company_name) && !empty($session->other_company_name)) {
                                                        echo htmlspecialchars($session->other_company_name);
                                                    } else {
                                                        echo htmlspecialchars($session->Name);
                                                    }
                                                ?>    
                                            </td>
                                            <td><?= htmlspecialchars($session->hall_number) ?></td>
                                            <td><?= htmlspecialchars($session->session_date) ?></td>
                                            <td><?= htmlspecialchars($session->time_slot) ?></td>
                                            <td>
                                                <?php 
                                                    if(isset($session->other_company_name)){
                                                        echo '<button class="view-btn action-btn" onclick="navigateToShowUnregisteredSession('.$session->session_id.')">';
                                                    } else {
                                                        echo '<button class="view-btn action-btn" onclick="navigateToShowSession('.$session->session_id.')">';
                                                    }
                                                ?>                                                    
                                                <i class="fas fa-eye"></i> View</button></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No completed sessions found.</td>
                                    </tr>
                                <?php endif; ?>
                                
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const studentRows = document.querySelectorAll('tbody tr');
        const searchInput = document.querySelector('.search-box input');
        const searchButton = document.querySelector('.search-box button');

        function filterRows() {
            const activeButton = document.querySelector('.filter-btn.active');
            const regToShow = activeButton ? activeButton.getAttribute('data-reg') : 'all';
            const searchTerm = searchInput.value.toLowerCase();
            
            studentRows.forEach(row => {
                const regCell = row.querySelector('td:nth-child(2)'); // Company column
                const nameCell = row.querySelector('td:nth-child(1)'); // Session Name column
                const isOtherCompany = row.getAttribute('data-other-company') === 'true';
                
                const matchesReg =
                    regToShow === 'all' ||
                    (regToShow === 'other' && isOtherCompany) ||
                    (regToShow !== 'other' && !isOtherCompany);

                const matchesSearch =
                    searchTerm === '' ||
                    nameCell.textContent.toLowerCase().includes(searchTerm) ||
                    regCell.textContent.toLowerCase().includes(searchTerm);

                if (matchesReg && matchesSearch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                filterRows();
            });
        });

        searchInput.addEventListener('input', filterRows);
        searchButton.addEventListener('click', filterRows);

        // Trigger initial filter
        filterRows();
        });
    </script>

</body>

</html>