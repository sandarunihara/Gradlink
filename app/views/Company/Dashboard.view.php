<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="<?php echo ROOT ?>/assets/js/Cscript.js" defer></script>
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
                        <h1>DashBoard</h1>
                    </div>

                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="d_main">
                    <div class="d_allsummery">
                        <div class="stats">
                            <div class="stat-card" onclick="window.location.href='http://localhost/Gradlink/public/company/StudentsRequests/dashboard'">
                                <h2>Total Student Applied</h2>
                                <p><?php echo $numOfStudents; ?></p>
                            </div>
                            <div class="stat-card" onclick="window.location.href='http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard'">
                                <h2>Total Student Shortlisted</h2>
                                <p><?php echo $numOfShortlistStudents ?></p>
                            </div>
                            <div class="stat-card" onclick="window.location.href='http://localhost/Gradlink/public/company/Advertisements/dashboard'">
                                <h2>Total Advertisements</h2>
                                <p><?php echo $numOfAdvertisements ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="bottomcontent">
                        <div class="d_request">
                            <h3>Student Requests</h3>
                            <div class="d_alllist">
                                <ul>
                                    <?php
                                    if (empty($data)) {
                                        echo '<li>No requests found</li>';
                                    } else {
                                        // Get the first 8 elements from $data
                                        $firstEight = array_slice($data, 0, 8);


                                        foreach ($firstEight as $item) {
                                            $status=$item['Status'];
                                            switch ($status) {
                                                case 'Recruit':
                                                    $Statusname = 'Recruit';
                                                    $statusClass = 'status Recruit';
                                                    break;
                                                case 'Reject':
                                                    $Statusname = 'Rejected';
                                                    $statusClass = 'status Reject';
                                                    break;
                                                case 'Interview Scheduled':
                                                    $Statusname = 'Scheduled';
                                                    $statusClass = 'status Sendemail';
                                                    break;
                                                case 'Shortlist':
                                                    $Statusname = 'Shortlisted';
                                                    $statusClass = 'status Shortlist';
                                                    break;
                                                default:
                                                    $Statusname = 'Pending';
                                                    $statusClass = 'status Pending';
                                                    break;
                                            }

                                            


                                            echo '<li>';
                                            echo '<span class="role">' . htmlspecialchars($item['Name']) . '</span>';
                                            echo '<span class="role position">' . htmlspecialchars($item['Position']) . '</span>';
                                            echo '<span class="' . $statusClass . '">' . htmlspecialchars(ucfirst($Statusname)) . '</span>';
                                            echo '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="d_view_all">
                                <a href="../StudentsRequests/dashboard">
                                    View All
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d_messaage">
                            <h3>Messages</h3>
                            <div class="d_msglist">
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
                                            <img src="<?php echo ROOT ?>/assets/img/company/pdcphoto.jpg" width="40" height="40"/>
                                            <div class="m_content">
                                                <span class="m_name"><?php echo $item['name']; ?></span>
                                                <span class="m_detail"><?php echo $detail; ?></span>
                                                <span class="m_time"><?php echo $item['time']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                            <div class="d_view_all">
                                <a href="../Messages/dashboard">
                                    View All
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>