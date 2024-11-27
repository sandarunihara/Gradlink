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
                    <h1>Student</h1>
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
                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddStudent/submit" id="student-form">

                    <div class="form-group">
                        <label for="student-id">Student ID</label>
                        <input type="text" id="student-id" name="StudentId" placeholder="2022cs021" 
                            value="<?= htmlspecialchars($old_data['StudentId'] ?? '') ?>" required>
                        <?php if (!empty($errors['StudentId'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['StudentId']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="student-nic">Student NIC</label>
                        <input type="text" id="student-nic" name="NIC" placeholder="Student NIC"
                            value="<?= htmlspecialchars($old_data['NIC'] ?? '') ?>" required>
                        <?php if (!empty($errors['NIC'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['NIC']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="student-name">Student Name</label>
                        <input type="text" id="student-name" name="Name" placeholder="Student Name"
                            value="<?= htmlspecialchars($old_data['Name'] ?? '') ?>" required>
                        <?php if (!empty($errors['Name'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['Name']) ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-email">Email</label>
                        <input type="email" id="student-email" name="Email" placeholder="Student Email"
                            value="<?= htmlspecialchars($old_data['Email'] ?? '') ?>" required>
                        <?php if (!empty($errors['Email'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['Email']) ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="degree-name">Degree Name</label>
                        <select id="degree-name" name="DegreeName" required>
                            <option value="" disabled <?= empty($old_data['DegreeName']) ? 'selected' : '' ?>>Select Degree</option>
                            <option value="Computer Science" <?= ($old_data['DegreeName'] ?? '') === 'Computer Science' ? 'selected' : '' ?>>Computer Science</option>
                            <option value="Information System" <?= ($old_data['DegreeName'] ?? '') === 'Information System' ? 'selected' : '' ?>>Information System</option>
                        </select>
                        <?php if (!empty($errors['DegreeName'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['DegreeName']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="Status" required>
                            <option value="" disabled <?= empty($old_data['Status']) ? 'selected' : '' ?>>Select Status</option>
                            <option value="Not Applied" <?= ($old_data['Status'] ?? '') === 'Not Applied' ? 'selected' : '' ?>>Not Applied</option>
                            <option value="Pending" <?= ($old_data['Status'] ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Recruited" <?= ($old_data['Status'] ?? '') === 'Recruited' ? 'selected' : '' ?>>Recruited</option>
                        </select>
                        <?php if (!empty($errors['Status'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['Status']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="ContactNum" placeholder="0771234567"
                            value="<?= htmlspecialchars($old_data['ContactNum'] ?? '') ?>" required>
                        <?php if (!empty($errors['ContactNum'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['ContactNum']) ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="button-line">
                    <button class="back-btn" onclick='history.back()'>Back</button>
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