<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Studentsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/NewComplaint.css">

</head>
<body>
    <?php
        $Name = $data['Student'] -> Name;

    ?>
    <div class="side">
        <?php $this->renderComponent("studentsidebar")  ?>
    </div>
    <div id="content">
        <div class="main">
            <div class="d">
                <div >
                    <h1>Complaints</h1>
                </div>
                <div class="d_pro">
                    <div class="d_profile">
                        <i class="fas fa-calendar-alt"></i>
                        <i class="fas fa-bell"></i>
                    </div>
                    <div>
                        <a href="<?=ROOT?>/Student/StudentProfile/Profile">
                            <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($Name)?>.jpg" height ="400px" weight="400px"class="logo" />
                            <p><span><?php echo($Name)?></span>Student</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="c_main">
                <a href="<?=ROOT?>/Student/StudentComplaint/complaint" class="backreq">
                    <i class="fas fa-chevron-left"></i>
                    <h3>back</h3>
                </a>
                <div>
                    <form action="" method="post" onsubmit="return validateForm()">
                        <fieldset>
                            <legend><h2>New Complaint</h2></legend>
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date">
                            <span class="error-message" id="dateError"></span>
            
                            <label for="topic">Topic</label>
                            <input type="text" name="topic" id="topic">
                            <span class="error-message" id="topicError"></span>
                            
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30"></textarea>                            
                            <span class="error-message" id="descriptionError"></span>

                            <button type="submit">Submit</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            let isValid = true;

            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(msg => msg.textContent = '');

            // Validate date
            const date = document.getElementById('date').value;
            if (!date) {
                document.getElementById('dateError').textContent = "Please enter a date.";
                isValid = false;
            }

            // Validate topic
            const topic = document.getElementById('topic').value.trim();
            if (!topic) {
                document.getElementById('topicError').textContent = "Please enter a topic.";
                isValid = false;
            }

            // Validate description
            const description = document.getElementById('description').value.trim();
            if (!description) {
                document.getElementById('descriptionError').textContent = "Please enter a description.";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>