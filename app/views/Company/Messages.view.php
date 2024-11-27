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
            <?php $this->renderComponent("companysidebar",['hasShortlisted'=>$_SESSION['hasShortlisted'],'hasRecruited'=>$_SESSION['hasRecruited']])  ?>
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
                    <?php
                    $details = [
                        "Tech Talk" => "../Messages/TechTalk",
                        "Intern Call" => "../Messages/pdc_message",
                    ];

                    $data = [
                        ["name" => "PDC", "detail" => "Tech Talk", "time" => "7:34 PM"],
                        ["name" => "PDC", "detail" => "Intern Call", "time" => "7:34 PM"],
                    ];
                    ?>

                    <?php foreach ($data as $item): ?>
                        <?php
                        $detail = $item['detail'];
                        $link = isset($details[$detail]) ? $details[$detail] : "#";
                        ?>
                        <a href="<?php echo $link; ?>" class="m_container">
                            <div class="m_de">
                                <img src="<?php echo ROOT ?>/assets/img/wso2.png" />
                                <div class="m_content">
                                    <span class="m_name"><?php echo $item['name']; ?></span>
                                    <span class="m_detail"><?php echo $detail; ?></span>
                                    <span class="m_time"><?php echo $item['time']; ?></span>
                                </div>
                            </div>

                            <div class="time_div">
                                <i class="fas fa-close"></i>
                            </div>
                        </a>
                    <?php endforeach; ?>


                </div>
            </div>
            
        </div>
    </div>
</body>

</html>