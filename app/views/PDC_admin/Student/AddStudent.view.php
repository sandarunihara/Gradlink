<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/addStudent.css?v=<?= time() ?>">


</head>

<body>
    <?php 
        if (isset($_SESSION['flash_message'])): 
            $message = htmlspecialchars($_SESSION['flash_message']['message']);
            $type = htmlspecialchars($_SESSION['flash_message']['type']);
            unset($_SESSION['flash_message']);
        ?>
        <script>
            window.__flashMessage = {
                message: "<?= $message ?>",
                type: "<?= $type ?>"
            };
        </script>
    <?php endif; ?>

    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        <main class="main-content">
            <header class="header">
                <h1>
                    <i class="material-icons">school</i>
                    Create Student
                </h1>
            </header>

            <section class="tab-content">
                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddStudent/submit" id="student-form">
                    <div class="filling-form">
                        <div class="form-group">
                            <label for="student-id">Student ID</label>
                            <input type="text" id="student-id" name="StudentId" placeholder="2022cs021" 
                                value="<?= htmlspecialchars($old_data['StudentId'] ?? '') ?>" 
                                pattern="\d{4}(cs|is)\d{3}"
                                required>
                            <small class="format-hint">Format: 4 numbers, 2 letters, 3 numbers (e.g., 2022cs021)</small>
                        </div>

                        <div class="form-group">
                            <label for="student-nic">Student NIC</label>
                            <input type="text" id="student-nic" name="NIC" placeholder="Student NIC"
                                value="<?= htmlspecialchars($old_data['NIC'] ?? '') ?>"
                                pattern="\d{12}"
                                required>
                            <small class="format-hint">Format: 12 digits (e.g., 200156789012)</small>
                        </div>

                        <div class="form-group">
                            <label for="student-name">Student Name</label>
                            <input type="text" id="student-name" name="Name" placeholder="Student Name"
                                value="<?= htmlspecialchars($old_data['Name'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="student-email">Email</label>
                            <input type="email" id="student-email" name="Email" placeholder="Student Email"
                                value="<?= htmlspecialchars($old_data['Email'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="degree-name">Degree Name</label>
                            <select id="degree-name" name="DegreeName" required>
                                <option value="" disabled <?= empty($old_data['DegreeName']) ? 'selected' : '' ?>>Select Degree</option>
                                <option value="Computer Science" <?= ($old_data['DegreeName'] ?? '') === 'Computer Science' ? 'selected' : '' ?>>Computer Science</option>
                                <option value="Information System" <?= ($old_data['DegreeName'] ?? '') === 'Information System' ? 'selected' : '' ?>>Information System</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="Status" required>
                                <option value="" disabled <?= empty($old_data['Status']) ? 'selected' : '' ?>>Select Status</option>
                                <option value="Not Applied" <?= ($old_data['Status'] ?? 'Not Applied') === 'Not Applied' ? 'selected' : '' ?>>Not Applied</option>
                                <option value="Pending" <?= ($old_data['Status'] ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Recruited" <?= ($old_data['Status'] ?? '') === 'Recruited' ? 'selected' : '' ?>>Recruited</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="text" id="contact-number" name="ContactNum" placeholder="0771234567"
                                value="<?= htmlspecialchars($old_data['ContactNum'] ?? '') ?>" 
                                pattern="^\d{10}$"
                                required>
                            <small class="format-hint">Enter a valid phone number (e.g. 0733333333)</small>
                        </div>
                    </div>
                    
                    <div class="button-line">
                        <button type="button" class="btn back-btn" onclick="history.back()">Back</button>
                        <button type="submit" class="btn submit-btn">Create Student</button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
</body>
</html>