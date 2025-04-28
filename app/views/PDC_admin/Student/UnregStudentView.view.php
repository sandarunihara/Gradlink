<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/viewCompany.css?v=<?= time() ?>">
    
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
        <div class="sidebar">
            <?php $this->renderComponent("pdc_adminsidebar") ?>
        </div>
        <main class="content">
            <div class="profile-header">
            <img src="<?= ROOT ?>/assets/img/Student/<?= htmlspecialchars($data->ProfilePic ?? 'default-profile.png') ?>" alt="Profile Image" class="profile-image">
            <div class="profile-title">
                    <h1><?= htmlspecialchars($data['StudentId']) ?></h1>
                    <span class="status <?= $data['Status'] === 'Blocked' ? 'status-blocked' : ($data['Status'] === 'Pending' ? 'status-pending' : 'status-active') ?>">
                        <i class="fas fa-<?= $data['Status'] === 'Blocked' ? 'ban' : ($data['Status'] === 'Pending' ? 'clock' : 'check-circle') ?>"></i>
                        <?= htmlspecialchars($data['Status']) ?>
                    </span>
                </div>
            </div>

            <div class="student-details">
                <div class="detail-card">
                    <h3><i class="fas fa-id-card"></i> Basic Information</h3>
                    <div class="detail-item">
                        <span class="detail-label">Registration Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['StudentId']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">NIC Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['NIC']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Degree Program</span>
                        <div class="detail-value"><?= htmlspecialchars($data['DegreeName']) ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Contact Number</span>
                        <div class="detail-value"><?= htmlspecialchars($data['ContactNum']) ?></div>
                    </div>
                </div>

                <div class="detail-card">
                    <h3><i class="fas fa-envelope"></i> Contact Information</h3>
                    <div class="detail-item">
                        <span class="detail-label">Email Address</span>
                        <div class="detail-value"><?= htmlspecialchars($data['Email']) ?></div>
                    </div>

                </div>
            </div>

             <div class="action-buttons">
                <button class="btn btn-outline" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js?v=<?= time() ?>"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
    <script>
        function openUpdateform(){
            document.getElementById('updateModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideUpdateForm(){
            document.getElementById('updateModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        function blockStudent(StudentId) {
            document.getElementById("student-id").value = StudentId;
            document.getElementById("block-modal").classList.add("active");
        }

        function unblockStudent(StudentId) {
            document.getElementById("unblock-student-id").value = StudentId;
            document.getElementById("unblock-modal").classList.add("active");
        }

        function closeModal() {
            document.getElementById("block-modal").classList.remove("active");
            document.getElementById("unblock-modal").classList.remove("active");
            document.getElementById("block-reason").value = "";
            document.getElementById("modal-message").textContent = "";
        }


        const studentUpdateForm = document.getElementById('studentUpdateForm');
        
        studentUpdateForm.addEventListener('submit' , function(e){

            let haserrorUpdate = false

            const errors = document.querySelectorAll('.error-message');
            errors.forEach(msg => msg.style.display = 'none');

            const studentName = document.getElementById('name')
            if(studentName.value.trim() === ""){
                studentName.nextElementSibling.style.display = 'block'
                haserrorUpdate = true
            }


        // } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {


            const studentEmail = document.getElementById('email');
            const emailError = studentEmail.closest('.form-group').querySelector('.error-message');

            if(studentEmail.value.trim() === ""){
                emailError.style.display = 'block';
                haserrorUpdate = true;
            } else {
                emailError.style.display = 'none';
            }

            const studentId = document.getElementById('studentId');
            const studentIdValue = studentId.value.trim()
            if(studentIdValue === ""){
                studentId.parentElement.querySelector('.error-message.basic').style.display = 'block'
                haserrorUpdate = true
            }
            else if(!/^\d{4}(cs|is)\d{3}$/.test(studentIdValue)){
                studentId.parentElement.querySelector('.error-message.pattern').style.display = 'block'
                haserrorUpdate = true
            }

            const studentnic = document.getElementById('nic');
            const studentnicValue = studentnic.value.trim()
            if(studentnicValue === ""){
                studentnic.parentElement.querySelector('.error-message.basic').style.display = 'block'
                haserrorUpdate = true
            }
            else if(!/^\d{12}$/.test(studentnicValue)){
                studentnic.parentElement.querySelector('.error-message.pattern').style.display = 'block'
                haserrorUpdate = true
            }

            const number = document.getElementById('contact');
            const numberValue = number.value.trim();
            if (numberValue === "") {
                number.parentElement.querySelector('.error-message.basic').style.display = 'block';
                haserrorUpdate = true;
            } else if (!/^\d{10}$/.test(numberValue)) {
                number.parentElement.querySelector('.error-message.pattern').style.display = 'block';
                haserrorUpdate = true;
            }

            if(haserrorUpdate){
                e.preventDefault()
            }

        })


    </script>
</body>
</html>