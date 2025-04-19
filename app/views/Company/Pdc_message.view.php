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
            <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
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
                            <img src="<?php echo ROOT ?>/assets/img/Company/pdcphoto.jpg" />
                            <div class="m_details">
                                <span class="m_name">PDC</span>
                                <span class="m_detail">Message</span>
                            </div>
                        </div>
                        <?php
                        $senddate = date('Y-m-d', strtotime($data->created_at));
                        $sendtime = date('h:i A', strtotime($data->created_at));
                        ?>
                        <div class="m_timedate">
                            <span class="m_time"><?php echo $sendtime ?></span>
                            <span class="m_date"><?php echo $senddate ?></span>
                        </div>
                    </div>
                    <?php
                    $subject = "Session Notification - UCSC TechTalk: \"{$data->session_name}\"";
                    ?>

                    <div class="m_content">
                        <div class="topic">
                            <h2><?php echo $subject; ?></h2>
                        </div>

                        <div class="message">
                            <p>Dear Company <?php echo htmlspecialchars($data->Name); ?>,</p>

                            <p>
                                We are pleased to confirm your participation in the upcoming UCSC TechTalk event. This platform aims to bridge the gap between academia and the tech industry by offering students the opportunity to engage directly with professionals and organizations like yours.
                            </p>

                            <div class="session-info-box">
                                <p><strong>Session Title:</strong> <?php echo $data->session_name; ?></p>
                                <p><strong>Date:</strong> <?php echo date("F j, Y", strtotime($data->session_date)); ?></p>
                                <p><strong>Hall Number:</strong> <?php echo $data->hall_number; ?></p>
                                <p><strong>Time Slot:</strong> <?php echo $data->time_slot; ?></p>
                            </div>

                            <?php if (!empty($data->description)): ?>
                                <p><strong>Session Overview:</strong> <?php echo $data->description; ?></p>
                            <?php endif; ?>

                            <p>
                                We kindly request you to be present at the venue at least 15 minutes prior to your scheduled time for final arrangements. Your contribution to this event is highly valued, and we believe your session will greatly benefit our students and attendees.
                            </p>

                            <p>
                                Should you have any queries, logistical requirements, or need further assistance, please feel free to contact our organizing team at any time.
                            </p>

                            <p>
                                Thank you once again for your involvement in UCSC TechTalk. We look forward to welcoming you to our campus and witnessing an insightful session.
                            </p>

                            <p>Regards,<br><strong>UCSC PDC</strong></p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- <?php




        // Output in a <p> tag
        echo "<p>$message</p>";
        ?>
 -->