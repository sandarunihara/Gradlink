<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Complaint</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
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
            <div class="container">
                <form id="form" action="<?=ROOT?>/Student/StudentComplaint/newComplaint" method="post"  enctype="multipart/form-data">
                    <!-- Topic Input -->
                    <label for="topic">Topic</label>
                    <input type="text" name="topic" id="topic" placeholder="Enter the topic">

                    <!-- Description Textarea -->
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="50" rows="5"></textarea>
                    
                    <span class="error-message" id="errorMessage"></span>
                    <div class="button-container">
                        <button 
                            type="submit" 
                            id="submitButton" 
                        >                            
                        Submit
                        </button>
                        <button type="button" id="clearButton" onclick="clearForm()">Clear Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/Student/newComplaint.js"></script>
</body>
</html>
