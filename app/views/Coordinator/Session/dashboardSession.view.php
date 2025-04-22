<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Session/dashboardSession.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard") ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Sessions</h1>
                </div>

            </header>

            <?php $activeTab = 'upcoming'; ?>
            <?php $this->renderComponent("sessionTabs") ?>

            <div class="content-container">

                <div class="filter-controls">
                    <div class="filter-group">
                        <label for="date-filter">Filter by Date:</label>
                        <select id="date-filter">
                            <option value="All Dates">All Dates</option>
                            <option value="Today">Today</option>
                            <option value="This Week">This Week</option>
                            <option value="This Month">This Month</option>
                        </select>
                    </div>
                    <!-- filter halls -->
                    <div class="filter-group">
                        <label for="hall-filter">Filter by Hall:</label>
                        <select id="hall-filter">
                            <option value="all">All Halls</option>
                            <option value="W001">W001</option>
                            <option value="S104">S104</option>
                            <option value="S202">S202</option>
                            <option value="W004">W004</option>
                        </select>
                    </div>
                    <!-- filter companies -->
                    <div class="filter-group">
                        <label for="company-filter">Filter by Company:</label>
                        <select id="company-filter">
                            <option value="all">All Companies</option>
                            <?php if (!empty($companies)) : ?>
                                <?php foreach ($companies as $company) : ?>
                                    <option value="<?= htmlspecialchars($company->CompanyID) ?>">
                                        <?= htmlspecialchars($company->Name) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="session-card-grid">
                    <?php if (!empty($sessionData)) : ?>
                        <?php foreach ($sessionData as $session) : ?>
                            <div class="session-card" data-company-id="<?= htmlspecialchars($session->CompanyId) ?>"
                                data-hall="<?= htmlspecialchars($session->hall_number) ?>"
                                data-date="<?= htmlspecialchars($session->session_date) ?>">
                                <div class="card-header">

                                    <h3><?= htmlspecialchars($session->session_name) ?></h3>
                                    <span class="session-id">ID: <?= htmlspecialchars($session->session_id) ?></span>
                                </div>
                                <div class="card-body">
                                    <div class="info-row">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <p><strong>Hall:</strong> <?= htmlspecialchars($session->hall_number) ?></p>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-clock"></i>
                                        <p><strong>Time:</strong> <?= htmlspecialchars($session->time_slot) ?></p>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-calendar-day"></i>
                                        <p><strong>Date:</strong> <?= htmlspecialchars($session->session_date) ?></p>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-building"></i>
                                        <p><strong>Company:</strong> <?= htmlspecialchars($session->Name) ?></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="description-toggle">
                                        <button class="expand-btn">
                                            <span>View Details</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="description" style="display: none;">
                                            <p><strong>Description:</strong> <?= htmlspecialchars($session->description) ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="empty-state">
                            <img src="<?= ROOT ?>/assets/images/no-sessions.svg" alt="No sessions">
                            <h3>No Sessions Scheduled</h3>
                            <p>There are currently no sessions scheduled. Add a new session to get started.</p>
                            <button class="primary-btn">
                                <i class="fas fa-plus"></i> Create New Session
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>
    <script>
        document.querySelectorAll('.expand-btn').forEach(button => {
            button.addEventListener('click', () => {
                const card = button.closest('.session-card');
                const description = card.querySelector('.description');
                const icon = button.querySelector('i');

                description.style.display = description.style.display === 'block' ? 'none' : 'block';
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');

                if (description.style.display === 'block') {
                    button.querySelector('span').textContent = 'Hide Details';
                } else {
                    button.querySelector('span').textContent = 'View Details';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const companyFilter = document.getElementById('company-filter');
            const hallFilter = document.getElementById('hall-filter');
            const dateFilter = document.getElementById('date-filter');

            companyFilter.addEventListener('change', applyFilters);
            hallFilter.addEventListener('change', applyFilters);
            dateFilter.addEventListener('change', applyFilters);

            function applyFilters() {
                const selectedCompanyId = companyFilter.value;
                const selectedHall = hallFilter.value;
                const selectedDateRange = dateFilter.value;

                const sessionCards = document.querySelectorAll('.session-card');
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Normalize to start of day

                sessionCards.forEach(card => {
                    const cardCompanyId = card.dataset.companyId;
                    const cardHall = card.dataset.hall;
                    const cardDateStr = card.dataset.date;
                    const cardDate = new Date(cardDateStr);
                    cardDate.setHours(0, 0, 0, 0); // Normalize to start of day

                    // Calculate start of week (Sunday)
                    const startOfWeek = new Date(today);
                    startOfWeek.setDate(today.getDate() - today.getDay());

                    // Calculate start of month
                    const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

                    // Date matching logic
                    let dateMatch = true;
                    if (selectedDateRange !== 'All Dates') {
                        if (selectedDateRange === 'Today') {
                            dateMatch = cardDate.getTime() === today.getTime();
                        } else if (selectedDateRange === 'This Week') {
                            const endOfWeek = new Date(startOfWeek);
                            endOfWeek.setDate(startOfWeek.getDate() + 6);
                            dateMatch = cardDate >= startOfWeek && cardDate <= endOfWeek;
                        } else if (selectedDateRange === 'This Month') {
                            const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                            dateMatch = cardDate >= startOfMonth && cardDate <= endOfMonth;
                        }
                    }

                    const companyMatch = selectedCompanyId === 'all' || cardCompanyId === selectedCompanyId;
                    const hallMatch = selectedHall === 'all' || cardHall === selectedHall;

                    if (companyMatch && hallMatch && dateMatch) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>

</html>