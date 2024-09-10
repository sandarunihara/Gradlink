<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/company.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Dashboard.css">
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
                        <h1>DashBoard</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <i class="fas fa-calendar-alt"></i>
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="logo" />
                            <p><span>WSO2</span>Company</p>
                        </div>
                    </div>
                </div>
                <div class="sr_main">
                    <div class="sr_search">
                        <div class="sr_search-container">
                            <input type="text" placeholder="Search Student">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="sr_filter-container">
                            <i class="fas fa-filter"></i>
                            <select>
                                <option value="all">All</option>
                                <option value="shortlisted">Shortlisted</option>
                                <option value="rejected">Rejected</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="sr_t">
                        <div class="sr_table">
                            <div class="sr_sr">
                                <h3>Student Requests</h3>
                                <select class="role-select">
                                    <option value="software-engineer">Software Engineer</option>
                                    <option value="qa">QA</option>
                                    <option value="web-development">Web Development</option>
                                </select>
                            </div>
                            <!-- Table -->
                            <div>


                                <table class="student-table">
                                    <thead class="sr_table_t">
                                        <th>
                                            <h5>Student Name</h5>
                                        </th>
                                        <th>
                                            <h5>Student Degree</h5>
                                        </th>
                                        <th>
                                            <h5>Action</h5>
                                        </th>
                                        <th>
                                            <h5>View</h5>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr class="sr_row">
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>
                                        <tr>
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>
                                        <tr>
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>
                                        <tr>
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>
                                        <tr>
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>
                                        <tr>
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>
                                        <tr>
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>
                                        <tr>
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>
                                        <tr>
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>
                                        <tr>
                                            <td>Sandaru Nihara</td>
                                            <td>CS</td>
                                            <td>
                                                <select class="action-select">
                                                    <option value="shortlist">Shortlist</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </td>
                                            <td><button class="view-profile-btn">View Profile</button></td>
                                        </tr>



                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</body>