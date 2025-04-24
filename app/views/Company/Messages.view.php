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
                    <?php if (!empty($data)) : ?>
                        <!-- sort data -->
                        <?php
                        usort($data, function ($a, $b) {
                            return strtotime($b->created_at) - strtotime($a->created_at);
                        });
                        ?>

                        <?php foreach ($data as $item): ?>
                            <?php
                            $detail = $item->detail;
                            $senddate = date('Y-m-d', strtotime($item->created_at));
                            $sendtime = date('h:i A', strtotime($item->created_at));

                            ?>

                            <a href="../Messages/pdc_message/<?php echo $item->session_id ?>" class="m_container">
                                <div class="m_de">
                                    <?php if ($item->message_read == 0) : ?>
                                        <div class="readmessage">
                                        </div>
                                    <?php else : ?>
                                        <div class="unreadmessage">
                                        </div>
                                    <?php endif ?>
                                    <img src="<?php echo ROOT ?>/assets/img/Company/pdcphoto.jpg" class="image" />
                                    <div class="m_content">
                                        <span class="m_name">PDC</span>
                                        <span class="m_detail"><?php echo $detail; ?></span>
                                        <span class="m_time"><?php echo $senddate; ?> <?php echo $sendtime; ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>

                        <?php if ($message_coodinator == 1): ?>
                            <a href="../Messages/coordinatormessage" class="m_container">
                                <div class="m_de">
                                    <img src="<?php echo ROOT ?>/assets/img/Company/pdcphoto.jpg" class="image" />
                                    <div class="m_content">
                                        <span class="m_name">PDC Coordinator</span>
                                        <?php if ($message_count != 0): ?>
                                            <span class="m_time" style="color:rgb(0, 95, 24);">+<?php echo $message_count ?> Unread Messages</span>
                                            <?php else : ?>
                                                <span class="m_time" style="color:rgb(0, 0, 0);">No Unread Messages</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>

                    <?php else : ?>
                        <p class="no-events">No Message found</p>
                    <?php endif ?>

                </div>
            </div>

        </div>
    </div>
</body>

</html>