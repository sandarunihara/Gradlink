<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/pdc_message.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $da='sda'; $this->renderComponent("companysidebar",['hasShortlisted'=>$_SESSION['hasShortlisted'],'hasRecruited'=>$_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Messages</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="m_main">
                    <div class="m_header">
                        <div class="sender">
                            <a href="http://localhost/Gradlink/public/company/Messages/dashboard" class="backbtn">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <img src="<?php echo ROOT ?>/assets/img/wso2.png" />
                            <div class="m_details">
                                <span class="m_name">PDC</span>
                                <span class="m_detail">Message</span>
                            </div>
                        </div>
                        <div class="m_timedate">
                            <span class="m_time">7.30 p.m</span>
                            <span class="m_date">2024/11/21</span>
                        </div>
                    </div>
                    <div class="m_content">
                        <div class="topic">
                            <h2>Opportunity to Post Internship Advertisements</h2>
                        </div>
                        <div class="message">
                            <p>Dear Company,</p>
                            <p>We are excited to announce that the internship season for our students has officially begun! This is a fantastic opportunity for your organization to connect with talented and enthusiastic candidates eager to gain industry experience.</p>
                            <p>How to Post Your Internship Advertisement:Log in to your company account on our portal.->Navigate to the "Advertisements" section in the sidebar.->Select the "Create Post" button.->Fill in the required details about the internship and submit your post.</p>
                            <p>Our team is here to assist you with the process and ensure your advertisement reaches the right audience.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>

</html>