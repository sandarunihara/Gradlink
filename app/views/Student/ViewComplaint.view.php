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
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/ViewComplaint.css">
</head>
<body>
    <?php
        $Name = $data['Student'] -> Name;
        $ComplaintId = $data['Complaint'] -> ComplaintId;
        $Topic = $data['Complaint'] -> Topic;
        $Decsription = $data['Complaint'] -> Description;
        $Status = $data['Complaint'] -> Status;
        
        if($Status != "notReviewed"){
            $Reply = $data['CoordinatorComplaint'][0] -> Reply;
        }
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

            <div class="view-complaint-main">
                <a href="<?=ROOT?>/Student/StudentComplaint/complaint" class="backreq">
                    <i class="fas fa-chevron-left"></i>
                    <h3>back</h3>
                </a>
                <div class="complaint-container">
                    <div class="complaint-card">
                        <h2><?php echo $Topic?></h2>
                        <p><?php echo $Decsription?></p>
                        <p>Status: 
                            <span class="<?php echo $Status === 'notReviewed' ? 'notReviewed' : 'reviewed'; ?>">
                                <?php if($Status == "notReviewed") { ?>
                                    <?php echo "Not Reviewd"; ?>
                                <?php } else { ?>
                                    <?php echo "Reviewed"; ?>
                                <?php } ?>
                            </span>
                        </p>
                        <?php if($Status != "notReviewed") { ?>
                                <p>Reply:<?php echo $Reply?></p>
                                <a href="<?=ROOT?>/Student/StudentComplaint/deleteComplaint/<?php echo $ComplaintId; ?>"><button class="delete-complaint-button">Delete Complaint</button></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>