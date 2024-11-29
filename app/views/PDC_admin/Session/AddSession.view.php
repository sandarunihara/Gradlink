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
                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddSession/submit" id="session-form">


                    <div class="form-group">
                        <label for="session-name">Session Name</label>
                        <input type="text" id="session-name" name="session_name" placeholder="Session Name" 
                            value="<?= htmlspecialchars($old_data['session_name'] ?? '') ?>" required>
                        <?php if (!empty($errors['session_name'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['session_name']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <input type="text" id="company-name" name="company_name" placeholder="Company Name" 
                            value="<?= htmlspecialchars($old_data['company_name'] ?? '') ?>" required>
                        <?php if (!empty($errors['company_name'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['company_name']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" name="email" placeholder="Company Email" 
                            value="<?= htmlspecialchars($old_data['email'] ?? '') ?>" required>
                        <?php if (!empty($errors['email'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['email']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="contact-person">Contact Person</label>
                        <input type="text" id="contact-person" name="contact_person" placeholder="Contact Person" 
                            value="<?= htmlspecialchars($old_data['contact_person'] ?? '') ?>" required>
                        <?php if (!empty($errors['contact_person'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['contact_person']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact_number" placeholder="Contact Number" 
                            value="<?= htmlspecialchars($old_data['contact_number'] ?? '') ?>" required>
                        <?php if (!empty($errors['contact_number'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['contact_number']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="hall-number">Hall Name</label>
                        <select id="hall-number" name="hall_number" required>
                            <option value="" disabled <?= empty($old_data['hall_number']) ? 'selected' : '' ?>>Select Hall</option>
                            <option value="W001" <?= ($old_data['hall_number'] ?? '') === 'W001' ? 'selected' : '' ?>>W001</option>
                            <option value="S104" <?= ($old_data['hall_number'] ?? '') === 'S104' ? 'selected' : '' ?>>S104</option>
                            <option value="S202" <?= ($old_data['hall_number'] ?? '') === 'S202' ? 'selected' : '' ?>>S202</option>
                        </select>
                        <?php if (!empty($errors['hall_number'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['hall_number']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="session-date">Session Date</label>
                        <input type="date" id="session-date" name="session_date" placeholder="Session Date" 
                            value="<?= htmlspecialchars($old_data['session_date'] ?? '') ?>" required>
                        <?php if (!empty($errors['session_date'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['session_date']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="time-slot">Time Slot</label>
                        <select id="time-slot" name="time_slot" required>
                            <option value="" disabled <?= empty($old_data['time_slot']) ? 'selected' : '' ?>>Select Time Slot</option>
                            <option value="9:00 AM - 11:00 AM" <?= ($old_data['time_slot'] ?? '') === '9:00 AM - 11:00 AM' ? 'selected' : '' ?>>9:00 AM - 11:00 AM</option>
                            <option value="11:00 AM - 1:00 PM" <?= ($old_data['time_slot'] ?? '') === '11:00 AM - 1:00 PM' ? 'selected' : '' ?>>11:00 AM - 1:00 PM</option>
                            <option value="2:00 PM - 4:00 PM" <?= ($old_data['time_slot'] ?? '') === '2:00 PM - 4:00 PM' ? 'selected' : '' ?>>2:00 PM - 4:00 PM</option>
                        </select>
                        <?php if (!empty($errors['time_slot'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['time_slot']) ?></span>
                        <?php endif; ?>
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