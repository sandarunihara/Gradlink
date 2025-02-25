<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Schedule.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Interview Schedule</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="sr_main">
                    <div class="sr_search">
                        <h3>Schedule</h3>
                    </div>
                    <div class="s_background">
                        <?php if (!empty($data)) : ?>
                            <?php foreach ($data as $slot) : ?>
                                <div class="s_table">
                                    <div class="de_list">
                                        <p>Position : <span><?php echo $slot['Position']; ?></span></p>
                                        <p>Student Name :<span> <?php echo $slot['StudentName']; ?></span></p>
                                        <p>Date : <span><?php echo $slot['Date']; ?></span></p>
                                        <p>Time : <span><?php echo $slot['StartTime']; ?> to <?php echo $slot['EndTime']; ?></span></p>
                                    </div>
                                    <a class="s_delnedit" href="http://localhost/Gradlink/public/company/Schedule/editschedule/<?php echo $slot['advertisementId']?>/<?php echo $slot['StudentId']?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </div>
                                
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No Schedule available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script>
        // toast model
    </script>
</body>

</html>