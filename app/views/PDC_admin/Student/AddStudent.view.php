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
        :root {
            --primary: #4e54c8;
            --primary-dark: #23244a;
            --accent: #3c41a2;
            --background: #f0f0f5;
            --card-bg: #fff;
            --input-bg: #f7f8fa;
            --input-border: #bbbddd;
            --input-focus: #4e54c8;
            --danger: #ef4444;
            --gray: #64748b;
            --dark-gray: #374151;
            --radius: 12px;
            --shadow: 0 4px 20px rgba(67, 97, 238, 0.07);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 80px; /* Same as sidebar width */
            flex: 1;
            padding: 40px;
            background-color: var(--background);
            min-height: 100vh;
            transition: var(--transition);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header h1 i {
            color: var(--accent);
        }

        .tab-content {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 32px;
        }

        .company-form {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .filling-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px 32px;
        }

        @media (max-width: 900px) {
            .filling-form {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .main-content {
                padding: 24px 2%;
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .form-group label {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 8px;
            letter-spacing: 0.01em;
        }

        .form-group input,
        .form-group select {
            padding: 14px 16px;
            border: 1.5px solid var(--input-border);
            border-radius: 8px;
            background: var(--input-bg);
            font-size: 1rem;
            color: var(--primary-dark);
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.04);
            outline: none;
            width: 100%;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--input-focus);
            background: #fff;
            box-shadow: 0 0 0 2px rgba(78, 84, 200, 0.11);
        }

        .form-group input:hover,
        .form-group select:hover {
            border-color: var(--primary-dark);
        }

        .form-group input::placeholder {
            color: #b6b9c6;
            font-size: 0.98rem;
            font-style: italic;
        }

        .format-hint {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 6px;
            margin-left: 2px;
        }

        .error {
            color: var(--danger);
            font-size: 0.9rem;
            font-weight: 500;
            margin-top: 6px;
            margin-left: 2px;
        }

        .button-line {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            margin-top: 32px;
        }

        .btn {
            padding: 15px 48px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.07);
        }

        .submit-btn {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 14px rgba(67, 97, 238, 0.11);
        }

        .submit-btn:hover {
            background: var(--accent);
            box-shadow: 0 8px 30px rgba(78, 84, 200, 0.18);
            transform: translateY(-2px);
        }

        .back-btn {
            background: #e0e7ef;
            color: var(--primary-dark);
        }

        .back-btn:hover {
            background: #d1d9f0;
            color: var(--primary);
            transform: translateY(-2px);
        }

        @media (max-width: 600px) {
            .main-content {
                padding: 18px 2%;
                margin-left: 0;
                margin-top: 60px;
            }
            .button-line {
                flex-direction: column;
                gap: 16px;
            }
            .btn {
                width: 100%;
                padding: 14px 0;
            }
        }
    </style>
</head>

<body>
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
                                <span class="error"
                                    pattern="^[0-9+\s()-]{7,20}$"
                                ><?= htmlspecialchars($errors['ContactNum']) ?></span>
                            <?php endif; ?>
                            <small class="format-hint">Enter a valid phone number (e.g., +94 98765 43210 , 0733333333)</small>
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
</body>
</html>