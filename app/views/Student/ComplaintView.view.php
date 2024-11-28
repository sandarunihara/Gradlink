<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/complaintView.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/backIcon.css">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php
        $complaintId = $data['Complaint'] -> ComplaintId;
        $description = $data['Complaint'] -> Description;
        $status = $data['Complaint'] -> Status;
        $delete = $data['Complaint'] -> Delete;
    ?>
    <div class="side">
        <?php $this->renderComponent("studentSidebar")  ?>
    </div>
    <div class="content">
        <div class="header">
            <?php $this->renderComponent("studentHeader")  ?>
        </div>
        <div class="main-content">
            <a href="<?=ROOT?>/Student/StudentComplaint/complaint" class="backreq">
                <svg class="back-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
                <h3>Back</h3>
            </a>
            <div id="view-complaint-box">
                <div class="complaint-description-box">
                    <h2>Complaint Description</h2>
                    <p class="complaint-description">
                        <?=$description?>
                    </p>
                </div>
                <div class="complaint-description-box">
                    <h2>Coordinator's Response</h2>
                    <p class="complaint-description">
                        <?php
                        if($status === "notReviewed"){
                            echo "No response yet";
                        }else{
                            $reply = $data['CoordinatorComplaint'] -> Reply;
                            echo $reply;
                        }
                        ?>
                    </p>
                </div>
                <?php
                    if($delete == 1){
                ?>
                    <a href="<?=ROOT?>/Student/StudentComplaint/deleteComplaint/<?php echo $complaintId?>">
                        <button id="complaintDleteBtn">Delete Complaint</button>
                    </a>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>


