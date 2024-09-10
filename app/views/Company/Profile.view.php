<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/profile.css">
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
                        <h1>Profile</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <i class="fas fa-calendar-alt"></i>
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="logo" />
                            <p><span>WSO2</span>Company</p>
                        </div>
                    </div>
                </div>
                <div class="pro_main">
                    <!-- white part -->
                    <div class="whitepart">
                        <div class="pro_head">
                            <p>WSO2</p>
                            <i class="fab fa-linkedin"></i>
                        </div>
                        <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="pro_logo" />
                        <p class="welcomemsg">Welcome to <span>WSO2</span></p>
                        <p class="gmsg">Sparking innovation, one sprint at a time.</p>
                        <span>Eshtablished Date: 2000-08-08</span>
                        <div class="address">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>105, Bauddhaloka Mawatha, Colombo 4.</p>
                        </div>
                    </div>
                    <!-- blue part -->
                    <div class="otherpart">
                        <p class="top">Digital engineering is in our DNA. It's at the heart of
                        <p class="description">Each day, we help clients engage with new technology paradigms, creatively building
                        solutions that move them to the forefront of their industry.</p>
                        <div class="visitsite">
                            <a class="web">Visit Website</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

