<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/complaintView.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/ComplaintConferm.css"> 

    <script src="<?php echo ROOT ?>/assets/js/student/toast.js"></script> 
</head>
<body>
    <?php
        $complaintId = $data['Complaint'] -> ComplaintId;
        $description = $data['Complaint'] -> Description;
        $status = $data['Complaint'] -> Status;
        $delete = $data['Complaint'] -> Delete;
    ?>
    <?php $this->renderComponent("studentHeader" , ["title" => "Complaint"])  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
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
            <button id="complaintDeleteBtn">Delete Complaint</button>
            <?php
                }
            ?>
        </div>
    </div>
    <?php $this->renderComponent("studentComplaintConferm", 
    ["url" => ROOT . "/Student/StudentComplaint/deleteComplaint?complaintId=" . $complaintId, 
        "button" => "complaintDeleteBtn",
        "message" => "Do you want to delete the complaint?"
    ]) ?>
    <script>
        const complaintDeleteBtn = document.getElementById('complaintDeleteBtn');

    </script>
</body>
</html>



