
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/SendAdvertisements.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar")  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Advertisements</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <i class="fas fa-calendar-alt"></i>
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                        <a href='../Profile/dashboard'>
                            <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="logo" />
                            <p><span>WSO2</span>Company</p>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="main_container">
                    <div class="sub_container">
                        <div class="image">
                            <img src="<?php echo ROOT ?>/assets/img/interns.png" class="logo" />
                        </div>
                        <div class="inform">
                            <a href="../Advertisements/edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if (isset($data) && !empty($data)): ?>
                                <h4>Position:<span><?php echo $data[0]->position ?></span></h4>
                                <h4>Qualifications:<span><?php echo $data[0]->qualifications ?></span></h4>
                                <h4>Description:<span><?php echo $data[0]->description ?></span></h4>
                                <h4>Internship Period:<span><?php echo $data[0]->period ?></span></h4>
                                <h4>No of interns:<span><?php echo $data[0]->interns ?></span></h4>
                                <h4>Work type:<span><?php echo $data[0]->worktype ?></span></h4>
                                <h4>Application deadline:<span><?php echo $data[0]->deadline ?></span></h4>
                            <?php endif; ?>
                        <a href="../Advertisements/dashboard">
                            <button type="submit" class="sc_btn">
                                Post
                            </button>
                        </a>    
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>