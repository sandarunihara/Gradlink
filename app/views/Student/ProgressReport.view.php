<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/Fix.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/Studentsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/ProgressReport.css">

</head>
<body>
    <?php
        $Name = $data['Student'] -> Name;

    ?>
    <div class="side">
        <?php $this->renderComponent("studentsidebar")  ?>
    </div>
    <div id="content">
        <div class="main">
            <div class="d">
                <div >
                    <h1>Progress Report</h1>
                </div>
                <div class="d_pro">
                    <div class="d_profile">
                        <i class="fas fa-calendar-alt"></i>
                        <i class="fas fa-bell"></i>
                    </div>
                    <div>
                        <a href="<?=ROOT?>/Student/StudentProfile/Profile">
                            <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($Name)?>.jpg" height ="400px" weight="400px"class="logo" />
                            <p><span><?php echo($Name)?></span>Student</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="progress-main">
                <div class="complaint-navbar">
                    <div class = "add-complaint">
                        <a href="<?=ROOT?>/Student/StudentProgress/newReport"><button>+ Add New</button></a>
                    </div>
                    <div class="complaint-filter-container">
                        <i class="fas fa-filter"></i>
                        <select class="status-select">
                            <option value="all">All</option>
                            <option value="reviewed">Reviewed</option>
                            <option value="notReviewed">Not Reviewed</option>
                        </select> 
                    </div>
                </div>
                <div class="compliant-table-div">
                    <div class="complaint-table-background">
                        <!-- Table -->
                        <div>
                            <table class="complaint-table">
                                <thead class="complaint-table-headings">
                                    <th>
                                        <h5>Date</h5>
                                    </th>
                                    <th>
                                        <h5>Topic</h5>
                                    <th>
                                        <h5>Status</h5>
                                    </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2021-09-01</td>
                                        <td>Doc1</td>
                                        <td>Reviewed</td>
                                    </tr>
                                    <tr>
                                        <td>2021-09-01</td>
                                        <td>Doc2</td>
                                        <td>Reviewed</td>
                                    </tr>
                                    <tr>
                                        <td>2021-09-01</td>
                                        <td>Doc2</td>
                                        <td>Not Reviewed</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>