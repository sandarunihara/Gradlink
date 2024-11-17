<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Details</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/session/viewSession.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div class="container">
        <main class="content">
            <header class="header">
            <div class="student-title">
                    <h1><?= htmlspecialchars($session->session_name) ?></h1>
                    <button class="edit-btn">&#9998;</button>
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
            <section class="student-info">
                <form class="student-form" id="session-form" method='POST' action="<?= ROOT ?>/PDC_admin/ViewSession/edit/<?= $session->session_id ?>">
                    <div class="form-group">
                        <label for="session-name">Session Name</label>
                        <input type="text" id="session-name" name="session_name" value="<?= htmlspecialchars($session->session_name) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="student-name">Company Name</label>
                        <input type="text" id="student-name" name="company_name" value="<?= htmlspecialchars($session->company_name) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" name="email" value="<?= htmlspecialchars($session->email) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="contact-person">Contact Person</label>
                        <input type="text" id="contact-person" name="contact_person" value="<?= htmlspecialchars($session->contact_person) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact_number" value="<?= htmlspecialchars($session->contact_number) ?>" readonly>
                    </div>

                    <!-- <div class="form-group">
                        <label for="hall-number">Hall Number</label>
                        <input type="text" id="hall-number" value="<?= htmlspecialchars($session->hall_number) ?>" readonly>
                    </div> -->

                    <div class="form-group">
                        <label for="hall-number">Hall Number</label>
                        <select id="hall-number" name="hall_number" disabled>
                            <option value="1" <?= $session->hall_number == 1 ? 'selected' : '' ?>>Hall 1</option>
                            <option value="2" <?= $session->hall_number == 2 ? 'selected' : '' ?>>Hall 2</option>
                            <option value="3" <?= $session->hall_number == 3 ? 'selected' : '' ?>>Hall 3</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" id="session-date" placeholder="" value="<?= htmlspecialchars($session->session_date) ?>" readonly>
                    </div> -->
                    <div class="form-group">
                        <label for="session-date">Date</label>
                        <input type="date" id="session-date" name="session_date" value="<?= htmlspecialchars($session->session_date) ?>" readonly>
                    </div>
                    <!-- <div class="form-group">
                        <label for="time-slot">Time Slot</label>
                        <input type="text" id="time-slot" placeholder="" value="<?= htmlspecialchars($session->time_slot) ?>" readonly>
                    </div> -->
                    <div class="form-group">
                        <label for="time-slot">Time Slot</label>
                        <select id="time-slot" name="time_slot" disabled>
                            <option value="9:00 AM - 11:00 AM" <?= $session->time_slot == '9-11am' ? 'selected' : '' ?>>9:00 AM - 11:00 AM</option>
                            <option value="11:00 AM - 1:00 PM" <?= $session->time_slot == '11-1pm' ? 'selected' : '' ?>>11:00 AM - 1:00 PM</option>
                            <option value="2:00 AM - 4:00 AM" <?= $session->time_slot == '2-4pm' ? 'selected' : '' ?>>2:00 AM - 4:00 AM</option>
                            <option value="4:00 AM - 6:00 AM" <?= $session->time_slot == '4-6pm' ? 'selected' : '' ?>>4:00 AM - 6:00 AM</option>
                        </select>
                    </div>


                </form>
                <div class="button-line">
                    <div class="action-buttons">
                        <button type='button' class='btn update-btn' id='save-btn' style='display: none;'>Save</button>
                        <button class="btn block-btn" id="delete-btn" onclick="navigateToDelete(<?= $session->session_id ?>)">Delete</button>
                        <button class="btn update-btn" id="edit-btn">Update</button>
                        <button class="btn back-btn" id="back-btn" onclick="history.back()">Back</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
</body>

</html>