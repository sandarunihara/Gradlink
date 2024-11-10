<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Fix.css"> 
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Studentsidebar.css"> 
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Dashboard.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <?php
        $UserId = $data['Student'] -> UserId;
        $Name = $data['Student'] -> Name;
        $Status = $data['Student'] -> Status;
        switch ($Status) {
            case '1':
                $StatusString = 'Pending';
                break;
            case '2':
                $StatusString = 'interview selected';
            case '3':
                $StatusString = 'doing Intern';
            default:
                //never occur
                break;
        }
        $Email = $data['Email'] -> Email;
    ?>
    <div class="side">
            <?php $this->renderComponent("studentsidebar")  ?>
    </div>
    <div id="content">
            <div class="main">
                <div class="d">
                    <div >
                        <h1>DashBoard</h1>
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
                
                <div>
                    <h2><p id="greeting"></p><?php echo($Name)?></h2>
                </div>

                <div class="d_main">
                    <div class="d_allsummery">
                        <div class="stats">
                            <div class="stat-card">
                                <a href="<?=ROOT?>/Student/StudentAppliedCompanies/AppliedCompanies" style = "text-decoration: none; color: inherit">
                                <h2>Applied Comapanies</h2>
                                <p>5</p>
                                </a>
                            </div>
                            <div class="stat-card">
                                <a href="../StudentScheduleInterview/dashboard" style = "text-decoration: none; color: inherit">
                                <h2>Schedule Interviews</h2>
                                <p>3</p>
                                </a>
                            </div>
                            <div class="stat-card">
                                <h2>Status: <?php echo($StatusString) ?></h2>
                                <h2>Email: <?php echo($Email) ?></h2>
                                <h2>Registration Number: <?php echo($UserId) ?></h2>
                                <h2>Round: 1 Round</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
<script>
    function greeting(){
        const currentHour = new Date().getHours();
        let greetingMessage;
        if (currentHour < 12){
            greetingMessage = "Good Morning";
        } else if (currentHour < 18){
            greetingMessage = "Good Afternoon";
        } else {
            greetingMessage = "Good Evening";
        }
        return greetingMessage;
    }
    document.getElementById("greeting").textContent = greeting();
</script>