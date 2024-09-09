<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/company.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="body ">
    <div class="side">
        <img src="<?php echo ROOT ?>/assets/img/glogo.png" height="200" width="200" class="logo" />
        <?php $this->renderComponent("companysidebar")  ?>
    </div>
    <div id="content">
    <div class="main">
    <div class="d">
        <div class="d_topic">
            <h1>DashBoard</h1>
        </div>
        <div class="d_pro">
            <div>
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div>
                <i class="fas fa-bell"></i>
            </div>
            <div>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>
    </div>
    <div class="d_main">
        <div class="d_allsummery">
            <div class="d_summery">
                <p>Total Student Applied</p>
                <p>200</p>
            </div>
            <div class="d_summery">
                <p>Total Student Shortlisted</p>
                <p>40</p>
            </div>
            <div class="d_summery">
                <p>Total Advertisements</p>
                <p>40</p>
            </div>
            <div class="d_request">
                <h3>Student Requests</h3>
                <div class="d_alllist">
                    <ul>
                        <li>
                            <span class="role">Sandaru Nihara</span>
                            <span class="role">Software Engineering</span>
                            <span class="status shortlisted">Shortlisted</span>
                        </li>
                        <li>
                            <span class="role">Sandaru Nihara</span>
                            <span class="role">QA</span>
                            <span class="status rejected">Rejected</span>
                        </li>
                        <li>
                            <span class="role">Sandaru Nihara</span>
                            <span class="role">Web Engineering</span>
                            <span class="status pending">Pending</span>
                        </li>
                        <li>
                            <span class="role">Sandaru Nihara</span>
                            <span class="role">Software Engineering</span>
                            <span class="status recruited">Recruited</span>
                        </li>
                        <li>
                            <span class="role">Sandaru Nihara</span>
                            <span class="role">QA</span>
                            <span class="status rejected">Rejected</span>
                        </li>
                        <li>
                            <span class="role">Sandaru Nihara</span>
                            <span class="role">Web development</span>
                            <span class="status recruited">Recruited</span>
                        </li>
                    </ul>
                </div>
                <div class="d_view_all">
                    <a href="#">
                        View All
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="d_infor">
            <img src="<?php echo ROOT ?>/assets/img/company_dashboard.png" width="350" height="200" />
            <div class="d_intr">
                <div>
                    <h4>Simplified Management</h4>
                    <img src="<?php echo ROOT ?>/assets/img/company_dashboard2.png" width="300" height="170" />
                    <p>Easily manage internships with our intuitive system. Post opportunities, review applications, and track progress—all in one place.
                        Our platform makes recruitment quick and efficient, helping you find the right talent effortlessly.</p>
                </div>


            </div>

        </div>
    </div>
</div>
    </div>


</body>
</html>



