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
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
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
            <div class="container">
                <form id="descriptionForm" method="post">
                    <!-- Topic Input -->
                    <label for="topic">Topic</label>
                    <input type="text" name="topic" id="topic" placeholder="Enter the topic" oninput="validateTopic()" required>

                    <!-- Description Textarea -->
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="50" rows="5" oninput="validateDescription()"></textarea>
                    
                    <span class="error-message" id="descriptionError"></span>
                    <span class="valid-message" id="descriptionValidMessage"></span>
                    <span class="error-message" id="topicError"></span>
                    <div class="button-container">
                        <button 
                            type="submit" 
                            id="submitButton" 
                            disabled 
                            onclick="location.href='<?=ROOT?>/Student/StudentComplaint/newComplaint';"
                        >                            
                        Submit
                        </button>
                        <button type="button" id="clearButton" onclick="clearForm()">Clear Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Toast -->
    <?php if(array_key_exists('result', $data)): ?>
        <div id="toast-container" class="toast-container"></div>

        <?php if ($data['result']): ?>
            <script>
                successToast("Successfully added complaint");
            </script>
        <?php else: ?>
            <script>
                errorToast("Failed to add complaint");
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script> 
    <script src="<?=ROOT?>/assets/js/Student/newComplaint.js"></script>
</body>
</html>
