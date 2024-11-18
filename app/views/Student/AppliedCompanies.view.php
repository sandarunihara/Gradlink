<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Studentsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/AppliedCompanies.css"> 

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
                    <h1>Applied Companies</h1>
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

            <div class="main">
                <div class="c_t">
                    <div class="c_table">
                        <!-- Table -->
                        <div>
                            <table class="complaint-table">
                                <thead class="c_table_t">
                                    <th>
                                        <h5>Date</h5>
                                    </th>
                                    <th>
                                        <h5>Company Name</h5>
                                    <th>
                                        <h5>Position</h5>
                                    </th>
                                    <th>
                                        <h5>Status</h5>
                                    </th>
                                </thead>
                                <!-- <tbody>
                                    <?php if (isset($data) && !empty($data)): ?>
                                        <?php foreach ($data['Complaints'] as $complaint): ?>
                                            <?php
                                            $status = $complaint -> Status;
                                            $statusClass = ($status == 'reviewed') ? 'reviewed' : 'notReviewed';
                                            $statusText = ($status == 'reviewed') ? 'Reviewed' : 'Not Reviewed';
                                            ?>
                                            <tr class="c_row">
                                                <td class="date"><?php echo htmlspecialchars($complaint -> Date); ?></td>
                                                <td class="topic"><?php echo htmlspecialchars($complaint -> Topic); ?></td>
                                                <td>    
                                                    <div class="<?php echo $statusClass; ?>">
                                                        <span class="status"><?php echo $statusText; ?></span>
                                                    </div>
                                                </td>
                                                <td><a href="<?=ROOT?>/Student/StudentComplaint/viewComplaint/<?php echo $complaint->ComplaintId; ?>"><button class="view-complaint-btn">View Complaint</button></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4">No Complaints found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>














<!-- style = "padding:10px 20px"
<table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Company Name</th>
                    <th>Position</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>05/12/2022</td>
                    <td>WSO2</td>
                    <td>Software Engineer</td>
                    <td class="status pending">Pending</td>
                </tr>
                <tr>
                    <td>05/12/2022</td>
                    <td>Sysco LABS</td>
                    <td>Network Engineer</td>
                    <td class="status rejected">Rejected</td>
                </tr>
                <tr>
                    <td>05/12/2022</td>
                    <td>Codegen</td>
                    <td>Software Engineer</td>
                    <td class="status pending">Pending</td>
                </tr>
                <tr>
                    <td>05/12/2022</td>
                    <td>Cambio</td>
                    <td>Software Engineer</td>
                    <td class="status pending">Pending</td>
                </tr>
                <tr>
                    <td>05/12/2022</td>
                    <td>Cambio</td>
                    <td>Software Engineer</td>
                    <td class="status rejected">Rejected</td>
                </tr>
            </tbody>
        </table> -->