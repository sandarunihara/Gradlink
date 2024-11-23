<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Schedule.css">
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
                        <h1>Students Requests</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="sr_main">
                    <div class="sr_search">
                        <h3>Interview Schedule</h3>
                        <div class="ss_create">
                            <a href="../Schedule/Create">
                                <button>
                                    <i class="fas fa-plus"></i>
                                    <h4>Create Schedule</h4>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="s_background">
                        <div class="s_table">
                            <div>
                                <p>Position : <span>Software Engineering</span></p>
                                <p>Date Period : <span>2024-09-12 to 2024-09-30</span></p>
                                <p>Interview Availability</p>
                                <ul>
                                    <li>Monday: 9:00 AM to 12:00 PM</li>
                                    <li>Tuesday: 1:00 PM to 5:00 PM</li>
                                    <li>Wednesday: 9:00 AM to 5:00 PM</li>
                                </ul>
                            </div>
                            <div class="s_delnedit">
                                <i class="fas fa-pencil-alt"></i>
                                <i class="fas fa-trash-alt fa-trash-alty"></i>
                            </div>
                        </div>
                        <div class="s_table">
                            <div>
                                <p>Position : <span>Software Engineering</span></p>
                                <p>Date Period : <span>2024-09-12 to 2024-09-30</span></p>
                                <p>Interview Duration: <span>30-minute time slots</span></p>
                                <p>Interview Availability</p>
                                <ul>
                                    <li>Monday: 9:00 AM to 12:00 PM</li>
                                    <li>Tuesday: 1:00 PM to 5:00 PM</li>
                                    <li>Wednesday: 9:00 AM to 5:00 PM</li>
                                </ul>
                            </div>
                            <div class="s_delnedit">
                                <i class="fas fa-pencil-alt"></i>
                                <i class="fas fa-trash-alt fa-trash-alty"></i>
                            </div>
                        </div>
                        <div class="s_table">
                            <div>
                                <p>Position : <span>Software Engineering</span></p>
                                <p>Date Period : <span>2024-09-12 to 2024-09-30</span></p>
                                <p>Interview Duration: <span>30-minute time slots</span></p>
                                <p>Interview Availability</p>
                                <ul>
                                    <li>Monday: 9:00 AM to 12:00 PM</li>
                                    <li>Tuesday: 1:00 PM to 5:00 PM</li>
                                    <li>Wednesday: 9:00 AM to 5:00 PM</li>
                                </ul>
                            </div>
                            <div class="s_delnedit">
                                <i class="fas fa-pencil-alt"></i>
                                <i class="fas fa-trash-alt fa-trash-alty"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script>
        // toast model
        

    </script>
</body>

</html>