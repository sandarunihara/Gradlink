<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/viewStudent.css?v=<?= time() ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div class="container">
        <main class="content">
            <header class="header">
            <div class="student-title">
                    <h1><?= htmlspecialchars($student->Name) ?></h1>
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
                <form class="student-form" id="student-form" method='POST' action="<?= ROOT ?>/PDC_admin/ViewStudent/edit/<?= $student->StudentId ?>">
                
                <div class="form-group">
                    <label for="student-id">Registration Number</label>
                    <input type="text" id="student-id" name="StudentId" value="<?= htmlspecialchars($student->StudentId) ?>" readonly>
                    <?php if (!empty($errors['StudentId'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['StudentId']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="student-name">Student Name</label>
                    <input type="text" id="student-name" name="Name" value="<?= htmlspecialchars($student->Name) ?>" readonly>
                    <?php if (!empty($errors['Name'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Name']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="student-nic">Student NIC</label>
                    <input type="text" id="student-nic" name="NIC" value="<?= htmlspecialchars($student->NIC) ?>" readonly>
                    <?php if (!empty($errors['NIC'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['NIC']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="degree-name">Degree Programme</label>
                    <select id="degree-name" name="DegreeName" disabled>
                        <option value="Computer Science" <?= $student->DegreeName == 'Computer Science' ? 'selected' : '' ?>>Computer Science</option>
                        <option value="Information System" <?= $student->DegreeName == 'Information System' ? 'selected' : '' ?>>Information System</option>
                    </select>
                    <?php if (!empty($errors['DegreeName'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['DegreeName']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="Status" disabled>
                        <option value="Not Applied" <?= $student->Status == 'Not Applied' ? 'selected' : '' ?>>Not Applied</option>
                        <option value="Pending" <?= $student->Status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Recruited" <?= $student->Status == 'Recruited' ? 'selected' : '' ?>>Recruited</option>
                    </select>
                    <?php if (!empty($errors['Status'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Status']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="student-email">Email</label>
                    <input type="text" id="student-email" name="Email" value="<?= htmlspecialchars($student->Email) ?>" readonly>
                    <?php if (!empty($errors['Email'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Email']) ?></span>
                    <?php endif; ?>
                </div>


                <div class="form-group">
                    <label for="contact-number">Contact Number</label>
                    <input type="text" id="contact-number" name="ContactNum" value="<?= htmlspecialchars($student->ContactNum) ?>" readonly>
                    <?php if (!empty($errors['ContactNum'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['ContactNum']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- <div class="form-group">
                    <label for="github">Github</label>
                    <input type="text" id="github" name="Github" value="<?= htmlspecialchars($student->Github) ?>" readonly>
                    <?php if (!empty($errors['Github'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['Github']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="linkedin">LinkedIn</label>
                    <input type="text" id="linkedin" name="Linkedin" value="<?= htmlspecialchars($student->Linkedin) ?>" readonly>
                    <?php if (!empty($errors['Linkedin'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['Linkedin']) ?></span>
                    <?php endif; ?>
                </div> -->

                </form>
                <div class="button-line">
                    <div class="action-buttons">
                        <button type='button' class='btn update-btn' id='save-btn-student' style='display: none;'>Save</button>
                        <button class="btn update-btn" id="edit-btn-student">Update</button>
                        <button class="btn back-btn" id="back-btn-student" onclick="history.back()">Back</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js?v=<?= time() ?>"></script>

</body>

</html>