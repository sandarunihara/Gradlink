<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Complaint</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/newComplaint.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="side">
        <?php $this->renderComponent("studentSidebar")  ?>
    </div>
    <div class="content">
        <div class="header">
            <?php $this->renderComponent("studentHeader")  ?>
        </div>
        <div class="main-content">
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
</body>
</html>


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