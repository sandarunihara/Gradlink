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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">

</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        <main class="content">
            <header class="header">
            <div class="student-title">
                    <h1><?= htmlspecialchars($data['Name']) ?></h1>
                </div>
            </header>
            <section class="student-info">

                <form class="student-form" id="student-form" method='POST' action="<?= ROOT ?>/PDC_admin/ViewStudent/edit/<?= $data['StudentId'] ?>">
                
                <div class="form-group">
                    <label for="student-id">Registration Number</label>
                    <input type="text" id="student-id" name="StudentId" value="<?= htmlspecialchars($data['StudentId']) ?>" readonly>
                    <?php if (!empty($errors['StudentId'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['StudentId']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="student-name">Student Name</label>
                    <input type="text" id="student-name" name="Name" value="<?= htmlspecialchars($data['Name']) ?>" readonly>
                    <?php if (!empty($errors['Name'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Name']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="student-nic">Student NIC</label>
                    <input type="text" id="student-nic" name="NIC" value="<?= htmlspecialchars($data['NIC']) ?>" readonly>
                    <?php if (!empty($errors['NIC'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['NIC']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="degree-name">Degree Programme</label>
                    <select id="degree-name" name="DegreeName" disabled>
                        <option value="Computer Science" <?= $data['DegreeName'] == 'Computer Science' ? 'selected' : '' ?>>Computer Science</option>
                        <option value="Information System" <?= $data['DegreeName'] == 'Information System' ? 'selected' : '' ?>>Information System</option>
                    </select>
                    <?php if (!empty($errors['DegreeName'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['DegreeName']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="Status" disabled>
                        <option value="Not Applied" <?= $data['Status'] == 'Not Applied' ? 'selected' : '' ?>>Not Applied</option>
                        <option value="Pending" <?= $data['Status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Recruited" <?= $data['Status'] == 'Recruited' ? 'selected' : '' ?>>Recruited</option>
                    </select>
                    <?php if (!empty($errors['Status'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Status']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="student-email">Email</label>
                    <input type="text" id="student-email" name="Email" value="<?= htmlspecialchars($data['Email']) ?>" readonly>
                    <?php if (!empty($errors['Email'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['Email']) ?></span>
                    <?php endif; ?>
                </div>


                <div class="form-group">
                    <label for="contact-number">Contact Number</label>
                    <input type="text" id="contact-number" name="ContactNum" value="<?= htmlspecialchars($data['ContactNum']) ?>" readonly>
                    <?php if (!empty($errors['ContactNum'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['ContactNum']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="github">Github</label>
                    <input type="text" id="github" name="Github" value="<?= htmlspecialchars($data['Github']) ?>" readonly>
                    <?php if (!empty($errors['Github'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['Github']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="linkedin">LinkedIn</label>
                    <input type="text" id="linkedin" name="Linkedin" value="<?= htmlspecialchars($data['Linkedin']) ?>" readonly>
                    <?php if (!empty($errors['Linkedin'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['Linkedin']) ?></span>
                    <?php endif; ?>
                </div>

                <p class='appiled'>
                <div class="form-group">
                    <label for="linkedin">Applied Companies</label>
                    <div class="applied-companies">
                        <?php if (empty($data['applications'])): ?>
                            <p>No companies applied</p>
                        <?php else: ?>
                            <?php foreach ($data['applications'] as $application): ?>
                                <div class="company-card">
                                    <div class="card-header">
                                        <img src="data:image/jpeg;base64,<?= htmlspecialchars($application['CompanyLogo']) ?>" alt="Company Image" >
                                        <h3 class="company-name"><?= htmlspecialchars($application['ComName']) ?></h3>
                                        <span class="job-status <?= strtolower(str_replace(' ', '-', htmlspecialchars($application['Jobstatus']))) ?>">
                                            <?= htmlspecialchars($application['Jobstatus']) ?>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Position:</strong> <?= htmlspecialchars($application['position']) ?></p>
                                        <p><strong>Applied On:</strong> <?= htmlspecialchars($application['CreatedAt']) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                </p>

                

                </form>
                <div class="button-line">
                    <div class="action-buttons">
                        <button type='button' class='btn update-btn' id='save-btn-student' style='display: none;'>Save</button>
                        <button class="btn update-btn" id="edit-btn-student">Update</button>
                        <button class="btn back-btn" id="back-btn-student" onclick="history.back()">Back</button>
                        <?php if ($data['Status'] === 'Blocked'): ?>
                            <button class='btn unblock-btn' id='unblock-btn-student' onclick="unblockStudent('<?= htmlspecialchars($data['StudentId']) ?>')">Unblock</button> 
                        <?php else: ?>
                            <button class='btn block-btn' id='block-btn-student' onclick="blockStudent('<?= htmlspecialchars($data['StudentId']) ?>')">Block</button>
                        <?php endif; ?>
                        </div>
                </div>
            </section>
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js?v=<?= time() ?>"></script>

</body>

</html>





