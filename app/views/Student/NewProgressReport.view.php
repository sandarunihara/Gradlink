<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/Fix.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/Studentsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/NewProgressReport.css">

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
                    <h1>Add Progress report</h1>
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

            <div class="new-report-main">
                <a href="<?=ROOT?>/Student/StudentProgress/progressReport" class="backreq">
                    <i class="fas fa-chevron-left"></i>
                    <h3>back</h3>
                </a>
                <div>
                    <form action="" method="post" onsubmit="return validateForm()">
                        <fieldset>
                            <legend><h2>New Report</h2></legend>
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date">
                            <span class="error-message" id="dateError"></span>
            
                            <label for="topic">Tittle</label>
                            <input type="text" name="topic" id="topic">
                            <span class="error-message" id="topicError"></span>
                            
                            <label for="report" class="file-upload-label">Report</label>
                            <input type="file" name="report" id="report">
                            <span class="error-message" id="reportError"></span>
                            <span id="fileNameDisplay" class="file-name"></span>
                            <br>
                            <button type="submit">Submit</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>