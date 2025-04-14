<!DOCTYPE html>
<html lang="en">

<head>
    <title>Session</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/session/overviewSession.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
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
            document.addEventListener('DOMContentLoaded', function() {
                <?php if ($type === 'success'): ?>
                    successToast('<?= $message ?>');
                <?php else: ?>
                    errorToast('<?= $message ?>');
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>

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

            <section class="company-list">
                <div class="list-header">
                    <div class="search-box">    
                        <input type="text" placeholder="Search Students" />
                        <button> Search
                        </button>
                    </div>
                    <div class="action-buttons">
                        <button class="add-btn" onclick="navigateToAddSession();" ></button>
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
                                    <td><?= htmlspecialchars($session->session_name) ?></td>
                                    <td><?= htmlspecialchars($session->Name) ?></td>
                                    <td><?= htmlspecialchars($session->hall_number) ?></td>
                                    <td><?= htmlspecialchars($session->session_date) ?></td>
                                    <td><?= htmlspecialchars($session->time_slot) ?></td>
                                    <td><button class="view-btn" onclick="navigateToShowSession(<?= $session->session_id ?>)">View</button></td>
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
                

            </section>

            

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>

</body>

</html>