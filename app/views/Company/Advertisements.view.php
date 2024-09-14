<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Advertisements.css">
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
                <div>
                    <div class="overview">
                        <h2>Overview</h2>
                        <div class="stats">
                            <div class="stat-card">
                                <h2>Total Student Applied</h2>
                                <p>200</p>
                            </div>
                            <div class="stat-card">
                                <h2>Active Advertisements</h2>
                                <p>40</p>
                            </div>
                            <div class="stat-card">
                                <h2>Deactive Advertisements</h2>
                                <p>5</p>
                            </div>
                        </div>
                        <div class="posts">
                            <h2>Posts</h2>
                            <div class="ss_create">
                            <a href="../Advertisements/create">
                                <button>
                                    <i class="fas fa-plus"></i>
                                    <h4>Create Posts</h4>
                                </button>
                            </a>
                        </div>     
                        </div>
                        <div class="postcard" >
                            <div class="image">
                                <img src="<?php echo ROOT ?>/assets/img/interns.png" class="logo" />
                                <a href="../Advertisements/send" class="top-left-link">View</a>
                            </div>    
                            <div class="postdetails">
                                <p>Position:<span>Web Developer</span></p>
                                <p>type:<span>Onsite</span></p>
                                <p>No of interns:<span>5</span></p>
                                <p>Periods:<span>6 months</span></p>
                                <p>Deadline:<span>2024-12-31</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>