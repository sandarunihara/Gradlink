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
                        <h4>Position:<span>Web Developer</span></h4>
                        <h4>Qualifications:<span>Candidates must be pursuing a degree in Computer Science or a related field, have a basic understanding of programming languages like Java, Python, or JavaScript, and be familiar with web technologies such as HTML, CSS, and React</span></h4>
                        <h4>Description:<span>The intern will assist in developing, testing, and maintaining web applications, ensuring the functionality aligns with business requirements.</span></h4>
                        <h4>Internship Period:<span>6 Months</span></h4>
                        <h4>No of interns:<span>5</span></h4>
                        <h4>Work type:<span>Onsite</span></h4>
                        <h4>Application deadline:<span>2024-12-31</span></h4>
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