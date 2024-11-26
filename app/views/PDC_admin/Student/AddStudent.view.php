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

                <?php if (isset($_SESSION['error'])): ?>
                        <div class="error-message">
                            <?= $_SESSION['error']; ?>
                            <?php unset($_SESSION['error']); ?>
                        </div>
                <?php endif; ?>

                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddStudent/submit" id="student-form">

                    <div class="form-group">
                        <label for="student-id">Student ID</label>
                        <input type="text" id="student-id" name="StudentId" placeholder="Registration Number" required>
                    </div>
                    <div class="form-group">
                        <label for="student-nic">Student NIC</label>
                        <input type="text" id="student-nic" name="NIC" placeholder="Student NIC" required>
                    </div>
                    <div class="form-group">
                        <label for="student-name">Student Name</label>
                        <input type="text" id="student-name" name="Name" placeholder="Student Name" required>
                    </div>
                    <div class="form-group">
                        <label for="student-email">Email</label>
                        <input type="text" id="student-email" name="Email" placeholder="Student Email" required>
                    </div>
                    <div class="form-group">
                        <label for="degree-name">Degree Name</label>
                        <select id="degree-name" name="DegreeName" required>
                            <option value="" disabled selected>Select Degree</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Information System">Information System</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="Status" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="Not Applied">Not Applied</option>
                            <option value="Pending">Pending</option>
                            <option value="Recruited">Recruited</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="ContactNum" placeholder="0771234567" required>
                    </div>

                    <div class="button-line">
                    <button class="back-btn" onclick='navigateToViewStudent()'>Back</button>
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