<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/viewStudent.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div class="container">
    <?php $this->renderComponent("pdc_adminsidebar")  ?>
        
        <main class="content">
            <header class="header">
            <div class="student-title">
                    <h1>D.M Perera</h1>
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
                <form class="student-form">
                    <div class="form-group">
                        <label for="student-name">Student Name</label>
                        <input type="text" id="student-name" placeholder="D.M Perera" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" placeholder="regno@stu.ucsc.cmb.ac.lk" readonly>
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" placeholder="0771234567" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" placeholder="No, Lane, City, District" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="text" id="linkedin" placeholder="linkedin.com/company/codegen" readonly>
                    </div>

                </form>
                <div class="button-line">
                    <button class="view-progress-btn">View Progress</button>
                    <div class="action-buttons">
                        <button class="btn block-btn">Block</button>
                        <button class="btn update-btn">Update</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>