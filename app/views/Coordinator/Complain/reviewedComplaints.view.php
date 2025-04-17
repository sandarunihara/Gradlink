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

            <?php $activeTab = 'reviewed-complaint-list'; ?>
            <?php $this->renderComponent("complaintTabs") ?>

            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="student">Student Complaints</button>
                <button class="filter-btn" data-filter="company">Company Complaints</button>
            </div>

            <p class="flash-message">
                <?php if (isset($_SESSION['flash_message'])): ?>
                    <span class="<?= $_SESSION['flash_message']['type'] ?>">
                        <?= $_SESSION['flash_message']['message'] ?>
                    </span>
                    <?php unset($_SESSION['flash_message']); ?>
                <?php endif; ?>
            </p>
            <div class="complaints-grid" id="complaintsGrid">
                <!-- Example card; dynamically generate from PHP or JS -->
                <?php foreach ($complaints as $complaint): ?>
                    <div class="complaint-card" data-type="<?= htmlspecialchars($complaint->type) ?>">
                        <div class="card-header">
                            <div class="profile-info">
                                <!-- <img src="<?= ROOT ?>/assets/images/default-profile.png" alt="profile"> -->
                                <div class="identity">
                                    <h3>
                                        <?= $complaint->type === 'student' ? htmlspecialchars($complaint->StudentName) : htmlspecialchars($complaint->CompanyName) ?>
                                    </h3>
                                    <p><?= ucfirst(htmlspecialchars($complaint->type)) ?></p>
                                </div>
                            </div>
                            <div class="timestamp">
                                <p><?= date('Y/m/d', strtotime($complaint->CreatedAt)) ?></p>
                                <p><?= date('g:i A', strtotime($complaint->CreatedAt)) ?></p>
                            </div>
                        </div>

                        <div class="card-body">
    <p class="topic"><strong><?= htmlspecialchars($complaint->Topic) ?></strong></p>
    <p class="description"><?= htmlspecialchars($complaint->Description) ?></p>
    
    <div class="reply-box">
        <p class="reply-label"><strong>Reply:</strong></p>
        <p class="reply-text">
            <?= !empty($complaint->reply) ? htmlspecialchars($complaint->reply) : '<em>No reply added.</em>' ?>
        </p>
    </div>
</div>
                        
                    </div>
                <?php endforeach; ?>



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