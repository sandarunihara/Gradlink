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
                        <!-- <?php
                                $senddate = date('Y-m-d', strtotime($data->created_at));
                                $sendtime = date('h:i A', strtotime($data->created_at));
                                ?> -->
                        <div class="m_timedate">
                            <!-- <span class="m_time"><?php echo $sendtime ?></span>
                            <span class="m_date"><?php echo $senddate ?></span> -->
                        </div>
                    </div>
                    <div class="chat-container">
                        <div class="m_content1" id="chat-messages">
                            <?php if (!empty($data)) : ?>
                                <?php foreach ($data as $message) : ?>
                                    <?php if ($message->actor_id !== $_SESSION['USER']->CompanyId): ?>
                                        <div class="message message-received">
                                            <div class="message-bubble">
                                                <?php echo $message->message ?>
                                                <span class="message-time"><?php echo $message->timestamp ?></span>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="message message-sent">
                                            <div class="message-bubble">
                                                <?php echo $message->message ?>
                                                <span class="message-time"><?php echo $message->timestamp ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No Massage </p>
                            <?php endif; ?>
                            <!-- More messages here -->
                        </div>
                        <form method="post" class="chat-input-area">
                            <input type="text" class="chat-input" name="companymessage" placeholder="Type your message...">
                            <button type="submit" class="chat-send-btn">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
            function scrollToBottom() {
                var chat = document.getElementById('chat-messages');
                if (chat) {
                    chat.scrollTop = chat.scrollHeight;
                }
            }

        // Scroll on page load
        window.onload = scrollToBottom;
    </script>
</body>

</html>