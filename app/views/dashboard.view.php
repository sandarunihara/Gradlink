<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/dashboard.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/logo.png" alt="GRadlink logo">
            </div>

            <nav class="nav-menu">
                <div class="nav-item">
                    <i class="material-icons">dashboard</i>
                    <a href="#" class="active">Dashboard</a>
                </div>
                <div class="nav-item active" >
                    <i class="material-icons">business</i>
                    <a href="#">Companies</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">school</i>
                    <a href="#">Students</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">tab</i>
                    <a href="#">Advertisements</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">article</i>
                    <a href="#">Applications</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">event</i>
                    <a href="#">Sessions</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">help</i>
                    <a href="#">Complain</a>
                </div>
                <div class="nav-item">
                    <i class="material-icons">account_circle</i>
                    <a href="#">Profile</a>
                </div>
            </nav>
            <div class="logout">
                
                <a href="#">Logout</a>
            </div>
        </aside>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Companies</h1>
                </div>

                <div class="header-right">
                    <i class="material-icons">notifications</i>
                    <img src="<?= ROOT ?>/assets/images/profile_img.jpg" alt="">

                    <div class="user-info">
                        <span>Jonitha Cathrine</span>
                        <small>Admin</small>
                    </div>
                </div>
            </header>

            <section class="company-list">
                <div class="list-header">
                    <h2>Company List</h2>
                    <div class="search-box">
                        <input type="text" placeholder="Search Company" />
                        <button> Search
                        </button>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>WSO2</td>
                            <td>Tharindu Perera</td>
                            <td>tharindu@gmail.com</td>
                            <td>071 273 4321</td>
                            <td><button class="view-btn" onclick="naviagteToViewCompany();" >View</button></td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
                <div class="action-buttons">
                    <button class="add-btn" onclick="navigateToAddCompany();" >+ Add</button>
                    <button class="blocked-btn">Blocked List</button>
                </div>
            </section>


        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>