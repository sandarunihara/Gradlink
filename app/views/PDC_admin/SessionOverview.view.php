<!DOCTYPE html>
<html lang="en">

<head>
    <title>Students</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/overviewSession.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Sessions</h1>
                </div>

                <div class="header-right">
                    <i class="material-icons">notifications</i>
                    <img src="<?= ROOT ?>/assets/img/profile_img.jpg" alt="">

                    <div class="user-info">
                        <span>John</span>
                        <small>Admin</small>
                    </div>
                </div>
            </header>

            <section class="company-list">
                <div class="list-header">
                    <h2>Scheduled Sessions</h2>
                    <div class="search-box">
                        <input type="text" placeholder="Search Students" />
                        <button> Search
                        </button>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Session No.</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Company</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>2024/10/05</td>
                            <td>11.00am</td>
                            <td>IFS</td>
                            <td>Aaaaaaaaa</td>
                            <td><button class="view-btn">View</button></td>
                            
                            <!-- <td><button class="view-btn">View</button></td> -->
                            <!-- View -> Go to the student profile -->
                        </tr>
                        
                    </tbody>
                </table>
                <div class="action-buttons">
                    <button class="add-btn" onclick="navigateToAddCompany();" >+ Add</button>
                </div>

            </section>

            

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>