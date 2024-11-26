<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Session</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/session/addSession.css?v=<?= time() ?>">

</head>

<body>
    <div class="container">
        <main class="content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Sessions</h1>
                </div>

                <div class="header-right">
                    <i class="material-icons">notifications</i>
                    <img src="<?= ROOT ?>/assets/images/profile_img.jpg" alt="">

                    <div class="user-info">
                        <span>Jonitha Cathrine</span>
                        <small>Admin</small>
                    </div>
                </div>
            </header>

            <section class="company-info">

                <?php if (isset($_SESSION['error'])): ?>
                        <div class="error-message">
                            <?= $_SESSION['error']; ?>
                            <?php unset($_SESSION['error']); ?>
                        </div>
                <?php endif; ?>

                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddSession/submit" id="session-form">

                    <div class="form-group">
                        <label for="session-name">Session Name</label>
                        <input type="text" id="session-name" name="session_name" placeholder="Session name" required>
                    </div>
                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <input type="text" id="company-name" name="company_name" placeholder="Company name" required>
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-person">Contact Person</label>
                        <input type="text" id="contact-person" name="contact_person" placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact_number" placeholder="0771234567" required>
                    </div>
                    <div class="form-group">
                        <label for="hall-number">Hall Number</label>
                        <select id="hall-number" name="hall_number" required>
                            <option value="" disabled selected>Select hall number</option>
                            <option value="1">Hall 1</option>
                            <option value="2">Hall 2</option>
                            <option value="3">Hall 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="session-date">Session Date</label>
                        <input type="date" id="session-date" name="session_date" required>
                    </div>


                    <div class="form-group">
                        <label for="time-slot">Time Slot</label>
                        <select id="time-slot" name="time_slot" required>
                            <option value="" disabled selected>Select time slot</option>
                            <option value="9-11am">9:00 AM - 11:00 AM</option>
                            <option value="11-1pm">11:00 AM - 1:00 PM</option>
                            <option value="2-4pm">2:00 PM - 4:00 PM</option>
                            <option value="4-6pm">4:00 PM - 6:00 PM</option>
                            <!-- Add more time slots as needed -->
                        </select>
                    </div>

                    <div class="button-line">
                    <button class="back-btn" onclick='navigateToViewSession()'>Back</button>
                    <div class="action-buttons">
                        <button type="submit" class="btn confirm-btn">Confirm</button>
                    </div>
                </div>
                </form>
                

            </section>
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js?v=<?= time() ?>"></script>
</body>

</html>