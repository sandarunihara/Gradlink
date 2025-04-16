<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Complain/dashboardComplain.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Complaints</h1>
                    
                </div>


            </header>

            <div class="filter-buttons">
                        <button class="filter-btn active" data-filter="all">All</button>
                        <button class="filter-btn" data-filter="student">Student Complaints</button>
                        <button class="filter-btn" data-filter="company">Company Complaints</button>
                    </div>

            <div class="complaints-grid" id="complaintsGrid">
                <!-- Example card; dynamically generate from PHP or JS -->
                <div class="complaint-card" data-type="student">
                    <div class="card-header">
                        <div class="profile-info">
                            <img src="<?= ROOT ?>/assets/images/default-profile.png" alt="profile">
                            <div class="identity">
                                <h3>M.A. Perera</h3>
                                <p>Student</p>
                            </div>
                        </div>
                        <div class="timestamp">
                            <p>2024/10/10</p>
                            <p>9:00 AM</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="company-name">Company: WSO2</p>
                        <p class="description">Unprofessional Behavior of Intern</p>
                    </div>
                    <div class="card-footer">
                        <button class="reply-btn">Add Reply</button>
                    </div>
                </div>

                <!-- More complaint cards dynamically added -->
            </div>

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const complaintCards = document.querySelectorAll('.complaint-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-filter');

            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            complaintCards.forEach(card => {
                if (filter === 'all' || card.getAttribute('data-type') === filter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

    </script>

</body>

</html>