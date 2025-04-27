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
                            <input type="text" id="student-id" name="StudentId" placeholder="2022cs021">
                            <small class="format-hint">Format: 4 numbers, 2 letters, 3 numbers (e.g., 2022cs021)</small>
                            <p class="error-message basic">Student ID cannot be empty</p>
                            <p class="error-message pattern">Student ID not valid pattern</p>
                        </div>

                        <div class="form-group">
                            <label for="student-nic">Student NIC</label>
                            <input type="text" id="student-nic" name="NIC" placeholder="Student NIC"
                                >
                            <small class="format-hint">Format: 12 digits (e.g., 200156789012)</small>
                            <p class="error-message basic">NIC cannot be empty</p>
                            <p class="error-message pattern">NIC ID not valid pattern</p>
                        </div>

                        <div class="form-group">
                            <label for="student-name">Student Name</label>
                            <input type="text" id="student-name" name="Name" placeholder="Student Name">
                            <p class="error-message">Student Name cannot be empty</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="student-email">Email</label>
                            <input type="email" id="student-email" name="Email" placeholder="Student Email">
                            <p class="error-message">Student Email cannot be empty</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="degree-name">Degree Name</label>
                            <select id="degree-name" name="DegreeName" required>
                                <option value="" disabled >Select Degree</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Information System">Information System</option>
                            </select>
                            <p class="error-message">Select a Degree Name empty</p>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="Status" >
                                <option value="" disabled >Select Status</option>
                                <option value="Not Applied">Not Applied</option>
                                <option value="Pending">Pending</option>
                                <option value="Recruited">Recruited</option>
                            </select>
                            <p class="error-message">Select a Status</p>
                        </div>

                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="text" id="contact-number" name="ContactNum" placeholder="0771234567"
                                >
                            <small class="format-hint">Enter a valid phone number (e.g. 0733333333)</small>
                            <p class="error-message basic">Contact Number cannot be empty</p>
                            <p class="error-message pattern">Contact Number not valid pattern</p>

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

    <script>

        const studentform = document.querySelector('.company-form')

        studentform.addEventListener('submit' , function(e){

            let haserror = false

            const errors = document.querySelectorAll('.error-message');
            errors.forEach(msg => msg.style.display = 'none');

            const studentId = document.getElementById('student-id');
            const studentIdValue = studentId.value.trim()
            if(studentIdValue === ""){
                studentId.parentElement.querySelector('.error-message.basic').style.display = 'block'
                haserror = true
            }
            else if(!/^\d{4}(cs|is)\d{3}$/.test(studentIdValue)){
                studentId.parentElement.querySelector('.error-message.pattern').style.display = 'block'
                haserror = true
            }

            const studentnic = document.getElementById('student-nic');
            const studentnicValue = studentnic.value.trim()
            if(studentnicValue === ""){
                studentnic.parentElement.querySelector('.error-message.basic').style.display = 'block'
                haserror = true
            }
            else if(!/^\d{12}$/.test(studentnicValue)){
                studentnic.parentElement.querySelector('.error-message.pattern').style.display = 'block'
                haserror = true
            }

            const studentName = document.getElementById('student-name')
            if(studentName.value.trim() === ""){
                studentName.nextElementSibling.style.display = 'block'
                haserror = true
            }

            const studentEmail = document.getElementById('student-email')
            if(studentEmail.value.trim() === ""){
                studentEmail.nextElementSibling.style.display = 'block'
                haserror = true
            }

            const degree = document.getElementById('degree-name')
            if(degree.value.trim() === ""){
                degree.nextElementSibling.style.display = 'block'
                haserror = true
            }

            const status = document.getElementById('status')
            if(status.value.trim() === ""){
                status.nextElementSibling.style.display = 'block'
                haserror = true
            }

            const number = document.getElementById('contact-number');
            const numberValue = number.value.trim();
            if (numberValue === "") {
                number.parentElement.querySelector('.error-message.basic').style.display = 'block';
                haserror = true;
            } else if (!/^\d{10}$/.test(numberValue)) {
                number.parentElement.querySelector('.error-message.pattern').style.display = 'block';
                haserror = true;
            }

            if(haserror){
                e.preventDefault()
            }
        })

    </script>

</body>
</html>