<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/ViewComplaint.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Addcomplaint.css">
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
                        <h1>Complaints</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="m_main">
                    <div class="complaint-navbar">
                        
                        <div class="headcontainer">
                            <div class="m_content">
                                <a href="http://localhost/Gradlink/public/company/Complaint/dashboard" class="backbtn">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form id="descriptionForm" method="post" action="<?= ROOT ?>/company/Complaint/dashboard">
                        <!-- Topic Input -->
                        <label for="topic">Topic</label>
                        <input type="text" name="topic" id="topi" placeholder="Enter the topic" oninput="validateTopic()" required>

                        <!-- Description Textarea -->
                        <label for="description">Description </label>
                        <textarea required name="description" id="descriptio" cols="50" rows="5" oninput="validateDescription()"></textarea>

                        <span class="error-message" id="descriptionError"></span>
                        <span class="valid-message" id="descriptionValidMessage"></span>
                        <span class="error-message" id="topicError"></span>
                        <div class="button-container">
                            <button
                                type="submit"
                                id="submit">
                                Submit
                            </button>
                            <button type="button" id="clearButton" onclick="clearForm()">Clear Form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?=ROOT?>/assets/js/Student/newComplaint.js"></script>
</html>