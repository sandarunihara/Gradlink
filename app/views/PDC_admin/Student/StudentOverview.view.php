<!DOCTYPE html>
<html lang="en">

<head>
    <title>Students</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/overviewStudent.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
    <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Students</h1>
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
                    <h2>Registered Students</h2>
                    <div class="search-box">
                        <input type="text" placeholder="Search Students" />
                        <button> Search
                        </button>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Registration No.</th>
                            <th>Index No.</th>
                            <th>Name</th>
                            <th>NIC</th>
                            <th>Degree</th>
                            <th>Year</th>
                            <th>email</th>
                            <th>Contact No</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2022/CS/123</td>
                            <td>22001235</td>
                            <td>D.M. Perera</td>
                            <td>200223900437</td>
                            <td>CS</td> 
                            <td>2</td>
                            <td>dinuth@gmail.com</td>
                            <td>0771345678</td>
                            <td><button class="view-btn" onclick="naviagteToViewStudent();">View</button></td>
                            <!-- View -> Go to the student profile -->
                        </tr>
                        <tr>
                            <td>2022/CS/123</td>
                            <td>22001235</td>
                            <td>D.M. Perera</td>
                            <td>200223900437</td>
                            <td>CS</td>
                            <td>2</td>
                            <td>dinuth@gmail.com</td>
                            <td>0771345678</td>
                            <td><button class="view-btn" onclick="naviagteToViewStudent();">View</button></td>
                            <!-- View -> Go to the student profile -->
                        </tr>
                    </tbody>
                </table>
            </section>

            

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>

</body>

</html>