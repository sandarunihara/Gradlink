<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Fix.css"> 
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Studentsidebar.css"> 
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Student/Dashboard.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
            font-size: 14px;
        }

        table th {
            background-color: #f3f3f3;
            font-weight: 500;
            text-transform: uppercase;
        }

        table tr {
            background-color: #ffffff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table th i {
            margin-left: 8px;
            font-size: 12px;
        }

        table td {
            font-size: 14px;
            color: #333333;
        }

        .status {
            font-weight: bold;
            text-transform: capitalize;
        }

        .status.pending {
            color: #f0ad4e;
        }

        .status.rejected {
            color: #d9534f;
        }

        .status.accepted, .status.recruited {
            color: #5cb85c;
        }
    </style>
</head>
<body>
    <div class="side">
        <?php $this->renderComponent("studentsidebar")  ?>
    </div>
    <div id="content">
        <div class="main">
            <div class="d">
                <div>
                    <h1>Schedule Interviews</h1>
                </div>
                <div class="d_pro">
                    <div class="d_profile">
                        <i class="fas fa-calendar-alt"></i>
                        <i class="fas fa-bell"></i>
                    </div>
                <div>
                    <a href="../StudentProfile/dashboard">
                        <img src="<?php echo ROOT ?>/assets/img/Student/nayana.jpg" height ="400px" weight="400px"class="logo" />
                        <p><span>Nayana</span>Student</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div style = "padding:10px 20px">
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
        </table>
    </div>
</body>
</html>