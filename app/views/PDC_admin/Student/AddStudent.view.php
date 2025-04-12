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
    <style>
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: #f0f4f8;
    display: flex;
    height: 100%;
}

.container {
    display: flex;
    width: 100%;
}

.content {
    width: 95%;
    padding: 40px 5%;
    background-color: #ffffff;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    margin-left: 5%;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 15px;
}

.header-left h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #2d3748;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 20px;
}

.header-right img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-info span {
    font-weight: 600;
}

.user-info small {
    font-size: 12px;
    color: #6b7280;
}

.company-info {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.company-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 14px;
    font-weight: 600;
    color: #4b5563;
    margin-bottom: 8px;
}

.form-group input,
.form-group select {
    margin-top: 15px;
    padding: 15px;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    background-color: #fafafa;
    width: 100%;
    font-size: 14px;
    color: #333;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.form-group input::placeholder {
    color: #aaa;
    font-size: 14px;
    font-style: italic;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #2b36b7;
    outline: none;
    box-shadow: 0 0 8px rgba(43, 54, 183, 0.5);
}

.form-group input:hover,
.form-group select:hover {
    border-color: #1e3c72;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
}

.form-group input:focus::placeholder {
    color: transparent;
}

.error {
    color: #ef4444;
    font-size: 12px;
    font-weight: 500;
    margin-top: 5px;
    display: block;
}

.button-line {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.back-btn,
.confirm-btn {
    padding: 16px 48px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.back-btn:hover,
.confirm-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

.back-btn:active,
.confirm-btn:active {
    transform: translateY(2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

.back-btn {
    background: #e5e7eb;
    color: #4b5563;
    width: 240px;
}

.back-btn:hover {
    background: #d1d5db;
}

.confirm-btn {
    background: #1e3c72;
    color: white;
    width: 240px;
}

.confirm-btn:hover {
    background: #172554;
}

.format-hint {
    display: block;
    font-size: 12px;
    color: #6b7280;
    margin-top: 5px;
}

@media (max-width: 768px) {
    .button-line {
        flex-direction: column;
        gap: 15px;
    }

    .back-btn,
    .confirm-btn {
        width: 100%;
    }
}
    </style>
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        <main class="content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">school</i>
                    <h1>Create Student</h1>
                </div>
            </header>

            <section class="company-info">
                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddStudent/submit" id="student-form">
                    <div class="form-group">
                        <label for="student-id">Student ID</label>
                        <input type="text" id="student-id" name="StudentId" placeholder="2022cs021" 
                            value="<?= htmlspecialchars($old_data['StudentId'] ?? '') ?>" 
                            pattern="\d{4}[a-z]{2}\d{3}"
                            required>
                        <?php if (!empty($errors['StudentId'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['StudentId']) ?></span>
                        <?php endif; ?>
                        <small class="format-hint">Format: 4 numbers, 2 letters, 3 numbers (e.g., 2022cs021)</small>
                    </div>

                    <div class="form-group">
                        <label for="student-nic">Student NIC</label>
                        <input type="text" id="student-nic" name="NIC" placeholder="Student NIC"
                            value="<?= htmlspecialchars($old_data['NIC'] ?? '') ?>"
                            pattern="\d{12}"
                            required>
                        <?php if (!empty($errors['NIC'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['NIC']) ?></span>
                        <?php endif; ?>
                        <small class="format-hint">Format: 12 digits (e.g., 200156789012)</small>
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
                            <option value="Not Applied" <?= ($old_data['Status'] ?? 'Not Applied') === 'Not Applied' ? 'selected' : '' ?>>Not Applied</option>
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
                            value="<?= htmlspecialchars($old_data['ContactNum'] ?? '') ?>" 
                            pattern="^07\d{8}$"
                            required>
                        <?php if (!empty($errors['ContactNum'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['ContactNum']) ?></span>
                        <?php endif; ?>
                        <small class="format-hint">Format: 07XXXXXXXX (e.g., 0771234567)</small>
                    </div>
                    
                    <div class="button-line">
                        <button type="button" class="back-btn" onclick="history.back()">Back</button>
                        <button type="submit" class="confirm-btn">Confirm</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>