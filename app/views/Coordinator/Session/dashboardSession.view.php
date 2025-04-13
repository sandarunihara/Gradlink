<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Session/dashboardSession.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Sessions</h1>
                </div>


            </header>

            <!-- <section class="company-list"> -->

            <div class="session-card-grid">
                <?php if (!empty($sessionData)) : ?>
                    <?php foreach ($sessionData as $session) : ?>
                        <div class="session-card">
                            <div class="card-header">
                                <h3><?= htmlspecialchars($session->session_name) ?></h3>
                                <span class="session-id"><?= htmlspecialchars($session->session_id) ?></span>
                            </div>
                            <div class="card-body">
    <p><strong>Hall:</strong> <?= htmlspecialchars($session->hall_number) ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($session->session_date) ?></p>
    <p><strong>Time:</strong> <?= htmlspecialchars($session->time_slot) ?></p>
    <p><strong>Company:</strong> <?= htmlspecialchars($session->Name) ?></p>

    <div class="description-toggle">
        <button class="expand-btn">
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
                    <p class="no-session">No sessions scheduled.</p>
                <?php endif; ?>
            </div>


            <!-- </section> -->



        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>
    <script>
    document.querySelectorAll('.expand-btn').forEach(button => {
        button.addEventListener('click', () => {
            const description = button.closest('.description-toggle').querySelector('.description');
            const icon = button.querySelector('i');
            
            if (description.style.display === 'block') {
                description.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            } else {
                description.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            }
        });
    });
</script>


</body>

</html>