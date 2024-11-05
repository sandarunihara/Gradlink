<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Message.css">
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
                        <h1>Messages</h1>
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
                <div class="m_main">
                    <div class="m_container">
                        <div class="m_de">
                        <img src="<?php echo ROOT ?>/assets/img/wso2.png" />
                        <div class="m_content">
                            <span class="m_name">Sandaru Nihara</span>
                            <span class="m_detail">Progress report</span>
                            <span class="m_time">2:30 PM</span>
                        </div>
                        </div>
                        <div class="time_div">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <div class="m_container">
                        <div class="m_de">
                        <img src="<?php echo ROOT ?>/assets/img/wso2.png" />
                        <div class="m_content">
                            <span class="m_name">PDC</span>
                            <span class="m_detail">TechTalk Schedule</span>
                            <span class="m_time">4:30 PM</span>
                        </div>
                        </div>
                        <div class="time_div">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <div class="m_container">
                        <div class="m_de">
                        <img src="<?php echo ROOT ?>/assets/img/wso2.png" />
                        <div class="m_content">
                            <span class="m_name">Kavindu Gunarathne</span>
                            <span class="m_detail">Progress report</span>
                            <span class="m_time">1:00 PM</span>
                        </div>
                        </div>
                        <div class="time_div">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <div class="m_container">
                        <div class="m_de">
                        <img src="<?php echo ROOT ?>/assets/img/wso2.png" />
                        <div class="m_content">
                            <span class="m_name">Imandi Muthugala</span>
                            <span class="m_detail">Progress report</span>
                            <span class="m_time">5:12 PM</span>
                        </div>
                        </div>
                        <div class="time_div">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <div class="m_container">
                        <div class="m_de">
                        <img src="<?php echo ROOT ?>/assets/img/wso2.png" />
                        <div class="m_content">
                            <span class="m_name">PDC</span>
                            <span class="m_detail">Intern Call</span>
                            <span class="m_time">7:34 PM</span>
                        </div>
                        </div>
                        <div class="time_div">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>