<!DOCTYPE html>
<html lang="en">

<head>
    <title>Session</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/session/overviewSession.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Sessions</h1>
                </div>

                <div class="header-right">
                    <i class="material-icons">notifications</i>
                    <img src="<?= ROOT ?>/assets/img/profile_img.jpg" alt="">

                    <div class="user-info">
                        <span>John</span>
                        <small>Admin</small>
                    </div>
                </div>
            </header>

            <section class="company-list">
                <div class="list-header">
                    <h2>Scheduled Sessions</h2>
                    <div class="search-box">
                        <input type="text" placeholder="Search Students" />
                        <button> Search
                        </button>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($sessionData)): ?>
                            <?php foreach($sessionData as $session): ?>
                                <tr>
                                    <td><?= htmlspecialchars(is_array($session) ? $session['session_name'] : $session->session_name) ?></td>
                                    <td><?= htmlspecialchars(is_array($session) ? $session['company_name'] : $session->company_name) ?></td>
                                    <td><?= htmlspecialchars(is_array($session) ? $session['hall_number'] : $session->hall_number) ?></td>
                                    <td><?= htmlspecialchars(is_array($session) ? $session['session_date'] : $session->session_date) ?></td>
                                    <td><?= htmlspecialchars(is_array($session) ? $session['time_slot'] : $session->time_slot) ?></td>
                                    <td><button class="view-btn" onclick="navigateToShowSession(<?= is_array($session) ? $session['session_id'] : $session->session_id ?>)">View</button></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9">No scheduled sessions found.</td>
                            </tr>
                        <?php endif; ?>
                        
                    </tbody>
                </table>
                <div class="action-buttons">
                    <button class="add-btn" onclick="navigateToAddSession();" >+ Add</button>
                </div>

            </section>

            

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>

</body>

</html>